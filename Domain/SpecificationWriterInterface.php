<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Domain;

use SpecGen\StateWorkflowSpecGenBundle\Domain\Representation\SpecificationRepresentationInterface;
use SpecificationGeneration\Domain\Exception\UnableToWriteSpecificationException;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
interface SpecificationWriterInterface
{
    /**
     * Write specification on a target
     * @param SpecificationRepresentationInterface $specificationRepresentation
     * @param string                               $target
     *
     * @throws UnableToWriteSpecificationException
     */
    public function write(SpecificationRepresentationInterface $specificationRepresentation, $target);
}
