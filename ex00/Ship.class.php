<?php

require_once("Dice.trait.php");
require_once("IShip.class.php");

class Ship implements IShip
{
    private $_name;
    private $_width;
    private $_height;
    private $_sprite;
	private $_pc; //point de coque
	private $_pp; //point moteur
	private $_speed;
	private $_maneuver;
	private $_shield;
	private $_gun;
	private $_activated;
	private $_still;

	public static $verbose = false;

	use Dice;

	//MAGIC
	public function __construct(array $kw_arg)
	{

		//needed
		$this->setName($kw_arg["name"]);
		$this->setSprite($kw_arg["sprite"]);
		$this->setGun($kw_arg["gun"]);

		//optionnal
		if (array_key_exists("pc", $kw_arg))
			$this->setPc($kw_arg["pc"]);
		else
			$this->setPc(5);

		if (array_key_exists("pp", $kw_arg))
			$this->setPp($kw_arg["pp"]);
		else
			$this->setPp(10);

		if (array_key_exists("speed", $kw_arg))
			$this->setSpeed($kw_arg["speed"]);
		else
			$this->setSpeed(15);

		if (array_key_exists("maneuver", $kw_arg))
			$this->setManeuver($kw_arg["maneuver"]);
		else
			$this->setManeuver(4);

		if (array_key_exists("shield", $kw_arg))
			$this->setShield($kw_arg["shield"]);
		else
			$this->setShield(0);

		if (array_key_exists("activated", $kw_arg))
			$this->setActivated($kw_arg["activated"]);
		else
			$this->setActivated(false);

		if (array_key_exists("still", $kw_arg))
			$this->setStill($kw_arg["still"]);
		else
			$this->setStill(true);

		if (array_key_exists("width", $kw_arg))
			$this->setWidth($kw_arg["width"]);
		else
			$this->setWidth(1);

		if (array_key_exists("height", $kw_arg))
			$this->setHeight($kw_arg["height"]);
		else
			$this->setHeight(4);

		if (self::$verbose)
			echo "Ship constructed.".PHP_EOL;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo "Ship destructed.".PHP_EOL;
	}

	//PRIVATE METHOD
	private function _order($ship)
	{

	}
	private function _movement($ship)
	{

	}
	private function _shoot($ship)
	{

	}

	//PUBLIC
	public function play(array $order,)
	{
		$ships = $this->getShips();

		foreach ($ships as $ship) // TODO: let the player choose...
		{
			$this->_order($ship);
			$this->_movement($ship);
			$this->_shoot($ship);
			$ship->setActivated(true);
		}

		foreach ($ships as $key => $ship)
		{
			$ship->setActivated(false); //cleaning activation
			if ($ship->getPc() <= 0)
				unset($ships[$key]); //cleaning dead ship
		}

	}

	//bonus METHOD
	/*
		the following bonus method will add bonus stats to the actual stats,
		so you may need to check return to sub the bonus at the end of player turn
		(except for repair, and shield since it's directly add the arg)
	*/
	public function bonusSpeed($pp)
	{
		$added = $pp * $this->roll();
		$this->setSpeed($this->getSpeed() + $added);
		return $added;
	}
	public function bonusGun($pp)
	{
		$gun = $this->getGun();
		$added = $pp * $this->roll();
		$gun->setLoad($gun->getLoad() + $added);
		return $added;
	}
	public function bonusRepair($pp)
	{
		if ($this->getStill())
			$this->setPc( $this->getPc() + ($pp * $this->roll()) );
	}
	public function bonusShield($pp)
	{
		$this->setShield($this->getShield() + $pp);
	}

	//move METHOD
	public function bend($way) //todo : edit w/h
	{
		//TODO
	}
	public function move($length)
	{
		//TODO
	}

	//shoot METHOD
	public function shoot()
	{
		//TODO
	}

	//GET
	public function getName()
	{
		return $this->_name;
	}
	public function getWidth()
	{
		return $this->_width;
	}
	public function getHeight()
	{
		return $this->_height;
	}
	public function getSprite()
	{
		return $this->_sprite;
	}
	public function getPc()
	{
		return $this->_pc;
	}
	public function getPp()
	{
		return $this->_pp;
	}
	public function getSpeed()
	{
		return $this->_speed;
	}
	public function getManeuver()
	{
		return $this->_maneuver;
	}
	public function getShield()
	{
		return $this->_shield;
	}
	public function getGun()
	{
		return $this->_gun;
	}
	public function getActivated()
	{
		return $this->_activated;
	}
	public function getStill()
	{
		return $this->_still;
	}

	//SET
	public function setName($name)
	{
		$this->_name = $name;
	}
	public function setWidth($width)
	{
		$this->_width = intval($width);
	}
	public function setHeight($height)
	{
		$this->_height = intval($height);
	}
	public function setSprite($sprite)
	{
		$this->_sprite = $sprite;
	}
	public function setPc($pc)
	{
		$this->_pc = intval($pc);
	}
	public function setPp($pp)
	{
		$this->_pp = intval($pp);
	}
	public function setSpeed($speed)
	{
		$this->_speed = intval($speed);
	}
	public function setManeuver($maneuver)
	{
		$this->_maneuver = intval($maneuver);
	}
	public function setShield($shield)
	{
		$this->_shield = intval($shield);
	}
	public function setGun($gun)
	{
		$this->_gun = $gun;
	}
	public function setActivated($activated)
	{
		$this->_activated = $activated;
	}
	public function setStill($still)
	{
		$this->_still = $still;
	}

}

?>