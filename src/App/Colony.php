<?php
namespace Beegame;

use Beegame\Queen;
use Beegame\Drone;
use Worker;


/**
 * Class Colony
 * Description of Colony
 *
 * @author EM
 */

class Colony {
     
    /**
     * Array with Bee Types and amount for each Bee Type
     * @var array 
     */
    public $colonyPopulation = array(
                                'beeType' => array(
                                            'Queen' => ['amount'=> 1],                                    
                                            'Worker'=> ['amount'=> 5],   
                                            'Drone' => ['amount'=> 8],            
                                            )
                                );

    /*
     * State of the colony default is true
     */
    public $colonyAlive = true;
    
    /*
     * Counter to count the amount of Bees inside Colony
     */
    public $counter = 0;  
    
    /*
     * Array to store the Messages
     */
    public $message = [];
     
    /**
     * Array to Store all Bees in the Colony
     * @var array \Game\Bee
     */
    protected $colony = [];

    
    
    public function __construct()
    {
        
        // Set up the Colony with the Bees, each Bee will be it's own Object
        foreach ($this->colonyPopulation['beeType'] as $beeType =>$value){
        
            for($i = 0; $i<$value['amount']; $i++){
                $class = '\\Beegame\\'.$beeType;
                $this->colony[] = new $class;
                $this->counter++;
            }
        }
        $this->allBees = $this->counter;
     
    }
    

    /**
     * Process the Attack
     * @return bool colonyAlive
     */   
    public function attackColony(){
        
        // get the Bee which will be attacked
        $this->target = $this->getTarget();
        
        // Check if the selcted Target still got Lifespan left if not return and pick new
        if($this->target->getLifespan() == 0){
            return;
        }
        
        // set Round counter
        $this->setRoundCount();
        
        // update the Lifespan of the attacked Bee
        $latestLifespan = $this->target->updateLifespan();
        
        // Set Message about Bee being hit, type of Bee, Hit Points and Lifespan left
        $this->setMessage(0);
       
        // If Lifespan of the attacked Bee is <= 0 take action
        if($latestLifespan <= 0){
            // Lifespan <=0 means Bee is dead, call Undertacker to take action
            $this->callUndertaker();
            // Deduct from the amount of Bees in the Colony
            $this->updateColonyPopulation();
            
            // if the game is still running but you only got 1 Bee left than this must be the Queen and she can not survive on her own
            if($this->allBees <2){
                  $this->colonyAlive = false;
                  // Set Message that all Bees are dead
                  $this->setMessage(3);
            }
        } 

        return $this->colonyAlive;
    }


    /**
     * Deduct the killed Bee from allBees
     */
    public function updateColonyPopulation(){
        
         $this->allBees--;
    }
    
       
    /**
     * Checks the colony status and assigns the Message to be saved
     * @return bol colonyAlive 
     */
    
    public function callUndertaker(){
       
      //  $this->colonyPopulation[$this->target]['amount']--;
       // if the killed Bee was the Queen set GameOver to true, since the colony can not survive without her
        if($this->target->getBeeType() == 'Queen'){
            // Log Message that Queen died
           // $message = "The Queen has died, the colony will no longer survive.";
            $this->setMessage(1);
            // set Game Over to true to end the Game
            $this->colonyAlive = false;
          
        }else{
            // otherwise just log a message to inform the player that Bee died   
           $this->setMessage(2);
           $this->colonyAlive = true;
        }
                
        return $this->colonyAlive;
    }


     /**
     * Get the target from the attack
     * @return single object
     */

    public function getTarget(){    
        $this->target = $this->randomValue();
        return $this->target;
    }
     
    /**
    * Selects randomly a value from an Array
    * Input is the Array to select from in this case the Colony Array
    * @return object DescriptionReturn: the randomly selected Bee Object
    */
    
    public function randomValue()
    {
        return $this->colony[array_rand($this->colony)];
    }
    
    /**
     * @param int 
     * Map the Message for the Message Type
     * @return string 
     */
    
    public function mapMessage($msgType){
        
        $this->msgText = array(
                    0 => 'You just hit the '.$this->target->getBeeType().' Bee. The Bee lost '.$this->target->getHitPoints() .' points from it\'s health and got '.$this->target->getLifespan().' points left.',
                    1 => 'ALERT ! The Queen has died, the colony will no longer survive without her :(',
                    2 => 'The ' .$this->target->getBeeType() .' died !',
                    3 => 'All the Bees died and the Queen will not be able to survive without her colony.',
                  
                    );
        
        return $this->msgText[$msgType];
        
    }


    /**
     * @param int to map the Message
     * Sets the specific Message according to the int
     */
    public function setMessage($msgType){
        $this->message[] = $this->mapMessage($msgType);
    }
    
    
    /**
     * Get the stored Message array
     * @return array  
     */    
    public function getLastMessage(){
        return $this->message;
    }
    
    
    /**
     * Wipe the Message Array
     */ 
    public function clearLastMessage(){
        $this->message = null;
    }
    
    /**
     * Count the rounds
     */
    public function setRoundCount(){
        $this->round++;
    }
    
    /**
     * Get the Round count
     * @return int 
     */
    public function getRoundCount(){
        return $this->round;
    }
    
    /**
     * Get random figure for stings
     * @return int 
     */
    public function getStings(){
        return random_int (1,50);
        
    }
    
    
    
}
