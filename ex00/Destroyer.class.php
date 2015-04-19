<?php

require_once("Ship.class.php");

class Destroyer extends Ship
{

	//MAGIC
	public function __construct()
	{
		$this->init(array("name" => "Destroyer",
						   "spriteup" => "img/destroyerUP.png",
						   "spritedown" => "img/destroyerDOWN.png",
						   "spriteleft" => "img/destroyerLEFT.png",
						   "spriteright" => "img/destroyerRIGHT.png",
						   "gun" => New Laser(),
                           "xmin" => 1,
                           "ymin" => 7,
                           "xmax" => 11,
                           "ymax" => 9,
                           "activated" => false));
        

		if (self::$verbose)
			echo "Destroyer constructed.".PHP_EOL;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo "Destroyer destructed.".PHP_EOL;
	}
}

?>