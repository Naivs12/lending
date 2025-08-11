<?php

/**
 * This file is part of Laravel Cloudinary,
 * Cloudinary wrapper for Laravel Application.
 *
 * @license     MIT
 * @package     Shanmuga\LaravelCloudinary
 * @category    Facade
 * @author      Shanmugarajan
 */

namespace Shanmuga\LaravelCloudinary\Facades;

use Illuminate\Support\Facades\Facade;

class CloudinaryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel_cloudinary';
    }
}
