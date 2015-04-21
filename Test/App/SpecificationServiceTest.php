<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Test\App;

use SpecGen\StateWorkflowSpecGenBundle\App\Command\RenderWorkflowSpecificationFromWorkflowServiceCommand;
use SpecGen\StateWorkflowSpecGenBundle\Domain\WorkflowContainer;
use SpecGen\StateWorkflowSpecGenBundle\Infra\CytoscapeSpecificationRepresentationGenerator;
use SpecGen\StateWorkflowSpecGenBundle\Infra\FileSystemSpecificationWriter;
use Gmorel\StateWorkflowBundle\StateEngine\StateWorkflow;
use SpecGen\StateWorkflowSpecGenBundle\App\SpecificationService as SUT;
use SpecGen\StateWorkflowSpecGenBundle\Test\Stub\StateA;
use SpecGen\StateWorkflowSpecGenBundle\Test\Stub\StateB;
use SpecGen\StateWorkflowSpecGenBundle\Test\Stub\StateC;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
class SpecificationServiceTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_should_introspect_workflow_states()
    {
        // Given
        $stateWorkflow = $this->createValidStateWorkflow();
        $outputFileName = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid() . '.html';

        $command = new RenderWorkflowSpecificationFromWorkflowServiceCommand(
            $stateWorkflow->getServiceId(),
            $outputFileName
        );
        $workflowContainer = new WorkflowContainer();
        $workflowContainer->addWorkflow($stateWorkflow);

        $specificationWriter = new FileSystemSpecificationWriter();

        $introspectedWorkflow = new SUT(
            $workflowContainer,
            new CytoscapeSpecificationRepresentationGenerator(),
            $specificationWriter
        );

        $expected = '<!DOCTYPE html>
<html>
    <head>
        <link href="https://rawgit.com/spec-gen/state-workflow-spec-gen-bundle/master/UI/Resource/style.css" rel="stylesheet" />
        <meta charset=utf-8 />
        <title>Booking Workflow Specification</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://cytoscape.github.io/cytoscape.js/api/cytoscape.js-latest/cytoscape.min.js"></script>
        <script src="https://rawgit.com/spec-gen/state-workflow-spec-gen-bundle/master/UI/Resource/code.js"></script>
        <script type="application/javascript">
            var dataWorkflow = {"nodes":[{"data":{"id":"a","name":"A","weight":50,"faveColor":"#999999","faveShape":"triangle"}},{"data":{"id":"b","name":"B","weight":50,"faveColor":"#FFFFFF","faveShape":"rectangle"}},{"data":{"id":"c","name":"C","weight":50,"faveColor":"#FFFFFF","faveShape":"ellipse"}}],"edges":[{"data":{"source":"a","target":"b","faveColor":"#999999","strength":20}},{"data":{"source":"b","target":"c","faveColor":"#FFFFFF","strength":20}}]};
        </script>
    </head>

    <body>
        <div id="cy"></div>
    </body>
</html>
';

        // When
        $introspectedWorkflow->renderSpecification($command);
        $actual = file_get_contents($outputFileName);

        // Then
        $this->assertEquals($expected, $actual, 'Workflow Specification is not well rendered anymore.');
    }

    /**
     * @return StateWorkflow
     */
    /**
     * @return StateWorkflow
     */
    private function createValidStateWorkflow()
    {
        $stateA = new StateA();
        $stateB = new StateB();
        $stateC = new StateC();

        $stateWorkflow = new StateWorkflow('Booking Workflow', 'key');
        $stateWorkflow->addAvailableState($stateA);
        $stateWorkflow->addAvailableState($stateB);
        $stateWorkflow->addAvailableState($stateC);

        $stateWorkflow->setStateAsDefault($stateA->getKey());

        return $stateWorkflow;
    }
}
