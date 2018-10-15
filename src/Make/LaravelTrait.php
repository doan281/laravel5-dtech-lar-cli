<?php

namespace Dtech\LaravelCLI\Make;

use Dtech\LaravelCLI\Handler\LaravelHandler;

/**
 *
 */
class LaravelTrait
{
    /**
     * Contain LaravelHandler instance Object
     *
     * @var LaravelHandler
     */
    private $handle;

    /**
     * Base folder for application
     *
     * @var string
     */
    private $baseFolder = 'app/Traits/';

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->handle = new LaravelHandler();
    }

    /**
     * Create file
     *
     * @param $name
     */
    public function create($name)
    {
        $this->handle->make('trait', $this->baseFolder . $name);
    }
}
