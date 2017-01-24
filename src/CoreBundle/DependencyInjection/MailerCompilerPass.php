<?php

namespace CoreBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class CoreExtension
 * @package UserBundle\DependencyInjection
 */
class MailerCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('core.mailer.manager')) {
            return;
        }

        $definition = $container->findDefinition('core.mailer.manager');

        $this->processTaggedServices($container, $definition, 'addHandler', 'core.mailer.handler');
        $this->processTaggedServices($container, $definition, 'addProvider', 'core.mailer.provider');
    }

    /**
     * @param Container $container
     * @param Definition $definition
     * @param string $method
     * @param string $tag
     */
    private function processTaggedServices(Container $container, Definition $definition, $method, $tag)
    {
        $taggedServices = $container->findTaggedServiceIds($tag);

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall($method, [new Reference($id)]);
        }
    }
}
