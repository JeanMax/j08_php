<?php

class Player
{
    private $_ships;

    public static $verbose;

    //MAGIC
    public function __construct(array $ships)
    {


    }


    //PUBLIC METHOD
	public function play()
    {

    }
	/*
		call : order, movement, shoot

		set to false $ships->_activated

		return false if count($_ships) = 0
	*/

	private function order()
    {

    }
	private function movement()
    {

    }
	private function shoot()
    {

    }

    //GET
    public function getShips()
    {
        return $this->_ships;
    }

    //SET
    public function setShips(array $ships)
    {
        $this->_ships = $ships;
    }
    
}

?>