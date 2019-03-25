<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\PostForm;
use Application\Entity\Fixing;
use Application\Form\CommentForm;
use Zend\View\Model\JsonModel;

/**
 * This is the Post controller class of the Blog application. 
 * This controller is used for managing posts (adding/editing/viewing/deleting).
 */
class FixingController extends AbstractActionController 
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;
    
    /**
     * Post manager.
     * @var Application\Service\FixingManager 
     */
    private $FixingManager;
    
    /**
     * Constructor is used for injecting dependencies into the controller.
     */
    public function __construct($entityManager, $FixingManager) 
    {
        $this->entityManager = $entityManager;
        $this->FixingManager = $FixingManager;
    }
    
    /**
     * This action displays the "New Post" page. The page contains a form allowing
     * to enter post title, content and tags. When the user clicks the Submit button,
     * a new Post entity will be created.
     */

    public function indexAction() 
    {  
        // Get recent posts
        $posts = $this->entityManager->getRepository(Fixing::class)->findAll();
        $tagCloud = $this->FixingManager->getAllTest();

        //print_r($posts);
        // Render the view template
        return new ViewModel([
        'posts' => $posts
        ]);
    }
    public function getfixingAction() {
        $listCur = ['ETH', 'BTC', 'ADA'];
        $jsr=[];
        foreach ($listCur as $k=>$value) {
            $json = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym='.$value.'&tsyms=BGN,USD,EUR,BTC'); 
            $obj = json_decode($json, true);
            $obj['curency'] = $value; 
            $this->FixingManager->addNewFixing($obj);
            $jsr[$k] = $obj;
        }

        
        
//print_r($obj);
        return new JsonModel([
            'posts' => $jsr
            ]);

            exit;
    }
/*
    public function getFixingAction() {
        $json = file_get_contents('https://www.cryptocompare.com/api/data/Fixinglist/');
        
        $obj = json_decode($json, true); echo"<pre>";
        foreach($obj as $k=>$val){
            print_r( $val);
        }
       
        
        echo"</pre>";
        exit;


    }

*/

    public function jsonAction() {
       $tagCloud = $this->FixingManager->getAllTest();
        return new JsonModel([
           
            'data' => 
                $tagCloud
            
          ]);
          exit;
    }
}
