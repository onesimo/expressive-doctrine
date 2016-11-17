<?php
namespace App\Helper;

use Interop\Container\ContainerInterface;
use Zend\Form\ConfigProvider;
use Zend\Stdlib\ArrayUtils;
use Zend\View\HelperPluginManager;

class HelperPluginManagerFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $viewHelpers = isset($config['view_helpers']) ? $config['view_helpers']:[];
        $configFormHelper = (new ConfigProvider())->getViewHelperConfig();
        $viewHelpers = ArrayUtils::merge($configFormHelper, $viewHelpers);
        
        return new HelperPluginManager($container, $viewHelpers);
    }
}

