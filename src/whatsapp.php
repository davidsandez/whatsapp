<?php 

namespace Usuario\Prueba;

class Whatsapp
{

    protected $http;
    protected $url;
    protected $endpoint;
    protected $headers;
    protected $method;
    protected $body;

    public function __construct()
    {
        $this->http = new Http();
        $this->set_url();
    }

    public function set_url()
    {
        $meta_id = $_ENV['META_ID'];
        $version = 'v21.0';

        $URI = "https://graph.facebook.com";
        $endpoint =  "/"
                    . $version . "/" 
                    . $meta_id
                    . "/messages";

        $this->url = $URI;
        $this->endpoint = $endpoint;
        $this->http = $this->http->set_url($URI, $endpoint);
    }

    public function set_headers()
    {

        $TOKEN = $_ENV['META_TOKEN'];
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $TOKEN
        ];

        $this->http->set_headers($this->headers);
    }

    public function set_method()
    {
        $this->method = 'POST';
        $this->http->set_method($this->method);
    }

    public function set_body()
    {
        $body = [
            
            "messaging_product" => "whatsapp", 
            "to"        => "543855361740", 
            "type"      => "template", 
            "template"  => 
                [ 
                    "name"      => "prueba", 
                    "language"  => [ "code" => "es_ar" ] 
                ] 

        ];
        $this->body = json_encode($body);

        echo $this->body . '\n';
        $this->http->set_body($this->body);
    }

    public function apply()
    {
        $this->set_method();
        $this->set_headers();
        $this->set_body();
        var_dump($this->http);
        //return;
        var_dump( $this->http->apply() );
    }
}