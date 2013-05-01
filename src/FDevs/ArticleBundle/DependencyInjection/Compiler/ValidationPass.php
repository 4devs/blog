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
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $files = $container->getParameter('validator.mapping.loader.xml_files_loader.mapping_files');

        $validationFile = __DIR__ . '/../../Resources/config/validation/mongodb.xml';

        $files[] = realpath($validationFile);

        $container->addResource(new FileResource($validationFile));

        $container->setParameter('validator.mapping.loader.xml_files_loader.mapping_files', $files);
    }


}