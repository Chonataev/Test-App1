<?php 
namespace app\core;

class Request{
    public function getUrl()
    {
        $path = $_SERVER["REQUEST_URI"] ?? false;
        $position = strpos($path ,'?');
        if($position === false){
            return $path;
        }
        return substr($path,0,$position);
    }

    public function getDetail()
    {
        $path = $_SERVER["REQUEST_URI"] ?? false;
        $position = explode('?' ,$path);
        return $position[1];
    }

    public function getDetails()
    {
        $path = $_SERVER["REQUEST_URI"] ?? false;
        $position = explode('&' ,$path);
        return $position[1];
    }

    public function getMethod()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    public function getBody()
    {
        if($this->getMethod() === 'get')
        {
            foreach($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if($this->getMethod() === 'post')
        {
            foreach($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                
            }
        }
         return $body;
    }
}