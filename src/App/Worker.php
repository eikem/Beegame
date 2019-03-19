<?php
namespace Beegame;

class Worker extends Bee
{
    protected $beeType = 'Worker';
    
    /**
     * Lifespan of the Worker on start
     * @var int
     */
    protected $lifespan = 75;

    /**
     * Points deducted when hit
     * @var int
     */
    protected $hitPoints = 10;
}
