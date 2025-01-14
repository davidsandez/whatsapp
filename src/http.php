<?php

namespace Usuario\Prueba;

use GuzzleHttp\Client;

class Http 
{
    
    protected $client;
    protected $uri;
    protected $endpoint;
    protected $headers;
    protected $bearer;
    protected $method;
    protected $body;

    public function __construct($not_defined = null)
    {

        if ( !is_null($not_defined))
        {
            $this->client = new Client([
                // Base URI is used with relative requests
                'base_uri' => '/',
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
        }
    }

    public function set_url($url, $endpoint = null)
    {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $url,
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        $this->uri = $url;
        if ( !is_null($endpoint) )
            $this->endpoint = $endpoint;
        else 
            $this->endpoint = '/';
        return $this;
    }

    public function set_headers($headers)
    {
        $this->headers = $headers;
    }

    public function set_bearer($bearer)
    {
        $this->bearer = $bearer;
    }

    public function set_method($method)
    {
        $this->method = $method;
    }

    public function set_body($body)
    {
        $this->body = $body;
    }

    public function apply()
    {

        $METHOD = $this->method ?? 'GET';

        
        $response = $this->client->request(
                            $METHOD, 
                            $this->endpoint,
                            [
                                'headers'   => $this->headers,
                                'body'      => $this->body
                            ]
                        );
        return $response->getBody();
    }
}