<?php

class Player implements IPlayer
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

	public function play()
	{
		if (!$this->isAlive())
			return false;
/*TODO: 
		while ($this->canPlay())
		{
			let me choose a $ship
			if ($ship->getStill())
			{
				let me fill an $order array = array('speed':int,
												    'shoot':int,
										            'shield':int,
											        'repair':int)
			}
			else		
			{
				let me fill an $order array = array('speed':int,
													'shoot':int,
                                                    'shield':int)
			}
			let me fill a $move array = ()
			let me fill a $shoot array = ()
			if 'the pp spent are ok)
				$ship->play(array(	'order' => $order,
									'move' => $move,
									'shoot' => $shoot));
		}
*/
		return true;
	}

	public function isAlive()
	{
		$ships = $this->getShips();

		foreach ($ships as $key => $ship)
		{
			$ship->setActivated(false); //cleaning activation
			if ($ship->getPc() <= 0)
				unset($ships[$key]); //cleaning dead ship
		}

		if (count($this->getShips()) == 0)
			return false;
		else
			return true;
	}

	public function canPlay()
	{
		foreach ($ships as $ship)
			if (!$ship->getActivated())
				return true;
		return false;
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