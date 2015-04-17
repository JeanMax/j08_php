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
	public function play(TODO);
/*
	call : order, movement, shoot

	set to false $ships->_activated

	return false if count($_ships) = 0
*/

	//order
	private function _order(array $order);
/*
	array(	'speed':int,
			'shoot':int,
			'shield':int,
			'repair':int)		
	value set as 0pp if no key
	return false if shit happened
*/

	//move
	private function _bend($way); //todo : edit w/h
	private function _move($length);
	//shoot
	private function _shoot();
	}

	?>