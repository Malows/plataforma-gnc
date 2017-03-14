<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LandingPageTest extends BrowserKitTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
            ->see( trans('message.platform_title') )
            ->see( trans('message.platform_nickname') )
            ->see( trans('message.platform_description') )
            ->see( trans('message.login') );
    }
}
