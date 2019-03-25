<?php
namespace Application\Service;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Application\Entity\Coin;
use Application\Entity\Comment;
use Application\Entity\Tag;
use Zend\Filter\StaticFilter;

/**
 * The CoinManager service is responsible for adding new Coins, updating existing
 * Coins, adding tags to Coin, etc.
 */
class CoinManager
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
     * This method adds a new Coin.
     */
    public function addNewCoin($data) 
    {
        // Create new Coin entity.
        $Coin = new Coin();
        $Coin->setTitle($data['title']);
        $Coin->setContent($data['content']);
        $Coin->setStatus($data['status']);
        $currentDate = date('Y-m-d H:i:s');
        $Coin->setDateCreated($currentDate);        
        
        // Add the entity to entity manager.
        $this->entityManager->persist($Coin);
        
        // Add tags to Coin
        $this->addTagsToCoin($data['tags'], $Coin);
        
        // Apply changes to database.
        $this->entityManager->flush();
    }
    
    /**
     * This method allows to update data of a single Coin.
     */
    public function updateCoin($Coin, $data) 
    {
        $Coin->setTitle($data['title']);
        $Coin->setContent($data['content']);
        $Coin->setStatus($data['status']);
        
        // Add tags to Coin
        $this->addTagsToCoin($data['tags'], $Coin);
        
        // Apply changes to database.
        $this->entityManager->flush();
    }

    /**
     * Adds/updates tags in the given Coin.
     */
    private function addTagsToCoin($tagsStr, $Coin) 
    {
        // Remove tag associations (if any)
        $tags = $Coin->getTags();
        foreach ($tags as $tag) {            
            $Coin->removeTagAssociation($tag);
        }
        
        // Add tags to Coin
        $tags = explode(',', $tagsStr);
        foreach ($tags as $tagName) {
            
            $tagName = StaticFilter::execute($tagName, 'StringTrim');
            if (empty($tagName)) {
                continue; 
            }
            
            $tag = $this->entityManager->getRepository(Tag::class)
                    ->findOneByName($tagName);
            if ($tag == null)
                $tag = new Tag();
            
            $tag->setName($tagName);
            $tag->addCoin($Coin);
            
            $this->entityManager->persist($tag);
            
            $Coin->addTag($tag);
        }
    }    
    
    /**
     * Returns status as a string.
     */
    public function getCoinStatusAsString($Coin) 
    {
        switch ($Coin->getStatus()) {
            case Coin::STATUS_DRAFT: return 'Draft';
            case Coin::STATUS_PUBLISHED: return 'Published';
        }
        
        return 'Unknown';
    }
    
    /**
     * Converts tags of the given Coin to comma separated list (string).
     */
    public function convertTagsToString($Coin) 
    {
        $tags = $Coin->getTags();
        $tagCount = count($tags);
        $tagsStr = '';
        $i = 0;
        foreach ($tags as $tag) {
            $i ++;
            $tagsStr .= $tag->getName();
            if ($i < $tagCount) 
                $tagsStr .= ', ';
        }
        
        return $tagsStr;
    }    

    /**
     * Returns count of comments for given Coin as properly formatted string.
     */
    public function getCommentCountStr($Coin)
    {
        $commentCount = count($Coin->getComments());
        if ($commentCount == 0)
            return 'No comments';
        else if ($commentCount == 1) 
            return '1 comment';
        else
            return $commentCount . ' comments';
    }


    /**
     * This method adds a new comment to Coin.
     */
    public function addCommentToCoin($Coin, $data) 
    {
        // Create new Comment entity.
        $comment = new Comment();
        $comment->setCoin($Coin);
        $comment->setAuthor($data['author']);
        $comment->setContent($data['comment']);        
        $currentDate = date('Y-m-d H:i:s');
        $comment->setDateCreated($currentDate);

        // Add the entity to entity manager.
        $this->entityManager->persist($comment);

        // Apply changes.
        $this->entityManager->flush();
    }
    
    /**
     * Removes Coin and all associated comments.
     */
    public function removeCoin($Coin) 
    {
        // Remove associated comments
        $comments = $Coin->getComments();
        foreach ($comments as $comment) {
            $this->entityManager->remove($comment);
        }
        
        // Remove tag associations (if any)
        $tags = $Coin->getTags();
        foreach ($tags as $tag) {
            
            $Coin->removeTagAssociation($tag);
        }
        
        $this->entityManager->remove($Coin);
        
        $this->entityManager->flush();
    }
    
    /**
     * Calculates frequencies of tag usage.
     */
    public function getTagCloud()
    {
        $tagCloud = [];
                
        $Coins = $this->entityManager->getRepository(Coin::class)
                    ->findAll();
        $totalCoinCount = count($Coins);
        
        $tags = $this->entityManager->getRepository(Coin::class)
                ->findAll();
        foreach ($tags as $tag) {
            
            $CoinsByTag = $this->entityManager->getRepository(Coin::class)
                    ->findAll();
            
            $CoinCount = count($CoinsByTag);
            if ($CoinCount > 0) {
                $tagCloud[$tag->getName()] = $CoinCount;
            }
        }
        
        $normalizedTagCloud = [];
        
        // Normalize
        foreach ($tagCloud as $name=>$CoinCount) {
            $normalizedTagCloud[$name] =  $CoinCount/$totalCoinCount;
        }
        
        return $normalizedTagCloud;
    }
    public function getAllTest() {

        $tags = $this->entityManager->getRepository(Coin::class)
                ->findAll();
                $arr = [];
             
            foreach ($tags as $k=>$tag) {
          
 
           $arr[] =["Id" => $tag->getId(), "Name" => $tag->getName(), "FullName" => $tag->getFullName()  ];

            if ($k > 1000  ) break;
        }
  
         
        return $arr;       
    }
}



