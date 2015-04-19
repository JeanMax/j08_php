<?PHP

require_once('IZone.class.php');

class Zone implements IZone
{
	private $_width;
    private $_height;
	public $_p1;
	public $_p2;
    private $_obstacles;

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

		if (array_key_exists("p1", $kw_arg))
			$this->setP1($kw_arg["p1"]);
		else
			$this->setP1(null);

		if (array_key_exists("p2", $kw_arg))
			$this->setP2($kw_arg["p2"]);
		else
			$this->setP2(null);

		$this->setObstacles(array(array("Xmin" => 110, "Xmax" => 119, "Ymin" => 60, "Ymax" => 69),
									array("Xmin" => 30, "Xmax" => 39, "Ymin" => 20, "Ymax" => 29),
									array("Xmin" => 50, "Xmax" => 59, "Ymin" => 60, "Ymax" => 69),
									array("Xmin" => 80, "Xmax" => 89, "Ymin" => 30, "Ymax" => 39)));

		if (self::$verbose)
			echo "Zone constructed.".PHP_EOL;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo "Zone destructed.".PHP_EOL;
	}

	//PUBLIC
	public	 function aff_map($player)
	{
		echo '<table>';

		$p1Ships = $this->getP1()->getShips();
		$p2Ships = $this->getP2()->getShips();

		foreach($p1Ships as $ship)
		{
			if ($ship->getPc() > 0)
			{
				$X = 12 * $ship->getXMin();
				$Y = 12 * $ship->getYMin();
				$SX = 12 * ($ship->getXMax() - $ship->getXMin() + 1) - 1;
				$SY = 12 * ($ship->getYMax() - $ship->getYMin() + 1) - 1;
                if($ship->getActivated() == false && $player == 1)
                    echo '<a href="http://demo.local.42.fr:8080/j08_php/ex00/main.php?id=' . $ship->getName() . '&joueur=1">';
				echo '<img src= '.$ship->getSprite().' style="background-color:red; left:'.$X.'px; top:'.$Y.'px; width:'.$SX.'px;height:'.$SY.'px;" alt="Vaisse11" class="vais">';
                if($ship->getActivated() == false && $player == 1)
                    echo '</a>';
            }
		}

		foreach($p2Ships as $ship2)
		{
			if ($ship2->getPc() > 0)
			{
				$X = 12 * $ship2->getXMin();
				$Y = 12 * $ship2->getYMin();
				$SX = 12 * ($ship2->getXMax() - $ship2->getXMin() + 1) - 1;
				$SY = 12 * ($ship2->getYMax() - $ship2->getYMin() + 1) - 1;
                if($ship2->getActivated() == false && $player == 2)
                    echo '<a href="http://demo.local.42.fr:8080/j08_php/ex00/main.php?id=' . $ship2->getName() . '&joueur=2">';
				echo '<img src= '.$ship2->getSprite().' style="background-color:blue; left:'.$X.'px; top:'.$Y.'px; width:'.$SX.'px;height:'.$SY.'px;" alt="Vaisse11" class="vais">';
                if($ship2->getActivated() == false && $player == 2)
                    echo '</a>';
            }
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
	public function MoveLeft($length, $ship)
	{
		$posend = $ship->getXMin() - $length;
		$xmin = $ship->getXMin();
		$xmax = $ship->getXMax();
		while ($xmin > $posend)
		{
			$xmin--;
			$xmax--;
			if ($xmin == -1 ||
				$this->CheckObs($xmax, $xmin, $ship->getYMax(), $ship->getYMin()) == false)
			{
				$ship->setPc(0);
				return -1;
			}
			if ($this->CheckShips($xmax, $xmin, $ship->getYMax(), $ship->getYMin(), $ship) == false)
				return -2;
		}
		$ship->setXMin($xmin);
		$ship->setXMax($xmax);
		return true;
	}

	public function MoveRight($length, $ship)
	{
		$posend = $ship->getXMax() + $length;
		$xmin = $ship->getXMin();
		$xmax = $ship->getXMax();
		while ($xmax < $posend)
		{
			$xmax++;
			$xmin++;
			if ($xmax == $this->getWidth() ||
				$this->CheckObs($xmax, $xmin, $ship->getYMax(), $ship->getYMin()) == false)
			{
				$ship->setPc(0);
				return -1;
			}
			if ($this->CheckShips($xmax, $xmin, $ship->getYMax(), $ship->getYMin(), $ship) == false)
				return -2;
		}

		$ship->setXMin($xmin);
		$ship->setXMax($xmax);
		return 0;
	}

	public function MoveTop($length, $ship)
	{
		$posend = $ship->getYMin() - $length;
		$ymin = $ship->getYMin();
		$ymax = $ship->getYMax();
		while ($ymin > $posend)
		{
			$ymin--;
			$ymax--;
			if ($ymin == -1
				|| $this->CheckObs($ship->getXMax(), $ship->getXMin(), $ymax, $ymin) == false)
			{
				$ship->setPc(0);
				return -1;
			}
			if ($this->CheckShips($ship->getXMax(), $ship->getXMin(), $ymax, $ymin, $ship) == false)
				return -2;
		}
		$ship->setYMin($ymin);
		$ship->setYMax($ymax);
		return true;
	}

	public function MoveBottom($length, $ship)
	{
		$posend = $ship->getYMax() + $length;
		$ymin = $ship->getYMin();
		$ymax = $ship->getYMax();
		while ($ymax < $posend)
		{
			$ymax++;
			$ymin++;
			if ($ymax == $this->getHeight() ||
				$this->CheckObs($ship->getXMax(), $ship->getXMin(), $ymax, $ymin) == false)
			{
				$ship->setPc(0);
				return -1;
			}
			if ($this->CheckShips($ship->getXMax(), $ship->getXMin(), $ymax, $ymin, $ship) == false)
				return -2;
		}
		$ship->setYMin($ymin);
		$ship->setYMax($ymax);
		return true;
	}

	public function CheckObs($Xmax, $Xmin, $Ymax, $Ymin)
	{
		foreach ($this->_obstacles as $obs)
		{
			if (($Xmin <= $obs['Xmax'] && $Xmin >= $obs['Xmin']) || ($Xmax >= $obs['Xmin'] && $Xmax <= $obs['Xmax']))
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
			if (($Ymin <= $obs['Ymax'] && $Ymin >= $obs['Ymin']) || ($Ymax >= $obs['Ymin'] && $Ymax <= $obs['Ymax']))
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

    public function LineView($ship, $range)
    {
        $ret = 0;
        
        switch ($ship->getWay())
        {
        case "left":
            $x = $ship->getXMin();
            $y = ($ship->getYMax() - $ship->getYMin()) / 2;
            $stop = $x - $range;
            for ($x; $x > $stop; $x--)
            {
                if ($this->checkObs($x, $x, $y, $y) == false)
                    $ret++;
                if ($this->checkShips($x, $x, $y, $y, $ship) == false)
                    break ;
            }
            break ;

        case "right":
            $x = $ship->getXMax();
            $y = ($ship->getYMax() - $ship->getYMin()) / 2;
            $stop = $x + $range;
            for ($x; $x < $stop; $x++)
            {
                if ($this->checkObs($x, $x, $y, $y) == false)
                    $ret++;
                if ($this->checkShips($x, $x, $y, $y, $ship) == false)
                    break ;
            }
            break ;

        case "up":
            $y = $ship->getYMin();
            $x = ($ship->getXMax() - $ship->getXMin()) / 2;
            $stop = $y - $range;
            for ($y; $y > $stop; $y--)
            {
                if ($this->checkObs($x, $x, $y, $y) == false)
                    $ret++;
                if ($this->checkShips($x, $x, $y, $y, $ship) == false)
                    break ;
            }
            break ;

        case "down":
            $y = $ship->getYMax();
            $x = ($ship->getXMax() - $ship->getXMin()) / 2;
            $stop = $y + $range;
            for ($y; $y < $stop; $y++)
            {
                if ($this->checkObs($x, $x, $y, $y) == false)
                    $ret++;
                if ($this->checkShips($x, $x, $y, $y, $ship) == false)
                    break ;
            }
            break ;
        }

        if ($this->checkShips($x, $x, $y, $y, $ship) == true)
            return $this->findShip($x, $y);
        if ($ret == 0)
            return false;
        return false;
    }

    public function findShip($x, $y)
    {
        $ships = $this->_p1->getShips();
        foreach ($ships as $ship)
            if ($x >= $ship->getXMin() && $x <= $ship->getXMax() &&
                $y >= $ship->getYMin() && $y <= $ship->getYMax())
                return $ship;

        $ships = $this->_p2->getShips();
        foreach ($ships as $ship)
            if ($x >= $ship->getXMin() && $x <= $ship->getXMax() &&
                $y >= $ship->getYMin() && $y <= $ship->getYMax())
                return $ship;
        
        return null;
    }
    
	public function CheckShips($Xmax, $Xmin, $Ymax, $Ymin, $ship)
	{
		$ships = $this->_p1->getShips();
		foreach ($ships as $sps)
		{
			if ((($Xmin <= $sps->getXmax() && $Xmin >= $sps->getXmin()) || ($Xmax >= $sps->getXmin() && $Xmax <= $sps->getXmax())) && $sps !== $ship && $sps->getPc() > 0)
			{
				if ($Ymax - $Ymin >= $sps->getYmax() - $sps->getYmin())
				{
					if (($sps->getYmin() >= $Ymin && $sps->getYmin() <= $Ymax) || ($sps->getYmax() >= $Ymin && $sps->getYmax() <= $Ymax))
					{
						$this->damageIt($ship, $sps, $Xmax, $Xmin, $Ymax, $Ymin);
						return false;
					}
					else if (($Ymin >= $sps->getYmin() && $Ymin <= $sps->getYmax()) || ($Ymax >= $sps->getYmin() && $Ymax <= $sps->getYmax()))
					{
						$this->damageIt($ship, $sps, $Xmax, $Xmin, $Ymax, $Ymin);
						return false;
					}
				}
			}
			if ((($Ymin <= $sps->getYmax() && $Ymin >= $sps->getYmin()) || ($Ymax >= $sps->getYmin() && $Ymax <= $sps->getYmax())) && $sps !== $ship && $sps->getPc() > 0)
			{
				if ($Xmax - $Xmin >= $sps->getXmax() - $sps->getXmin())
				{
					if (($sps->getXmin() >= $Xmin && $sps->getXmin() <= $Xmax) || ($sps->getXmax() >= $Xmin && $sps->getXmax() <= $Xmax))
					{
						$this->damageIt($ship, $sps, $Xmax, $Xmin, $Ymax, $Ymin);
						return false;
					}
				}
				else if (($Xmin >= $sps->getXmin() && $Xmin <= $sps->getXmax()) || ($Xmax >= $sps->getXmin() && $Xmax <= $sps->getXmax()))
				{
					$this->damageIt($ship, $sps, $Xmax, $Xmin, $Ymax, $Ymin);
					return false;
				}
			}
		}

		$ships = $this->_p2->getShips();
		foreach ($ships as $sps)
		{
			if ((($Xmin <= $sps->getXmax() && $Xmin >= $sps->getXmin()) || ($Xmax >= $sps->getXmin() && $Xmax <= $sps->getXmax())) && $sps !== $ship && $sps->getPc() > 0)
			{
				if ($Ymax - $Ymin >= $sps->getYmax() - $sps->getYmin())
				{
					if (($sps->getYmin() >= $Ymin && $sps->getYmin() <= $Ymax) || ($sps->getYmax() >= $Ymin && $sps->getYmax() <= $Ymax))
					{
						$this->damageIt($ship, $sps, $Xmax, $Xmin, $Ymax, $Ymin);
						return false;
					}
					else if (($Ymin >= $sps->getYmin() && $Ymin <= $sps->getYmax()) || ($Ymax >= $sps->getYmin() && $Ymax <= $sps->getYmax()))
					{
						$this->damageIt($ship, $sps, $Xmax, $Xmin, $Ymax, $Ymin);
						return false;
					}
				}
			}
			if ((($Ymin <= $sps->getYmax() && $Ymin >= $sps->getYmin()) || ($Ymax >= $sps->getYmin() && $Ymax <= $sps->getYmax())) && $sps !== $ship && $sps->getPc() > 0)
			{
				if ($Xmax - $Xmin >= $sps->getXmax() - $sps->getXmin())
				{
					if (($sps->getXmin() >= $Xmin && $sps->getXmin() <= $Xmax) || ($sps->getXmax() >= $Xmin && $sps->getXmax() <= $Xmax))
					{
						$this->damageIt($ship, $sps, $Xmax, $Xmin, $Ymax, $Ymin);
						return false;
					}
				}
				else if (($Xmin >= $sps->getXmin() && $Xmin <= $sps->getXmax()) || ($Xmax >= $sps->getXmin() && $Xmax <= $sps->getXmax()))
				{
					$this->damageIt($ship, $sps, $Xmax, $Xmin, $Ymax, $Ymin);
					return false;
				}
			}
		}

		return true;
	}

	private function damageIt($ship1, $ship2, $Xmax, $Xmin, $Ymax, $Ymin)
	{
        $pc1 = $ship1->getPc();
		$ship1->setPc($pc1 + $ship1->getBonusShield() - $ship2->getPc());
		$ship2->setPc($ship2->getPc() + $ship2->getBonusShield() - $pc1);

		switch ($ship1->getWay())
		{
		case "left":
			$ship1->setXMin($Xmin + 1);
			$ship1->setXMax($Xmax + 1);
			break ;

		case "right":
			$ship1->setXMin($Xmin - 1);
			$ship1->setXMax($Xmax - 1);
			break ;

		case "up":
			$ship1->setYMin($Ymin + 1);
			$ship1->setYMax($Ymax + 1);
			break ;

		case "down":
			$ship1->setYMin($Ymin - 1);
			$ship1->setYMax($Ymax - 1);
			break ;
		}

	}

//SET
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
	public function setObstacles(array $o)
	{
		return $this->_obstacles = $o;
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
	public function getObstacles()
	{
		return $this->_obstacles;
	}
}

?>