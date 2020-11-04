<?php 
namespace Models;

class Show{
    private $ShowId;
    private $ShowDate;
    private $ShowTime;
    private $ShowMovie;
    private $ShowRoom;


    /**
     * Get the value of ShowId
     */ 
    public function getShowId()
    {
        return $this->ShowId;
    }

    /**
     * Set the value of ShowId
     *
     * @return  self
     */ 
    public function setShowId($ShowId)
    {
        $this->ShowId = $ShowId;

        return $this;
    }

    /**
     * Get the value of ShowDate
     */ 
    public function getShowDate()
    {
        return $this->ShowDate;
    }

    /**
     * Set the value of ShowDate
     *
     * @return  self
     */ 
    public function setShowDate($ShowDate)
    {
        $this->ShowDate = $ShowDate;

        return $this;
    }

    /**
     * Get the value of ShowMovie
     */ 
    public function getShowMovie()
    {
        return $this->ShowMovie;
    }

    /**
     * Set the value of ShowMovie
     *
     * @return  self
     */ 
    public function setShowMovie($ShowMovie)
    {
        $this->ShowMovie = $ShowMovie;

        return $this;
    }

    /**
     * Get the value of ShowRoom
     */ 
    public function getShowRoom()
    {
        return $this->ShowRoom;
    }

    /**
     * Set the value of ShowRoom
     *
     * @return  self
     */ 
    public function setShowRoom($ShowRoom)
    {
        $this->ShowRoom = $ShowRoom;

        return $this;
    }

    /**
     * Get the value of ShowTime
     */ 
    public function getShowTime()
    {
        return $this->ShowTime;
    }

    /**
     * Set the value of ShowTime
     *
     * @return  self
     */ 
    public function setShowTime($ShowTime)
    {
        $this->ShowTime = $ShowTime;

        return $this;
    }
}
   