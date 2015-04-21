<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Domain\Representation;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
interface WorkflowRepresentationInterface
{
    /**
     * Get human readable workflow name
     *
     * @return string
     */
    public function getWorkflowName();

    /**
     * Serialize Workflow into a ready to be processed data (JSON/XML/..)
     *
     * @return string
     */
    public function serialize();
}
