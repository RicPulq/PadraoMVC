<?php
declare(strict_types=1);
namespace Alura\MVC\Entity;

use InvalidArgumentException;

class Video{
    public readonly string $url;
    public int $id;
    
    public function __construct(
        string $url,
        public readonly string $titulo,
    ){
        // $this->setID($id);
        $this->setUrl($url);
        // $this->setTitulo($titulo);
    }
    private function setUrl(string $url){
        if (filter_var($url, FILTER_VALIDATE_URL) === false){
            throw new InvalidArgumentException();
        }

        $this->url = $url;
    }

    // private function setTitulo(string $titulo){
    //     if (is_string($titulo) === false ){
    //         throw new InvalidArgumentException();
    //     }

    //     $this->titulo = $titulo;
    // }

    public function setId(int $id){
        if (filter_var($id, FILTER_VALIDATE_INT) === false){
            throw new InvalidArgumentException();
        }

        $this->id = $id;
    }
}