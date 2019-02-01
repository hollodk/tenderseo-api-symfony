<?php

namespace App;

class Client
{
    const baseUrl = 'https://www.tenderseo.com/api/';
    const baseTestUrl = 'http://localhost:8000/api/';

    private $key;
    private $isTest = false;

    public function __construct($params)
    {
        if (isset($params['test'])) {
            $this->isTest = $params['test'];
        }

        if (isset($params['key'])) {
            $this->key = $params['key'];
        }
    }

    public function status()
    {
        return $this->request('status');
    }

    public function signup($options)
    {
        return $this->request('signup', $options, 'post');
    }

    public function createArticle($options)
    {
        if (!$this->key) {
            throw new \Exception('You forgot to provide api key');
        }

        return $this->request('order/create', $options, 'post');
    }

    public function getOrder($options)
    {
        if (!$this->key) {
            throw new \Exception('You forgot to provide api key');
        }

        return $this->request('order', $options);
    }

    public function getArticle($uuid)
    {
        if (!$this->key) {
            throw new \Exception('You forgot to provide api key');
        }

        $options = [
            'uuid' => $uuid,
        ];

        return $this->request('article', $options);
    }

    public function getArticles($options)
    {
        if (!$this->key) {
            throw new \Exception('You forgot to provide api key');
        }

        $url = 'articles';

        return $this->request($url, $options);
    }

    private function request($suffix, $options=[], $method='get')
    {
        if ($this->key) {
            $options['key'] = $this->key;
        }

        if ($this->isTest) {
            $url = self::baseTestUrl.$suffix;
        } else {
            $url = self::baseUrl.$suffix;
        }

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request($method, $url, [
                'query' => $options,
            ]);

        } catch (\Exception $e) {
            $response = $e->getResponse();
        }

        return json_decode($response->getBody()->getContents());
    }
}
