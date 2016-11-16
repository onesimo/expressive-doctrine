
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

    /**
     *
     * @var RouterInterface
     */
    private $router;

    public function __construct(Template\TemplateRendererInterface $template,   EntityManager $entityManager)
    {
        $this->template = $template;
        $this->entityManager = $entityManager;
        //$this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
         $product = new Product();
         $product->setName('Produto testes')
         ->setValueSale(100,50);
         
         $this->entityManager->persist($product);
         $this->entityManager->flush();
         
         $repository = $this->entityManager->getRepository(Product::class);
         $products = $repository->findAll();
         
         return new HtmlResponse($this->template->render('app::product/list',[
             'products'=> $products
         ]));
         
    }
}
 