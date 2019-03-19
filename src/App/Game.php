<?php
namespace Beegame;
use Beegame\Colony;

/**
 * Class Game
 * @author EM
 */

class Game
{
    const GAME_OVER = 'Game Over';
    const GAME_ACTIVE = 'active';


    /*
     * colony Object
     */
    public $colony;
    
    /*
     * Stores the status if colony is alive or dead
     */
    public $colonyAlive = true;
   
    
    /*
     * Stores the Game Status
     */
    public $gameStatus;
   
    
    
    public function __construct()
    {
        $this->gameStatus = self::GAME_ACTIVE; 
    }
    
   
    /**
     * Initializes the game with basic configuration and the game loop
     */
  
    public function initialize()
    {
           
        // Instantiate your new Colony  
        $this->colony = new Colony();
        // Start the play process
        $this->play();
    
    }
    
    public function play()
    {
        // Set welcome message
        $this->showWelcome();
        // Start Game Loop
        $this->gameLoop();
        // End Game and show Statistik
        $this->endGame();
    }
    
    /**
     * Shows the game title and welcome message
     */
    protected function showWelcome()
    {
            
        echo "\n****************************************************************** \n";    
        echo "Welcome to the Game \n";
        echo "Bees In The Trap \n";
        echo "****************************************************************** \n";    

    }
    
    /**
     * Runs the game loop till all the Bees are dead
     * or the Queen is dead
     */
    protected function gameLoop()
    {
        while($this->getGameStatus() == self::GAME_ACTIVE){
     
            $this->colonyAlive = $this->colony->attackColony();
       
            // Colony died end the Game
            if($this->colonyAlive === false){
                $this->gameOver(); 
            }
            
            if($this->colony->getLastMessage()){
                foreach($this->colony->getLastMessage() as $value){
                    echo $value ."\n";
                }
                $this->colony->clearLastMessage();
            }
             
        }
       
    }
    
    /**
     * Shows the End Result
     */
    public function endGame()
    {
         if($this->getGameStatus() == self::GAME_OVER){
            echo "\n****************************************************************** \n";    
            echo "It took ".$this->colony->getRoundCount()." hits to wipe out the colony.\n";
            echo "While attacking the Hive you got " .$this->colony->getStings(). " x stung. \nServes you right for attacking the colony :) \n";
            echo "****************************************************************** \n";    
        }
    }
    
    
    /**
     * Set the Game Status to game over
     */
    public function  gameOver()
    {
        $this->gameStatus = self::GAME_OVER;
    }
    
    
    /**
     * Get the Game Status
     * @return string contains the Game Status
     */
    public function getGameStatus(){
        return $this->gameStatus;
        
    }

}