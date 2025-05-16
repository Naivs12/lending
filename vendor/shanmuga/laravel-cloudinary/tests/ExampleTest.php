<?php

namespace Shanmuga3\Cloudinary\Tests;

use Orchestra\Testbench\TestCase;
use Shanmuga3\Cloudinary\CloudinaryServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [CloudinaryServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
