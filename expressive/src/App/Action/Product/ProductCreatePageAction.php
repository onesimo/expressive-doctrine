<?php
namespace App\Action\Product;

use App\Entity\Product;
use App\Form\ProductForm;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use Zend\Hydrator\ClassMethods;

class ProductCreatePageAction
{

    private $template;

    /**
     *
     * @var EntityManager
     */
    private $entityManager;
    
    private $router;
    


    public function __construct(Template\TemplateRendererInterface $template, RouterInterface $router, EntityManager $entityManager)
    {
        $this->template = $template;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
         $form = new ProductForm();
           
         if($request->getMethod() == 'POST'){
             $data = $request->getParsedBody();
             $form->setData($data);
             if($form->isValid()){
                 $data = $form->getData();
                 $product = new Product();
                 $product->setName($data['name'])
                 ->setValueSale($data['value_sale']);
                 $this->entityManager->persist($product);
                 $this->entityManager->flush();
                 $uri = $this->router->generateUri('product.list');
                 
                 return new RedirectResponse($uri);
             }
         }
         
         return new HtmlResponse($this->template->render('app::product/create',[
             'form'=> $form
         ]));
         
    }
}
 