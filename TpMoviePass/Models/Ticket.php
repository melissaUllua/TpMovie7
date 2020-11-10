<?php 

namespace Models;

class Ticket{
    private $TicketShow;
    private $TicketSeatNumber;

    public function getTicketShow()
    {
        return $this->ShowId;
    }

    public function setTicketShow($Show)
    {
        $this->Show = $Show;

    }

 
    public function getTicketSeatNumber()
    {
        return $this->ShowSeatNumber;
    }
    public function setTicketSeatNumber($SeatNumber)
    {
        $this->Show = $SeatNumber;

    }


?>