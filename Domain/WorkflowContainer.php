<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Domain;

use SpecGen\StateWorkflowSpecGenBundle\Domain\Exception\WorkflowServiceNotFoundException;
use Gmorel\StateWorkflowBundle\StateEngine\StateWorkflow;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
class WorkflowContainer
{
    /** @var StateWorkflow[] */
    private $workflows = array();

    /**
     * Used by DIC during compiler pass
     * @param StateWorkflow $stateWorkflow
     */
    public function addWorkflow(StateWorkflow $stateWorkflow)
    {
        $this->workflows[$stateWorkflow->getServiceId()] = $stateWorkflow;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (!isset($this->workflows[$id])) {
            throw new WorkflowServiceNotFoundException(
                sprintf('Workflow service "%s" not found in Sf2 DIC.', $id)
            );
        }

        $workflow = $this->workflows[$id];

        return $workflow;
    }

    /**
     * @return \Gmorel\StateWorkflowBundle\StateEngine\StateWorkflow[]
     */
    public function all()
    {
        return $this->workflows;
    }
}
