<?PHP

require_once('IZone.class.php');

class Zone implements IZone
{
	private $_width;
    private $_height;
    private $_map; //array
	private $_p1;
	private $_p2;
	private $_Xmin;
	private $_Xmax;
	private $_Ymin;
	private $_Ymax;


	public static $verbose = false;

	//MAGIC
	public function __construct(array $kw_arg)
	{
		if (array_key_exists("width", $kw_arg))
			$this->setWidth($kw_arg["width"]);
		else
			$this->setWidth(150);

		if (array_key_exists("height", $kw_arg))
			$this->setHeight($kw_arg["height"]);
		else
			$this->setHeight(100);

		if (array_key_exists("obstacle", $kw_arg))
			$this->setMap($this->getHeight(), $this->getWidth(), $kw_arg["obstacle"]);
		else
			$this->setMap($this->getHeight(), $this->getWidth(), array());

		if (array_key_exists("p1", $kw_arg))
			$this->setP1($kw_arg["p1"]);
		else
			$this->setP1(null);

		if (array_key_exists("p2", $kw_arg))
			$this->setP2($kw_arg["p2"]);
		else
			$this->setP2(null);

		if (self::$verbose)
			echo "Zone constructed.".PHP_EOL;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo "Zone destructed.".PHP_EOL;
	}


	//PUBLIC
	public function canMoveMap($move, $indShip, $Player)
	{
		if ($Player == 1)
		{
		}
		else
		{
		}
	}

	public	 function aff_map()
	{
		echo '<table>';

		$p1Ships = $this->getP1()->getShips();
		$p2Ships = $this->getP2()->getShips();

		foreach($p1Ships as $ship)
		{
			$X = 12 * $ship->getXMin();
			$Y = 12 * $ship->getYMin();
			$SX = 12 * ($ship->getXMax() - $ship->getXMin() + 1) - 1;
			$SY = 12 * ($ship->getYMax() - $ship->getYMin() + 1) - 1;

			echo '<img src= '.$ship->getSprite().' style="background-color:red; left:'.$X.'px; top:'.$Y.'px; width:'.$SX.'px;height:'.$SY.'px;" alt="Vaisse11" class="vais">';
		}

		foreach($p2Ships as $ship2)
		{
			$X = 12 * $ship2->getXMin();
			$Y = 12 * $ship2->getYMin();
			$SX = 12 * ($ship2->getXMax() - $ship2->getXMin() + 1) - 1;
			$SY = 12 * ($ship2->getYMax() - $ship2->getYMin() + 1) - 1;

			echo '<img src= '.$ship2->getSprite().' style="background-color:blue; left:'.$X.'px; top:'.$Y.'px; width:'.$SX.'px;height:'.$SY.'px;" alt="Vaisse11" class="vais">';
		}

		echo '<img src="img/asteroidBig01.png" alt="asteroid" class="asteroid">';
		echo '<img src="img/asteroidBig01.png" alt="asteroid" class="asteroid1">';
		echo '<img src="img/asteroidBig01.png" alt="asteroid" class="asteroid2">';
		echo '<img src="img/asteroidBig01.png" alt="asteroid" class="asteroid3">';

		$y = 0;

		while ($y < 100)
		{
			echo '<tr>';
			$x = 0;
			while ($x < 150)
			{
				echo '<td class = "black" ></td>';
				$x++;
			}
			echo '</tr>';
			$y++;
		}
		echo '</table>';
	}

	//PRIVATE
	private function InitPos($Player, $indShip)
	{
		if ($Player == 1)
		{
			$this->_Xmin = $this->_p1->getShips()[$indShip]->getXmin();
			$this->_Xmax = $this->_p1->getShips()[$indShip]->getXmax();
			$this->_Ymin = $this->_p1->getShips()[$indShip]->getYmin();
			$this->_Ymax = $this->_p1->getShips()[$indShip]->getYmax();
		}
		else
		{
			$this->_Xmin = $this->_p2->getShips()[$indShip]->getXmin();
			$this->_Xmax = $this->_p2->getShips()[$indShip]->getXmax();
			$this->_Ymin = $this->_p2->getShips()[$indShip]->getYmin();
			$this->_Ymax = $this->_p2->getShips()[$indShip]->getYmax();
		}

	}

