<?php

require_once("Dice.trait.php");

interface IShip
{
    /*
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

		public static $verbose;
	*/

	//MAGIC
	public function __construct(array $kw_arg);

	//PUBLIC
	//bonus
	public function bonusSpeed($pp);
	public function bonusShield($pp);
	public function bonusGun($pp);
	public function bonusRepair($pp);

	public function play();
/*
	call : order, movement, shoot

	set to false $ships->_activated

	return false if count($_ships) = 0
*/

    private function _order($ship);
    private function _movement($ship);
    private function _shoot($ship);

	//move
	public function bend($way); //todo : edit w/h
	public function move($length);

	//shoot
	public function shoot();
}

?>