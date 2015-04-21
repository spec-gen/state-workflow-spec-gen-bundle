<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Domain;

use Gmorel\StateWorkflowBundle\StateEngine\HasStateInterface;
use Gmorel\StateWorkflowBundle\StateEngine\StateInterface;
use Gmorel\StateWorkflowBundle\StateEngine\StateWorkflow;

/**
 * Stub used during introspection
 * @author Guillaume MOREL <github.com/gmorel>
 */
class StubHasState implements HasStateInterface
{
    /**
     * {@inheritdoc}
     */
    public function changeState(StateWorkflow $stateContext, StateInterface $newState)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getState(StateWorkflow $stateContext)
    {
        return null;
    }

}
