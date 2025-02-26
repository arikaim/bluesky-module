<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Bluesky\Drivers;

use Atproto\Client;
use Arikaim\Modules\Bluesky\BskyFacade;

use Arikaim\Core\Driver\Traits\Driver;
use Arikaim\Core\Interfaces\Driver\DriverInterface;

/**
 * BlueSky api driver class
 */
class BlueskyDriver implements DriverInterface
{   
    use Driver;

    /**
     * Api client
     *
     * @var object|null
     */
    protected $client;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDriverParams('bluesky','api','BlueSKy Api','BlueSky Api driver');      
    }

    /**
     * Initialize driver
     *
     * @return void
     */
    public function initDriver($properties)
    {
        $this->client = new Client();  
        $this->client->authenticate(
            $properties->getValue('identifier'),
            $properties->getValue('password'),
        );
        
    }

    /**
     * Get client
     * @return object|null
     */
    public function client(): ?object
    {
        return $this->client;
    }

    /**
     * BlueSky facede
     * @return BskyFacade
     */
    public function bluesky()
    {
        return BskyFacade::getInstance($this->client);
    }

    /**
     * Get user id
     */
    public function userId()
    {
        return $this->client->authenticated()->did();
    }

    /**
     * Get auth handle
     */
    public function handle()
    {
        return $this->client->authenticated()->handle();
    }

    /**
     * Create driver config properties array
     *
     * @param \Arikaim\Core\Collection\Properties $properties
     * @return void
     */
    public function createDriverConfig($properties)
    {
        $properties->property('identifier',function($property) {
            $property
                ->title('Identifier')
                ->type('text')   
                ->required(true)           
                ->value('');                         
        }); 

        $properties->property('password',function($property) {
            $property
                ->title('Password')
                ->type('key')   
                ->required(true)           
                ->value('');                         
        }); 
    }
}
