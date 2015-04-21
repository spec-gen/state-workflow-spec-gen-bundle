<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Test\UI\Representation;

use SpecGen\StateWorkflowSpecGenBundle\Domain\IntrospectedWorkflow;
use Gmorel\StateWorkflowBundle\StateEngine\StateWorkflow;
use SpecGen\StateWorkflowSpecGenBundle\Test\Stub\StateA;
use SpecGen\StateWorkflowSpecGenBundle\Test\Stub\StateB;
use SpecGen\StateWorkflowSpecGenBundle\Test\Stub\StateC;
use SpecGen\StateWorkflowSpecGenBundle\UI\Representation\CytoscapeWorkflowRepresentation as SUT;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
class CytoscapeWorkflowRepresentationTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_should_represent_itself_in_json()
    {
        // Given
        $stateWorkflow = $this->createValidStateWorkflow();
        $introspectedWorkflow = new IntrospectedWorkflow($stateWorkflow);

        $expected = '{"nodes":[{"data":{"id":"a","name":"A","weight":50,"faveColor":"#999999","faveShape":"triangle"}},{"data":{"id":"b","name":"B","weight":50,"faveColor":"#FFFFFF","faveShape":"rectangle"}},{"data":{"id":"c","name":"C","weight":50,"faveColor":"#FFFFFF","faveShape":"ellipse"}}],"edges":[{"data":{"source":"a","target":"b","faveColor":"#999999","strength":20}},{"data":{"source":"b","target":"c","faveColor":"#FFFFFF","strength":20}}]}';

        // When
        $representation = new SUT($introspectedWorkflow);
        $actual = $representation->serialize();

        // Then
        $this->assertEquals($expected, $actual, 'State Workflow are not well represented in JSON Cytoscape anymore.');
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
