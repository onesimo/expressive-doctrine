<?php
namespace App\Action\Product\Factory;
 
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use App\Action\Product\ProductCreatePageAction;
use Zend\Expressive\Router\RouterInterface;

class ProductCreatePageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $router = $container->get(RouterInterface::class);
        $entityManager = $container->get(EntityManager::class);
        return new ProductCreatePageAction($template,$router, $entityManager);
    }
}