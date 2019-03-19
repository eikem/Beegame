<?php
namespace Beegame;

class Drone extends Bee
{
     protected $beeType = 'Drone';
    
    /**
     * Lifespan of the Drone on start
     * @var int
     */
    protected $lifespan = 50;

    /**
     * Points deducted when hit
     * @var int
     */
    protected $hitPoints = 12;

   
   
}
