<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Bluesky;

use Arikaim\Core\Extension\Module;

/**
 * BlueSky Api client module class
 */
class Bluesky extends Module
{
    /**
     * Install module
     *
     * @return void
     */
    public function install()
    {
        $this->installDriver('Arikaim\\Modules\\Bluesky\\Drivers\\BlueskyDriver');
        $this->registerConsoleCommand('BlueskyAccountInfo');
    }
}
