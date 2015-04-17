<?php

interface IZone
{
/*	private $_width;
    private $_height;
    private $_map; //array
    private $_p1_ships; //array //seriouslee?
    private $_p2_ships; //array //seriouslee?*/
    
    public function __construct(array $kw_arg);
/*
  keys : "width" => int, "height" => int, "obstacle" => array("x" => y))
*/
}

?>