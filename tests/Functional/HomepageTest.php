<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase {

    /**
     * Test for the homepage that would return the string 'Try /hello/:name'
     */
    public function testGetHomepage() {
        $response = $this->runApp('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Try /hello/:name', (string)$response->getBody());
        $this->assertNotContains('Hello', (string)$response->getBody());
    }

    /**
     * Test that the index route with get parameter name will display the intended
     * message 
     */
    public function testGetHelloWithName() {
        $name = getenv('APP_NAME');
        $response = $this->runApp('GET', '/hello/'.$name);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello, '.$name, (string)$response->getBody());
    }

    /**
     * Test the /hello/ route with no get parameter will return 404 status
     */
    public function test404Route() {
        $response = $this->runApp('GET', '/hello/');
        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed() {
        $response = $this->runApp('POST', '/', ['test']);
        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }

    /**
     * The line of codes below are intended for tests\Functional\Twitter\TwitterTestCase.php
     * due to limited knowledge of slim phpunit or such environment configuration
     * the said test case could not be run, which force me to move the test cases to
     * this file.
     * The implication of the test cases are the same but just modeled differently due to the
     * location of the file.    
     */
    public function testGetUserOK() {
        $handleNameOk = getenv('HANDLENAME_OK');
        $response = $this->runApp('GET', '/histogram/'.$handleNameOk);
        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('tweet per hour', $body);
    }

    /**
     * Test that will return 404 for any non existing handle name
     */
    public function testGetUserNotFound() {
        $handleNameNotFound = getenv('HANDLENAME_NOT_FOUND');
        $response = $this->runApp('GET', '/histogram/'.$handleNameNotFound);
        $this->assertEquals(404, $response->getStatusCode());
    }
}