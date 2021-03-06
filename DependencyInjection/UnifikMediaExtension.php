<?php

namespace Unifik\MediaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class UnifikMediaExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('unifik_media.resultPerPage', $config['resultPerPage']);
        $container->setParameter('unifik_media.media_select.resultPerPage', $config['media_select']['resultPerPage']);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $config = array(
            'filter_sets' => array(
                'media_thumb' => array(
                    'quality' => 100,
                    'filters' => array(
                        'thumbnail' => array(
                            'size' => array(120, 120),
                            'mode' => 'outbound'
                        )
                    )
                ),
                'media_thumb_large' => array(
                    'quality' => 100,
                    'filters' => array(
                        'thumbnail' => array(
                            'size' => array(250, 250),
                            'mode' => 'outbound'
                        )
                    )
                ),
                'media_thumb_editor' => array(
                    'quality' => 100,
                    'filters' => array(
                        'relative_resize' => array(
                            'heighten' => 500
                        )
                    )
                )
            )
        );

        $container->prependExtensionConfig('liip_imagine', $config);
    }
}


