<?php
namespace Beegame;

class Queen extends Bee
{
    protected $beeType = 'Queen';
    
    /**
     * Lifespan of the Queen on start
     * @var int
     */
    protected $lifespan = 100;

    /**
     * Points deducted when hit
     * @var int
     */
    protected $hitPoints = 8;
}
