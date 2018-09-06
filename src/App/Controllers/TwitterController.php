<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Services\TwitterService;
use App\Exceptions\ErrorHandler;

class TwitterController {

    private $service;

    public function __construct() {
        $this->service = new TwitterService();
    }

    public function getService(): TwitterService {
        return $this->service;
    }

    public function setService(TwitterService $service) {
        $this->service = $service;
    }

    public function show(Request $request, Response $response, array $args) {
        $userName = $args['name'];
        $data = $this->service->fetchTweets($userName);
        $result = $this->_processTwitterData($data);
        if (empty($result)) {
            $errorHandler = new ErrorHandler(true);
            return $errorHandler->__invoke(
                $request,
                $response,
                new \Exception()
            );
        }
        return $response->withJson(['tweet per hour' => $result]);
    }

    private function _processTwitterData($data): array {
        $result = array();
        foreach ($data as $value) {
            if (isset($value->created_at)) {
                $dt = \DateTime::createFromFormat('D M d H:i:s O Y', $value->created_at);
                $date = $dt->format('Y-m-d');
                $hour = $dt->format('H');
                if (isset($result[$date][$hour])) {
                    $result[$date][$hour]++;
                } else {
                    $result[$date][$hour] = 1;
                }
            }
        }
        return $result;
    }
}