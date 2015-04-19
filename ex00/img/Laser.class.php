<?PHP

require_once("Gun.class.php");

class Laser extends Gun
{
	//MAGIC
	public function __construct()
	{
		$this->init(array("name" => "laser",
						   "load" => 5,
						   "srange" => 10,
						   "mrange" => 20,
						   "lrange" => 30,
						   "area" => "BOUM"));

        if (self::$verbose)
			echo "Laser constructed.".PHP_EOL;
	}

	public function __destruct()
    {
        if (self::$verbose)
			echo "Laser destructed.".PHP_EOL;
    }
}

?>