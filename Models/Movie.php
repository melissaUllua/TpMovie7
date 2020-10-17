<?php 
namespace model;

class Movie{
	
	private $popularity;
	private $vote_count;
	private $video;
	private $poster_path;
	private $id;
	private $adult;
	private $original_language;
	private $original_title;
	private $genre_ids;
	private $title;
	private $vote_average;
	private $overview;
	private $release_date;

	function __construct($popularity, $vote_count, $video, $poster_path, $id, $adult, $original_language, $original_title, $genre_ids, $title, $vote_average, $overview, $release_date){
		$this->popularity = $popularity;
		$this->vote_count = $vote_count;
		$this->video = $video;
		$this->poster_path = $poster_path;
		$this->id = $id;
		$this->adult = $adult;
		$this->original_language = $original_language;
		$this->original_title = $original_title;
		$this->genre_ids = $genre_ids;
		$this->title = $title;
		$this->vote_average = $vote_average;
		$this->overview = $overview;
		$this->release_date = $release_date;
		
		
	}
	public function getOriginalTitle(){
		return $this->original_title;

	}
	public function getOriginalLanguage(){
		return $this->original_language;
	}
	public function getRelease_date(){
		return $this->release_date;
	}
	public function getId(){
		return $this->id;
	}
	public function setTitle($title){
		$this->title = $title;
	}
	public function setOriginalLanguage($original_language){
		$this->original_language = $original_language;
	}
	public function setReleaseDate($release_date){
		$this->release_date = $release_date;
	}
	public function setId($id){
		$this->type = $id;
	}
}
 ?>