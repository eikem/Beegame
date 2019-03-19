<?php 
namespace Beegame;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Beegame\Game;

/**
 * Author: Eike M
 */
class HitCommand extends SymfonyCommand
{
    
    public function configure()
    {
        $this -> setName('hit')
            -> setDescription('Will start the attack')
            -> setHelp('This command will start the attack at the Beehive.');
           
    }

  /**
     * Executes the game command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null null or 0 if everything went fine, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
       
        $game = new Game();
        $game->initialize();
        
        return 0;
    }
}
