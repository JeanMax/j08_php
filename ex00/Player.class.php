<?php

class Player
{
    private $_ships;

    public static $verbose = false;

    //MAGIC
    public function __construct(array $ships)
    {
		$this->_ships = array();
		$this->addShips($ships);

		if (self::$verbose)
			echo "Player constructed.".PHP_EOL;
	}

	public function __destruct(array $ships)
	{
		if (self::$verbose)
			echo "Player destructed.".PHP_EOL;
	}

	//PUBLIC METHOD
	public function isAlive()
	{
		$ships = $this->getShips();

		foreach ($ships as $key => $ship)
			if ($ship->getPc() <= 0)
				unset($ships[$key]); //cleaning dead ship

		if (count($this->getShips()) == 0)
			return false;
		else
			return true;
	}

	//GET
	public function getShips()
	{
		return $this->_ships;
	}

	//SET
	public function addShips($ships)
	{
		foreach ($ships as $ship)
			array_push($this->_ships, $ship);
	}

}

?>