<?php

interface IZone
{
    /*
    private $_width;
    private $_height;
    private $_map; //array

    public static $verbose;
    
    */
    public __construct(array $kw_arg);
/*
  keys : "width" => int, "height" => int, "obstacle" => array("x" => y))
*/

    public function init_obstacle($arr);
    public function check_collision($xMin, $xMax, $yMin, $yMax);
    
}

?>