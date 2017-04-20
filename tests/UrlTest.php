<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UrlTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testIndexForNoValue()
    {
        $this->get('/api/v1/urls')
             ->seeJsonStructure([]);
    }

    public function testCreateUrlWithWrongData()
    {
    	$this->json('POST', '/api/v1/urls', ["desktop_url" => "", "mobile_url" => ""])
    	     ->seeJsonStructure([
                'error'
             ]);
    }

    public function testCreateUrl()
    {
    	$response = $this->json('POST', '/api/v1/urls', ["desktop_url" => "https://youthsm.wordpress.com", "mobile_url" => "https://github.com/aavrug"]);
		$response->assertResponseStatus(200);
    }

    public function testIndex()
    {
        $this->get('/api/v1/urls')
             ->seeJsonStructure([
                     ['short_url', 'pc_target_url', 'mobile_target_url', 'pc_redirects', 'mobile_redirects', 'created_at']
             ]);
    }
}
