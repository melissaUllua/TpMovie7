<?php
namespace DAO;

use Models\Movie as Movie;


class MovieDAO implements IDAO{

    private $movieList = array();
    private $fileName;

    public function __contruct(){
        $this->fileName = str_replace("\\", "/", dirname(__DIR__)) . "/Data/Movie.json";
    }

    public function getAll(){
        $this->retrieveDataFromAPI();
        if(empty($this->movieList)){        //si no funca la api, vamos con el json de backup
            $this->retrieveDataFromJSON();
        }
        return $this->movieList;
    }

    public function getAvailable(){    //esto no se para que es, es la misma funcion que getall
        $this->retrieveDataFromAPI();
        return $this->movieList;
    }

    public function Add($movie){      //esto no nos va a servir en nuestro caso, porque nosotros no agregamos manualmente
        $this->retrieveData();
        array_push($this->movieList, $movie);
        $this->saveData();
    }

    public function retrieveDataFromJSON(){
        $this->movieList = array();
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if (!empty($arrayToDecode)){
                foreach ($arrayToDecode as $valueArray){
                    $movie = new Movie();
                    $movie->setPopularity($valueArray['popularity']);
                    $movie->setVote_count($valueArray['vote_count']);
                    $movie->setVideo($valueArray['video']);
                    $movie->setPoster_path($valueArray['poster_path']);
                    $movie->setId($valueArray['id']);                                     //este id va a ser la key en el arreglo asociativo, y tambien va a estar en value POR LAS DUDAS
                    $movie->setAdult($valueArray['adult']);
                    $movie->setOriginal_Language($valueArray['original_language']);
                    $movie->setOriginal_title($valueArray['original_title']);
                    $movie->setGenre_ids($valueArray['genre_ids']);
                    $movie->setTitle($valueArray['title']);
                    $movie->setVote_average($valueArray['vote_average']);
                    $movie->setOverview($valueArray['overview']);
                    $movie->setRelease_date($valueArray['release_date']);
                    
                    $this->movieList[$movie->getId()] = $movie;  
                    array_push($this->movieList, $movie);
                }
            }
        }
         
    }

    public function retrieveDataFromAPI(){
        $this->movieList = array();
        $page = 1;
        $totalPages = 0;
        do{
            $jsonContent = file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=cbd53a3628e9ef7454e5890f33b974d8&page=' . $page); //guarda en jsoncontent un string con lo que te tira cada pagina
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();  //convierte ese string en un arreglo asociativo
            $totalPages = $arrayToDecode['total_pages'];                                  //tomamos el dato de totalpages para recorrer todas las paginas en el do while
            
            if (!empty($arrayToDecode['results'])){                                       //si la api funciona, hay algo en el arreglo en posicion "results". si no funciona la api, esto deberia estar vacio o no existir
                foreach ($arrayToDecode['results'] as $valueArray){                       //dentro de la posicion results hay un arreglo de movies. por eso el for each, para recorrerlo entero
                    $movie = new Movie();                                                 //creamos el objeto movie y le damos los datos
                    $movie->setPopularity($valueArray['popularity']);
                    $movie->setVote_count($valueArray['vote_count']);
                    $movie->setVideo($valueArray['video']);
                    $movie->setPoster_path($valueArray['poster_path']);
                    $movie->setId($valueArray['id']);                                     //este id va a ser la key en el arreglo asociativo, y tambien va a estar en value POR LAS DUDAS
                    $movie->setAdult($valueArray['adult']);
                    $movie->setOriginal_Language($valueArray['original_language']);
                    $movie->setOriginal_title($valueArray['original_title']);
                    $movie->setGenre_ids($valueArray['genre_ids']);
                    $movie->setTitle($valueArray['title']);
                    $movie->setVote_average($valueArray['vote_average']);
                    $movie->setOverview($valueArray['overview']);
                    $movie->setRelease_date($valueArray['release_date']);
                    
                    $this->movieList[$movie->getId()] = $movie;                                 //guardamos cada movie en la lista de movies, key = id, value = objeto movie
                    $page++;                                                              //contador, para que en la proxima iteracion vaya a la pag siguiente
                }
            }
        }while($page <= $totalPages);                                                     //recorre hasta la ultima pagina

        //var_dump($movieList);
    }

    
    public function updateData(){                        //cuando llamemos a esta funcion, agregar un mensaje que diga "movie database succesfully updated"
        $oldMovieList = retrieveDataFromJSON(); //lista desactualizada de pelis en nuestro json
        $newMovieList = retrieveDataFromAPI();  //conseguimos la lista nueva de la api
        if(empty($newMovieList)){
            echo ("La api está rota, intentar de nuevo mas tarde");    //si esta lista esta vacia, es porque no anda la api
        }else{
            foreach($newMovieList as $currentNewMovie){
                if(!$oldMovieList[$currentNewMovie->getId()]){
                    $oldmovieList[$currentNewMovie->getId()] = $currentNewMovie; //si no existe la pelicula, la agrega en key id
                }else{                                                           //si existe, actualiza los campos
                    $$oldMovieList[$currentNewMovie->getId()]->setPopularity($currentNewMovie['popularity']);
                    $$oldMovieList[$currentNewMovie->getId()]->setVote_count($currentNewMovie['vote_count']);
                    $$oldMovieList[$currentNewMovie->getId()]->setVideo($currentNewMovie['video']);
                    $$oldMovieList[$currentNewMovie->getId()]->setPoster_path($currentNewMovie['poster_path']);
                    $$oldMovieList[$currentNewMovie->getId()]->setAdult($currentNewMovie['adult']);
                    $$oldMovieList[$currentNewMovie->getId()]->setGenre_ids($currentNewMovie['genre_ids']);
                    $$oldMovieList[$currentNewMovie->getId()]->setTitle($currentNewMovie['title']);
                    $$oldMovieList[$currentNewMovie->getId()]->setVote_average($currentNewMovie['vote_average']);
                    $$oldMovieList[$currentNewMovie->getId()]->setOverview($currentNewMovie['overview']);
                    $$oldMovieList[$currentNewMovie->getId()]->setRelease_date($currentNewMovie['release_date']);
                }
            }
        }


    }



    public function saveData(){    //todavia no toque esta funcion
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

    public function retrieveData(){  
        //this is compulsory since we're working with an interface
    }
}