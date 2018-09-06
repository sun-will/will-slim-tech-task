<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Services\TwitterService;
use App\Exceptions\ErrorHandler;
use Respect\Validation\Validator as v;

class TwitterController {

    /** @var \App\Validation\Validator */
    private $validator;
    /** @var \App\Services\TwitterService */
    private $service;
    /** @var \App\Exceptoins\ErrorHandler */
    private $errorHandler;


    public function __construct(\Slim\Container $container) {
        $this->service = new TwitterService();
        $this->validator = $container->get('validator');
        $this->errorHandler = $container->get('errorHandler');
    }

    public function getService(): TwitterService {
        return $this->service;
    }

    public function setService(TwitterService $service) {
        $this->service = $service;
    }

    /**
     * Show the Tweets per user
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return wild
     */
    public function show(Request $request, Response $response, array $args) {
        $userName = $args['name'];
        $this->validator->validate($userName,
            [
                'name'   => v::notEmpty(),
                'name'   => v::alnum(),
                'name'   => v::NoWhitespace(),
            ]);

        if ($this->validator->failed()) {
            return $response->withJson(['errors' => $this->validator->getErrors()], 422);
        }
        $data = $this->service->fetchTweets($userName);
        $result = $this->_processTwitterData($data);
        if (empty($result)) {
            return $this->errorHandler->invoke(
                $request,
                $response,
                new \Exception()
            );
        }
        return $response->withJson(['tweet per hour' => $result]);
    }

    /**
     * Process the twitter data
     *
     * @param wild $data
     *
     * @return array $result
     */
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