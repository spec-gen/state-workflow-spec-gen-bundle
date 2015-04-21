<?php

namespace SpecGen\StateWorkflowSpecGenBundle\App;

use SpecGen\StateWorkflowSpecGenBundle\App\Command\RenderWorkflowSpecificationFromWorkflowServiceCommand;
use SpecGen\StateWorkflowSpecGenBundle\Domain\Exception\WorkflowServiceNotFoundException;
use SpecGen\StateWorkflowSpecGenBundle\Domain\SpecificationRepresentationGeneratorInterface;
use SpecGen\StateWorkflowSpecGenBundle\Domain\SpecificationWriterInterface;
use SpecGen\StateWorkflowSpecGenBundle\Domain\WorkflowContainer;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 * SpecificationGeneration Bounded Context entry point
 */
class SpecificationService
{
    /** @var WorkflowContainer */
    private $workflowContainer;

    /** @var SpecificationRepresentationGeneratorInterface */
    private $specificationRepresentationGenerator;

    /** @var SpecificationWriterInterface */
    private $specificationWriter;

    /**
     * @param WorkflowContainer                             $workflowContainer
     * @param SpecificationRepresentationGeneratorInterface $specificationRepresentationGenerator
     * @param SpecificationWriterInterface                  $specificationWriter
     */
    public function __construct(WorkflowContainer $workflowContainer, SpecificationRepresentationGeneratorInterface $specificationRepresentationGenerator, SpecificationWriterInterface $specificationWriter)
    {
        $this->workflowContainer = $workflowContainer;
        $this->specificationRepresentationGenerator = $specificationRepresentationGenerator;
        $this->specificationWriter = $specificationWriter;
    }

    /**
     * Render specification for the given StateWorkflow
     * @api
     * @param RenderWorkflowSpecificationFromWorkflowServiceCommand $command
     *
     * @throws WorkflowServiceNotFoundException
     */
    public function renderSpecification(RenderWorkflowSpecificationFromWorkflowServiceCommand $command)
    {
        $stateWorkflow = $this->workflowContainer->get(
            $command->getWorkFlowServiceId()
        );

        $htmlSpecificationRepresentation = $this->specificationRepresentationGenerator->createSpecification(
            $stateWorkflow
        );

        $this->specificationWriter->write(
            $htmlSpecificationRepresentation,
            $command->getOutputFileName()
        );
    }

    /**
     * Get all available StateWorkflow service
     * @api
     *
     * @return string[]
     */
    public function getAvailableWorkflowIds()
    {
        $availableWorkflows = $this->workflowContainer->all();

        $availableWorkflowsIds = array();
        foreach ($availableWorkflows as $availableWorkflow) {
            $availableWorkflowsIds[] = $availableWorkflow->getServiceId();
        }

        return $availableWorkflowsIds;
    }
}
