<?php

require_once("Ship.class.php");

class ExempleShip extends Ship
{

	//MAGIC
	public function __construct()
	{
		$this->_init(array("name" => "Zboub",
						   "sprite" => ":-",
						   "gun" => New ExempleGun()));

		if (self::$verbose)
			echo "ExempleShip constructed.".PHP_EOL;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo "ExempleShip destructed.".PHP_EOL;
	}
}

?>