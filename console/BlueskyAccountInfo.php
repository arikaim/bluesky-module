<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
 */
namespace Arikaim\Modules\Bluesky\Console;

use Arikaim\Core\Console\ConsoleCommand;

/**
 * BlueSky account info command
 */
class BlueskyAccountInfo extends ConsoleCommand
{  
    /**
     * Configure command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('bluesky:users:me');
        $this->setDescription('BlueSky account info');               
    }

    /**
     * Run command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function executeCommand($input,$output)
    {
        global $arikaim;

        $this->showTitle();

        $driver = $arikaim->get('driver')->create('bluesky');
       
        $resposne = $driver
            ->bluesky()
            ->getProfile()
            ->actor($driver->handle())
            ->send();
        
        $profile = $resposne->jsonSerialize();

        print_r($profile);
        
        $this->showCompleted();
    }
}
