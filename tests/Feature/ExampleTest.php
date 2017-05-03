<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicRouteTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        echo "get(/) route Works!!! \n";
    }
    public function test2BasicRouteTest()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
        echo "get(/dashboard) route Works!!! \n";
    }

    public function test3BasicRouteTest()
    {
        $response = $this->post('/signup');
        $response->assertStatus(302);
        echo "get(/signup) route Doesn`t work without validation!!! \n";
    }
    public function test4BasicRouteTest()
    {
        $response = $this->post('/signin');
        $response->assertStatus(302);
        echo "get(/signin) route doesn`t work without validation!!! \n";
    }

    public function test5BasicRouteTest()
    {
        $response = $this->get('/logout');
        $response->assertStatus(302);
        echo "get(/logout) route doesn`t work without validation!!! \n";
    }


}
