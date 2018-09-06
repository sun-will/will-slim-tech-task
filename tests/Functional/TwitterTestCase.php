<?php

namespace Tests\Functional\Twitter;

use Tests\BaseTestCase;


class TwitterTestCase extends BaseTestCase {
    /**
     * Test that will return tweet per hour for given handlename
     */
    public function testGetUserOK() {
        $handleNameOk = 'ufc';
        $response = $this->runApp('GET', '/histogram/'.$handleNameOk.'/');
        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('tweet per hour', $body);
    }

    /**
     * Test that will return 404 for any non existing handle name
     */
    public function testGetUserNotFound() {
        $handleNameNotFound = 'hopefullythishandlenameisnotavailable1234';
        $response = $this->runApp('GET', '/histogram/'.$handleNameNotFound.'/');
        $this->assertEquals(404, $response->getStatusCode());
    }
}
