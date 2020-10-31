<?php
namespace DAO;

use Models\Genre as Genre;


class GenreDAO implements IDAO{

    private $movieList = array();
    private $fileName;

    public function __construct(){
        $this->fileName = str_replace("\\", "/", dirname(__DIR__)) . "/Data/Genre.json";
    }

    public function getAll(){
        $this->retrieveDataFromAPI();
        if(empty($this->genreList)){        //si no funca la api, vamos con el json de backup
            $this->retrieveDataFromJSON();
        }
        return $this->genreList;
    }

    public function getAvailable(){    //esto no se para que es, es la misma funcion que getall
        $this->retrieveDataFromAPI();
        return $this->genreList;
    }

    public function Add($genre){      //esto no nos va a servir en nuestro caso, porque nosotros no agregamos manualmente
        $this->retrieveData();
        array_push($this->genreList, $genre);
        $this->saveData();
    }



    public function retrieveDataFromJSON(){
        $this->genreList = array();
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    $genre = new Genre();
                    $genre->setId($valueArray['id']);
                    $genre->setName($valueArray['name']);

                    
                    $this->genreList[$genre->getId()] = $genre;  
                    array_push($this->genreList, $genre);
                }
            }
        }
         
    }


    public function retrieveDataFromAPI(){
        $this->movieList = array();

            $jsonContent = file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=cbd53a3628e9ef7454e5890f33b974d8'); //guarda en jsoncontent un string con lo que te tira cada pagina
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();  //convierte ese string en un arreglo asociativo

            if (!empty($arrayToDecode)){                                       //si la api funciona, hay algo en el arreglo en posicion "results". si no funciona la api, esto deberia estar vacio o no existir
                foreach ($arrayToDecode['genres'] as $valueArray){                       //dentro de la posicion results hay un arreglo de movies. por eso el for each, para recorrerlo entero
                    $genre = new Genre();
                    $genre->setId($valueArray['id']);
                    $genre->setName($valueArray['name']);
                    
                    $this->genreList[$genre->getId()] = $genre;                                 //guardamos cada movie en la lista de movies, key = id, value = objeto movie
                }
            }

        $this->saveData();

    }



    
    public function updateData(){                        //cuando llamemos a esta funcion, agregar un mensaje que diga "movie database succesfully updated"
        $oldGenreList = retrieveDataFromJSON(); //lista desactualizada de pelis en nuestro json
        $newGenreList = retrieveDataFromAPI();  //conseguimos la lista nueva de la api
        if(empty($newGenreList)){
            echo ("La api está rota, intentar de nuevo mas tarde");    //si esta lista esta vacia, es porque no anda la api
        }else{
            foreach($newGenreList as $currentNewGenre){
                if(!$oldGenreList[$currentNewGenre->getId()]){
                    $oldGenreList[$currentNewGenre->getId()] = $currentNewGenre; //si no existe la pelicula, la agrega en key id
                }else{                                                           //si existe, actualiza los campos
                    $oldGenreList[$currentNewGenre->getId()]->setName($currentNewGenre['name']);
                }
            }
        }


    }



    public function saveData()
    {
        $arrayToEncode = array();

        foreach($this->genreList as $genre){

            $valueArray['id'] = $genre->getId();                                     //este id va a ser la key en el arreglo asociativo, y tambien va a estar en value POR LAS DUDAS
            $valueArray['name'] = $genre->getName();

            
            array_push($arrayToEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);

    }

    public function retrieveData(){  
        //this is compulsory since we're working with an interface
    }
}