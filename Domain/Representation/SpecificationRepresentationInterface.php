<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Domain\Representation;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
interface SpecificationRepresentationInterface
{
    /**
     * Render human readable workflow specification page
     *
     * @return string
     */
    public function render();
}
