<?php
namespace DAO;

//use DAO\movieDAO as movieDAO; 

class MovieDAO implements IDAO{
    private $movieList = array();
    private $fileName;

    public function __contruct(){
        $this->fileName = str_replace("\\", "/", dirname(__DIR__)) . "/Data/Movie.json";
    }

    public function getAll(){
        $this->retrieveData();
        return $this->movieList;
    }

    public function getAvailable(){
        $this->retrieveData();
        return $this->movieList;
    }

    public function Add($movie){
        $this->retrieveData();
        array_push($this->movieList, $movie);
        $this->saveData();
    }

    public function retrieveData(){
        $this->movieList = array(); //porque voy a volver a cargarlos
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    $movie = new Movie();
                    $movie->setTitle($valueArray['Title']);
                    $movie->setRleaseDate($valueArray['RleaseDate']);
                    $movie->setOriginalLanguage($valueArray['OriginalLanguage']);
                   
                    array_push($this->movieList, $movie);
                }
            }
        }
         
    }

    public function saveData(){
        $arrayToEncode = array();
        foreach($this->movieList as $movie){
            
            $valueArray['Title'] =  $movie->getOriginalTitle();
            $valueArray['RleaseDate']= $movie->getRelease_date();
            $valueArray['OriginalLanguage'] = $movie->getOriginalLanguage();
            
            array_push($arrayToEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);

    }
}