	private function DeleteShip($Player, $indShip)
	{
		if ($Player == 1)
			$this->_p1->setShips($this->_p1->getShips()[$indShip]->setPc(0));
		else
			$this->_p2->setShips($this->_p2->getShips()[$indShip]->setPc(0));
		return -1;
	}

	private function MoveLeft($move, $indShip, $Player)
	{
		$this->InitPos($Player, $indShip);
		$posend = $this->_Xmin - $move;
		while ($this->_Xmin > $posend)
		{
			$this->_Xmin--;
			if ($this->Xmin == -1)
				return $this->DeleteShip($Player, $indShip);
			if ($this->CheckObs($this->_Xmax, $this->_Xmin, $this->_Ymax, $this->_Ymin) == false)
				return $this->DeleteShip($Player, $indShip);
			if ($this->CheckShip($this->_Xmax, $this->_Xmin, $this->_Ymax, $this->_Ymin) == false)
				return -2;
		}
		return true;
	}

	private function MoveRight($move, $indShip, $Player)
    {
        $this->InitPos($Player, $indShip);
        $posend = $this->_Xmax + $move;
        while ($this->_Xmax < $posend)
        {
            $this->_Xmax++;
            if ($this->Xmax == 150)
                return $this->DeleteShip($Player, $indShip);
            if ($this->CheckObs($this->_Xmax, $this->_Xmin, $this->_Ymax, $this->_Ymin) == false)
                return $this->DeleteShip($Player, $indShip);
            if ($this->CheckShip($this->_Xmax, $this->_Xmin, $this->_Ymax, $this->_Ymin) == false)
                return -2;
        }
        return true;
    }

	private function MoveTop($move, $indShip, $Player)
    {
        $this->InitPos($Player, $indShip);
        $posend = $this->_Ymin - $move;
        while ($this->_Ymin > $posend)
        {
            $this->_Ymin--;
            if ($this->Ymin == -1)
                return $this->DeleteShip($Player, $indShip);
            if ($this->CheckObs($this->_Xmax, $this->_Xmin, $this->_Ymax, $this->_Ymin) == false)
                return $this->DeleteShip($Player, $indShip);
            if ($this->CheckShip($this->_Xmax, $this->_Xmin, $this->_Ymax, $this->_Ymin) == false)
                return -2;
        }
        return true;
    }
	
	private function MoveBottom($move, $indShip, $Player)
    {
		$this->InitPos($Player, $indShip);
        $posend = $this->_Ymax + $move;
        while ($this->_Ymax < $posend)
        {
            $this->_Ymax++;
            if ($this->Ymax == 150)
                return $this->DeleteShip($Player, $indShip, $Vue);
            if ($this->CheckObs($this->_Xmax, $this->_Xmin, $this->_Ymax, $this->_Ymin) == false)
                return $this->DeleteShip($Player, $indShip, $Vue);
            if ($this->CheckShip($this->_Xmax, $this->_Xmin, $this->_Ymax, $this->_Ymin) == false)
                return -2;
        }
        return true;
    }

	private function CheckObs($Xmax, $Xmin, $Ymax, $Ymin)
	{
		foreach($this->_obstacles as $obs)
		{
			if ($Xmin <= $obs['Xmax'] || $Xmax >= $obs['Xmin'])
			{
				if ($Ymax - $Ymin >= $obs['Ymax'] - $obs['Ymin'])
				{
					if (($obs['Ymin'] >= $Ymin && $obs['Ymin'] <= $Ymax) || ($obs['Ymax'] >= $Ymin && $obs['Ymax'] <= $Ymax))
						return false;
				}
				else
					if (($Ymin >= $obs['Ymin'] && $Ymin <= $obs['Ymax']) || ($Ymax >= $obs['Ymin'] && $Ymax <= $obs['Ymax']))
						return false;
			}
			if ($Ymin <= $obs['Ymax'] || $Ymax >= $obs['Ymin'])
            {
                if ($Xmax - $Xmin >= $obs['Xmax'] - $obs['Xmin'])
                {
                    if (($obs['Xmin'] >= $Xmin && $obs['Xmin'] <= $Xmax) || ($obs['Xmax'] >= $Xmin && $obs['Xmax'] <= $Xmax))
                        return false;
                }
                else
                    if (($Xmin >= $obs['Xmin'] && $Xmin <= $obs['Xmax']) || ($Xmax >= $obs['Xmin'] && $Xmax <= $obs['Xmax']))
                        return false;
            }
		}
		return true;
	}
	
