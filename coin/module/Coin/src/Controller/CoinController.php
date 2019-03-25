<?php
namespace Coin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Coin\Entity\Post;
use Zend\Stdlib\Hydrator;
/**
 * This is the controller class for managing file downloads.
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
     * @var Application\Service\PostManager 
     */
    private $postManager;
    public function __construct($entityManager, $postManager)
    {
      $this->entityManager = $entityManager;
      $this->postManager = $postManager;
    }
   
    /**
     * This is the default "index" action of the controller. It displays the 
     * Downloads page.
     */
    public function indexAction() 
    {
        //$posts = $entityManager->getRepository(Post::class)->find(1);
        $posts = $this->entityManager->getRepository(Post::class)->findAll();
        
       //return new ViewModel();
        //print_r ($posts);
        
        return new ViewModel([
            'posts' => $posts
          ]);
        
    }

    public function getcoinAction() {
        $json = file_get_contents('https://www.cryptocompare.com/api/data/coinlist/');
        $obj = json_decode($json);
        print_r($obj);
        exit;


    }
    public function jsonAction()
    {

        
       
        return new JsonModel( $json);
    }

    public function object_2_array($result)
    {
        $array = array();
        foreach ($result as $key=>$value)
        {
            if (is_object($value))
            {
                $array[$key]=$this->object_2_array($value);
            }
            if (is_array($value))
            {
                $array[$key]=$this->object_2_array($value);
            }
            else
            {
                $array[$key]=$value;
            }
        }
        return $array;
    }

}

