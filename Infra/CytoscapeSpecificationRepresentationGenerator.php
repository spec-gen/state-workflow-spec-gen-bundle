<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Infra;

use SpecGen\StateWorkflowSpecGenBundle\Domain\SpecificationRepresentationGeneratorInterface;
use Gmorel\StateWorkflowBundle\StateEngine\StateWorkflow;
use SpecGen\StateWorkflowSpecGenBundle\Domain\IntrospectedWorkflow;
use SpecGen\StateWorkflowSpecGenBundle\UI\Representation\HtmlSpecificationRepresentation;
use SpecGen\StateWorkflowSpecGenBundle\UI\Representation\CytoscapeWorkflowRepresentation;


/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
class CytoscapeSpecificationRepresentationGenerator implements SpecificationRepresentationGeneratorInterface
{
    const TEMPLATE_FILE_PATH = 'UI/Resource/workflow-template.html';

    /**
     * {@inheritdoc}
     */
    public function createSpecification(StateWorkflow $stateWorkflow)
    {
        $introspectedWorkflow = new IntrospectedWorkflow($stateWorkflow);

        $templateFilePath = realpath(dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . self::TEMPLATE_FILE_PATH);

        return new HtmlSpecificationRepresentation(
            new CytoscapeWorkflowRepresentation($introspectedWorkflow),
            $templateFilePath
        );
    }
}
