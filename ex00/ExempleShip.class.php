<?php

require_once("Ship.class.php");

class ExempleShip extends Ship
{

	//MAGIC
	public function __construct()
	{
		$this->init(array("name" => "Zboub",
						   "sprite" => "img/vaisseau_mere.png",
						   "gun" => New ExempleGun(),
                           "xmin" => 10,
                           "ymin" => 10,
                           "xmax" => 20,
                           "ymax" => 14));
        

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