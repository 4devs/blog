<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/1/13
 * @version 1.0.0
 */

namespace FDevs\ArticleBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ValidationPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('validator.mapping.loader.xml_files_loader.mapping_files')) {
            return;
        }
        $files = $container->getParameter('validator.mapping.loader.xml_files_loader.mapping_files');

        $reflClass = new \ReflectionClass($this);
        $file = dirname($reflClass->getFileName()) . '/../../Resources/config/validation.xml';
        $files[] = $file;

        $container->addResource(new FileResource($file));

        $container->setParameter('validator.mapping.loader.xml_files_loader.mapping_files', $files);
    }

}
