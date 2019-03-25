<?php
namespace Application\Service;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Application\Entity\Fixing;
use Application\Entity\Comment;
use Application\Entity\Tag;
use Zend\Filter\StaticFilter;

/**
 * The FixingManager service is responsible for adding new Fixings, updating existing
 * Fixings, adding tags to Fixing, etc.
 */
class FixingManager
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager;
     */
    private $entityManager;
    
    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * This method adds a new Fixing.
     */
    public function addNewFixing($data) 
    {
        // Create new Fixing entity.
        $Fixing = new Fixing();
        $Fixing->setCurency($data['curency']);
        $Fixing->setBGN($data['BGN']);
        $Fixing->setBTC($data['BTC']);
        $Fixing->setUSD($data['USD']);
        $Fixing->setEUR($data['EUR']);
        $currentDate = date('Y-m-d H:i:s');
        //$Fixing->setDateCreated($currentDate);        
        
        // Add the entity to entity manager.
        $this->entityManager->persist($Fixing);
        
        // Add tags to Fixing
        //$this->addTagsToFixing($data['tags'], $Fixing);
        
        // Apply changes to database.
        $this->entityManager->flush();
    }
    
    /**
     * This method allows to update data of a single Fixing.
     */
    public function updateFixing($Fixing, $data) 
    {
        $Fixing->setTitle($data['title']);
        $Fixing->setContent($data['content']);
        $Fixing->setStatus($data['status']);
        
        // Add tags to Fixing
        $this->addTagsToFixing($data['tags'], $Fixing);
        
        // Apply changes to database.
        $this->entityManager->flush();
    }


    public function getAllTest() {

        $tags = $this->entityManager->getRepository(Fixing::class)
                ->findBy(['curency' => ['BTC', 'ETH','ADA']],['id'=>'DESC'],3);
                $arr = [];
             
            foreach ($tags as $k=>$tag) {
          
 
           $arr[] =[ 
           'currency' => $tag->getCurency()  , 
           "BGN" => $tag->getBGN(), 
           "USD" => $tag->getUSD(),
           "EUR" => $tag->getEUR(),
           "BTC" => $tag->getBTC(), 
           "Time" => $tag->getTime() 
        
        
        ];

            if ($k > 1000  ) break;
        }
  
         
        return $arr;       
    }
}



