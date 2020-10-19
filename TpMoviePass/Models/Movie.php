<?php 
namespace Models;

class Movie{
	
	private $popularity;
	private $vote_count;
	private $video;
	private $poster_path;
	private $id;
	private $adult;
	private $original_language;
	private $original_title;
	private $genre_ids = array();
	private $title;
	private $vote_average;
	private $overview;
	private $release_date;

	function __construct($popularity = "", $vote_count = "", $video = "", $poster_path = "", $id = "", $adult = "", $original_language = "", $original_title = "", $genre_ids = "", $title = "", $vote_average = "", $overview = "", $release_date = ""){
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

	public function getPopularity(){
		return $this->popularity;
	}

	public function setPopularity($popularity){
		$this->popularity = $popularity;
	}

	public function getVote_count(){
		return $this->vote_count;
	}

	public function setVote_count($vote_count){
		$this->vote_count = $vote_count;
	}

	public function getVideo(){
		return $this->video;
	}

	public function setVideo($video){
		$this->video = $video;
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

	public function getGenre_ids(){
		return $this->genre_ids;
	}

	public function setGenre_ids($genre_ids){
		$this->genre_ids = $genre_ids;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getVote_average(){
		return $this->vote_average;
	}

	public function setVote_average($vote_average){
		$this->vote_average = $vote_average;
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
}
 ?>