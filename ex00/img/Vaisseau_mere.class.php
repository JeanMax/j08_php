<?php

require_once("Ship.class.php");

class Vaisseau_mere extends Ship
{

	//MAGIC
	public function __construct()
	{
		$this->init(array("name" => "vaisseau_mere",
						   "spriteup" => "img/vaisseau_mereUP.png",
						   "spritedown" => "img/vaisseau_mereDOWN.png",
						   "spriteleft" => "img/vaisseau_mereLEFT.png",
						   "spriteright" => "img/vaisseau_mereRIGHT.png",
						   "gun" => New Laser(),
                           "xmin" => 10,
                           "ymin" => 10,
                           "xmax" => 20,
                           "ymax" => 14,
                           "activated" => false));
        

		if (self::$verbose)
			echo "Vaisseau_mere constructed.".PHP_EOL;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo "Vaisseau_mere destructed.".PHP_EOL;
	}
}

?>