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
	private $_gun;
	private $_bonusShield;
	private $_bonusSpeed;
	private $_bonusShoot;
	private $_activated;
	private $_still;
    private $_xMin;
    private $_yMin;
    private $_xMax;
    private $_yMax;

	public static $verbose = false;

	use Dice;

	//MAGIC
	public function __construct(array $kw_arg)
	{
		$this->_init($kw_arg);

		if (self::$verbose)
			echo "Ship constructed.".PHP_EOL;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo "Ship destructed.".PHP_EOL;
	}

	//PUBLIC
	public function play(array $zboub)
	{
		$this->_order($zboub["order"]);
		$this->_move($zboub["move"]);
		$this->_shoot($zboub["shoot"]);

		$this->setBonusShield(0);
		$this->setBonusSpeed(0);
		$this->setBonusShoot(0);
		$this->setActivated(true);
	}

	//PRIVATE METHOD
	private function _init(array $kw_arg)
	{
		$this->setBonusShield(0);
		$this->setBonusSpeed(0);
		$this->setBonusShoot(0);

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
	}

	//order
	private function _order(array $order)
	{
		if (array_key_exists("repair", $order))
			$this->setPc($order["repair"] * $this->roll()); //be sure it's still

		if (array_key_exists("shield", $order))
			$this->setBonusShield($order["shield"]);

		if (array_key_exists("speed", $order))
			$this->setBonusSpeed($$order["speed"] * $this->roll());

		if (array_key_exists("shoot", $order))
			$this->setBonusShoot($order["shoot"] * $this->roll());

		return true;
	}

	//move
	private function _move(array $move)
	{
		//TODO
	}
	private function _bend($way) //TODO: edit w/h
	{
		//TODO
	}

	//shoot
	private function _shoot(array $shoot)
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
	public function getBonusShield()
	{
		return $this->_bonusShield;
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
    public function getXMin()
    {
        return $this->_xMin;
    }
    public function getYMin()
    {
        return $this->_yMin;
    }
    public function getXMax()
    {
        return $this->_xMax;
    }
    public function getYMax()
    {
        return $this->_yMax;
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
	public function setBonusShield($shield)
	{
		$this->_bonusShield = intval($shield);
	}
	public function setBonusSpeed($speed)
	{
		$this->_bonusSpeed = intval($speed);
	}
	public function setBonusShoot($shoot)
	{
		$this->_bonusShoot = intval($shoot);
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
    public function setXMin($x)
    {
        $this->_xMin = $x;
    }
    public function setYMin($y)
    {
        $this->_yMin = $y;
    }
    public function setXMax($x)
    {
        $this->_xMax = $x;
    }
    public function setYMax($y)
    {
        $this->_yMax = $y;
    }

}

?>