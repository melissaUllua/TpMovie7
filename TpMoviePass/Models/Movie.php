<?php 
namespace Models;

class Movie{
	

	private $poster_path;
	private $id;
	private $adult;
	private $original_language;
	private $original_title;
	private $genresArray = array();
	private $title;
	private $overview;
	private $release_date;
	private $duration;


	function __construct($poster_path = "", $id = "", $adult = "", $original_language = "", $original_title = "", $genresArray = "", $title = "", $overview = "", $release_date = "", $duration = ""){

		$this->poster_path = $poster_path;
		$this->id = $id;
		$this->adult = $adult;
		$this->original_language = $original_language;
		$this->original_title = $original_title;
		$this->genresArray = $genresArray;
		$this->title = $title;
		$this->overview = $overview;
		$this->release_date = $release_date;
		$this->duration = $duration;

	
	}

	public function getPoster_path(){
		return $this->poster_path;
	}

	public function setPoster_path($poster_path){
		$this->poster_path = $poster_path;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getAdult(){
		return $this->adult;
	}

	public function setAdult($adult){
		$this->adult = $adult;
	}

	public function getOriginal_language(){
		return $this->original_language;
	}

	public function setOriginal_language($original_language){
		$this->original_language = $original_language;
	}

	public function getOriginal_title(){
		return $this->original_title;
	}

	public function setOriginal_title($original_title){
		$this->original_title = $original_title;
	}

	public function getGenresArray(){
		return $this->genresArray;
	}

	public function setGenresArray($genresArray){
		$this->genresArray = $genresArray;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}


	public function getOverview(){
		return $this->overview;
	}

	public function setOverview($overview){
		$this->overview = $overview;
	}

	public function getRelease_date(){
		return $this->release_date;
	}

	public function setRelease_date($release_date){
		$this->release_date = $release_date;
	}

	public function getDuration(){
		return $this->duration;
	}

	public function setDuration($duration){
		$this->duration = $duration;
	}
}
 ?>