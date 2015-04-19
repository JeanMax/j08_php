<?PHP

require_once('IZone.class.php');

class Zone implements IZone
{
    /*
	public $i = 0;
	public $j = 0;
    */
	private $_width;
    private $_height;
    private $_map; //array
	private $_p1;
	private $_p2;

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
	public     function aff_map()
    {
        echo '<table>';

        $p1Ships = $this->getP1()->getShips();
        $p2Ships = $this->getP2()->getShips();
		
		foreach($p1Ships as $ship)
		{        
			$X = 12 * $ship->getXMin();
        	$Y = 12 * $ship->getYMin();
        	$SX = 12 * ($ship->getXMax() - $ship->getXMin()) - 1;
        	$SY = 12 * ($ship->getYMax() - $ship->getYMin()) - 1;

        	echo '<img src= '.$ship->getSprite().' style="background-color:red; left:'.$X.'px; top:'.$Y.'px; width:'.$SX.'px;height:'.$SY.'px;" alt="Vaisse11" class="vais">';
        }

        foreach($p2Ships as $ship2)
		{        
			$X = 12 * $ship2->getXMin();
        	$Y = 12 * $ship2->getYMin();
        	$SX = 12 * ($ship2->getXMax() - $ship2->getXMin()) - 1;
        	$SY = 12 * ($ship2->getYMax() - $ship2->getYMin()) - 1;

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

/*
//TEST
$test1 = new Zone(array("obstacle" => array(12 => 2, 5 => 5, 2 => 8), "height" => 10, "width" => 15));
$i = 0;
while ($i <= $test1->getHeight() + 1)
{
$j = 0;
while ($j <= $test1->getWidth() + 1)
{
if ($j == 0)
print($test1->getMap()[$i][$j]);
else
print(" " . $test1->getMap()[$i][$j]);
$j++;
}
print("\n");
$i++;
*/

?>