	private function CheckShips($Xmax, $Xmin, $Ymax, $Ymin)
    {
		$ships = $this->_p1->getShips();
        foreach($ships as $sps)
        {
            if ($Xmin <= $sps->getXmax() || $Xmax >= $sps->getXmin())
            {
                if ($Ymax - $Ymin >= $sps->getYmax() - $sps->getYmin())
                {
                    if (($sps->getYmin() >= $Ymin && $sps->getYmin() <= $Ymax) || ($sps->getYmax() >= $Ymin && $sps->getYmax() <= $Ymax))
                        return false;
                }
                else
                    if (($Ymin >= $sps->getYmin() && $Ymin <= $sps->getYmax()) || ($Ymax >= $sps->getYmin() && $Ymax <= $sps->getYmax()))
                        return false;
            }
            if ($Ymin <= $sps->getYmax() || $Ymax >= $sps->getYmin())
            {
                if ($Xmax - $Xmin >= $sps->getXmax() - $sps->getXmin())
                {
                    if (($sps->getXmin() >= $Xmin && $sps->getXmin() <= $Xmax) || ($sps->getXmax() >= $Xmin && $sps->getXmax() <= $Xmax))
                        return false;
                }
                else
                    if (($Xmin >= $sps->getXmin() && $Xmin <= $sps->getXmax()) || ($Xmax >= $sps->getXmin() && $Xmax <= $sps->getXmax()))
                        return false;
            }
        }
		$ships = $this->_p2->getShips();
		foreach($ships as $sps)
        {
            if ($Xmin <= $sps->getXmax() || $Xmax >= $sps->getXmin())
            {
                if ($Ymax - $Ymin >= $sps->getYmax() - $sps->getYmin())
                {
                    if (($sps->getYmin() >= $Ymin && $sps->getYmin() <= $Ymax) || ($sps->getYmax() >= $Ymin && $sps->getYmax() <= $Ymax))
                        return false;
                }
                else
                    if (($Ymin >= $sps->getYmin() && $Ymin <= $sps->getYmax()) || ($Ymax >= $sps->getYmin() && $Ymax <= $sps->getYmax()))
                        return false;
            }
            if ($Ymin <= $sps->getYmax() || $Ymax >= $sps->getYmin())
            {
                if ($Xmax - $Xmin >= $sps->getXmax() - $sps->getXmin())
                {
                    if (($sps->getXmin() >= $Xmin && $sps->getXmin() <= $Xmax) || ($sps->getXmax() >= $Xmin && $sps->getXmax() <= $Xmax))
                        return false;
                }
                else
                    if (($Xmin >= $sps->getXmin() && $Xmin <= $sps->getXmax()) || ($Xmax >= $sps->getXmin() && $Xmax <= $sps->getXmax()))
                        return false;
            }
        }
        return true;
    }

	//SET
	public function init_obstacle($obs)
	{
		foreach ($obs as $key => $value)
			$this->_map[$value][$key] = 2;
	}
	public function setMap($h, $w, $obs)
	{
		$this->_map = array();
		$this->i = 0;
		while ($this->i <= $h + 1)
		{
			$this->j = 0;
			$this->_map[$this->i] = array();
			while ($this->j <= $w + 1)
			{
				if ($this->i == 0 || $this->i == $h + 1 || $this->j == 0 || $this->j == $w + 1)
					$this->_map[$this->i][$this->j] = 1;
				else
					$this->_map[$this->i][$this->j] = 0;
				$this->j++;
			}
			$this->i++;
		}
		$this->init_obstacle($obs);
	}
	public function setWidth($arg)
	{
		$this->_width = $arg;
	}
	public function setHeight($arg)
	{
		$this->_height = $arg;
	}
	public function setP1($p)
	{
		$this->_p1 = $p;
	}
	public function setP2($p)
	{
		$this->_p2 = $p;
	}

	//GET
	public function getMap()
	{
		return $this->_map;
	}
	public function getWidth()
	{
		return $this->_width;
	}
	public function getHeight()
	{
		return $this->_height;
	}
	public function getP1()
	{
		return $this->_p1;
	}
	public function getP2()
	{
		return $this->_p2;
	}
}

?>