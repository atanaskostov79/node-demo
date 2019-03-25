<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\PostForm;
use Application\Entity\Coin;
use Application\Form\CommentForm;
use Zend\View\Model\JsonModel;

/**
 * This is the Post controller class of the Blog application. 
 * This controller is used for managing posts (adding/editing/viewing/deleting).
 */
class CoinController extends AbstractActionController 
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;
    
    /**
     * Post manager.
     * @var Application\Service\CoinManager 
     */
    private $coinManager;
    
    /**
     * Constructor is used for injecting dependencies into the controller.
     */
    public function __construct($entityManager, $coinManager) 
    {
        $this->entityManager = $entityManager;
        $this->coinManager = $coinManager;
    }
    
    /**
     * This action displays the "New Post" page. The page contains a form allowing
     * to enter post title, content and tags. When the user clicks the Submit button,
     * a new Post entity will be created.
     */

    public function indexAction() 
    {  
        // Get recent posts
        $posts = $this->entityManager->getRepository(Coin::class)->findAll();
        $tagCloud = $this->coinManager->getAllTest();

        //print_r($posts);
        // Render the view template
        return new ViewModel([
        'posts' => $posts
        ]);
    }
    public function onecoinAction() {
        $json = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=BTC,USD,EUR'); 
        $obj = json_decode($json, true);
//print_r($obj);
        return new ViewModel([
            'posts' => $obj
            ]);
    }

    public function getcoinAction() {
        $json = file_get_contents('https://www.cryptocompare.com/api/data/coinlist/');
        
        $obj = json_decode($json, true); echo"<pre>";
        foreach($obj as $k=>$val){
            print_r( $val);
        }
       
        
        echo"</pre>";
        exit;


    }


    public function jsonAction() {
       $tagCloud = $this->coinManager->getAllTest();
        return new JsonModel([
           
            'posts' => 
                $tagCloud
            
          ]);
          exit;
    }
}
