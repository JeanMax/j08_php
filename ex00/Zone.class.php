<?PHP

require_once('IZone.class.php');

class Zone implements IZone
{
	private $_width;
    private $_height;
    private $_map; //array

    //MAGIC
	public __construct(array $kw_arg)
	{
		if (array_key_exists("width", $kw_arg))
			$this->setWidth($kw_arg["width"]);
		else
			$this->setWidth(150);
		if (array_key_exists("height", $kw_arg))
			$this->setWidth($kw_arg["height"]);
		else
			$this->setHeight(100);
		if (array_key_exists("obstacle", $kw_arg))
			$this->init_obstacle($kw_arg["obstacle"]);
		else
			$this->init_obstacle(array());
		$this->init_Map($this->getHeight, $this->getWidth, $this->getP1_ships, $this->getP2_ships);
	}

    //PUBLIC METHOD
	public function init_obstacle($arr)
	{
        //TODO
	}
	public function setMap($w, $h, $p1s, $p2s)
	{
        //TODO
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

    //GET
	public function getWidth()
	{
		return $this->_width;
	}
	public function getHeight()
	{
		return $this->_height;
	}
}
?>