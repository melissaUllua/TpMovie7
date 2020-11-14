<?php 

namespace Models;

class Ticket{
    private $TicketShow;
    private $TicketId;
    private $Purchase;
    private $User;
    

    public function getTicketShow()
    {
        return $this->ShowId;
    }

    public function setTicketShow($Show)
    {
        $this->Show = $Show;

    }

 
    public function getTicketTicketId()
    {
        return $this->ShowTicketId;
    }
    public function setTicketTicketId($TicketId)
    {
        $this->Show = $TicketId;

    }

    public function getTicketPurchase()
    {
        return $this->Showpurchase;
    }
    public function setTicketPurchase($purchase)
    {
        $this->Show = $purchase;

    }
    public function getTicketUser()
    {
        return $this->ShowUser;
    }
    public function setTicketUser($User)
    {
        $this->Show = $User;

    }
}

?>