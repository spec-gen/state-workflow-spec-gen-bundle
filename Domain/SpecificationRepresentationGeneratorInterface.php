<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Domain;

use Gmorel\StateWorkflowBundle\StateEngine\StateWorkflow;
use SpecGen\StateWorkflowSpecGenBundle\UI\Representation\HtmlSpecificationRepresentation;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
interface SpecificationRepresentationGeneratorInterface
{
    /**
     * @param StateWorkflow $stateWorkflow
     * @return HtmlSpecificationRepresentation
     */
    public function createSpecification(StateWorkflow $stateWorkflow);
}
