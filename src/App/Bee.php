<?php
namespace Beegame;

use Beegame\Queen;
use Beegame\Drone;
use Beegame\Worker;

class Bee
{
    /**
     * lifespan of the bee
     * @var int
     */
    protected $lifespan;

    /**
     * Points deducted when hit
     * @var int
     */
    protected $hitPoints;

    /**
     * stores updated Lifespan
     * @var int
     */
    protected $updatedLifespan;
 
    /**
     * stores the BeeType
     * @var string
     */
    protected $beeType=null;
    
    
    
    public function __construct()
    {
        $this->updatedLifespan = $this->lifespan;
    }
 
    
    /**
     * Get the hitPoints for the individual bee
     * @return int
     */
    public function getHitPoints()
    {
        return isset($this->hitPoints) ? $this->hitPoints : 0;
    }
    

    /**
     * Get the BeeType
     * @return string
     */
    public function getBeeType()
    {
        return isset($this->beeType) ? $this->beeType : $this->beeType;
    }

    
    /**
     * Updates the Lifespan 
     * @return int updated Lifespan
     */ 
    public function updateLifespan()
    {

        if (($this->updatedLifespan - $this->hitPoints) > 0) {
                $this->updatedLifespan = $this->updatedLifespan - $this->hitPoints;
        } else {
            $this->updatedLifespan = 0;     
        }
        
        return $this->updatedLifespan;
         
    }
    
    /**
     * Get the updated Lifespan
     * @return int 
     */
    public function getLifespan(){
        return $this->updatedLifespan;
    }
        
  
}
