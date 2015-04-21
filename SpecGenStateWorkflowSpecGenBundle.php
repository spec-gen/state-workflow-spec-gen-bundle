<?php

namespace SpecGen\StateWorkflowSpecGenBundle;

use SpecGen\StateWorkflowSpecGenBundle\DependencyInjection\RegisterStateWorkflowCompilerPass;
use SpecGen\StateWorkflowSpecGenBundle\DependencyInjection\SpecGenStateWorkflowSpecGenBundleExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
class SpecGenStateWorkflowSpecGenBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new RegisterStateWorkflowCompilerPass());
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new SpecGenStateWorkflowSpecGenBundleExtension();
    }
}
