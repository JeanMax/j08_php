<?php
session_start();

require_once("Player.class.php");
require_once("Zone.class.php");
require_once("ExempleGun.class.php");
require_once("ExempleShip.class.php");

function init_game () {
	$g1 = New ExempleGun();
	$g2 = New ExempleGun();
	$g3 = New ExempleGun();
	$g4 = New ExempleGun();
	$s1 = New ExempleShip([$g1, $g2, $g3]);
	$s2 = New ExempleShip([$g1, $g2, $g3]);
	$s3 = New ExempleShip([$g2, $g3]);
	$s4 = New ExempleShip([$g1, $g3]);
	$s1->setXMin(100);
	$s1->setXMax(110);
	$s1->setYMin(80);
	$s1->setYMax(84);
	$s2->setXMin(30);
	$s2->setXMax(40);
	$s2->setYMin(60);
	$s2->setYMax(64);
	$s3->setXMin(60);
	$s3->setXMax(70);
	$s3->setYMin(20);
	$s3->setYMax(24);
    $s4->setXMin(40);
    $s4->setXMax(50);
	$s4->setYMin(20);
	$s4->setYMax(24);
	$p1 = New player([$s1, $s2]);
	$p2 = New player([$s3, $s4]);
	$z = new zone(array("p1" => $p1,
						"p2" => $p2));
    echo "<pre>";
	$s3->rotate("left");
	$s3->rotate("left");
    print_r($s3->move(10, $z));
    $p2->isAlive();
    $p1->isAlive();
    print_r($p2);
    echo "</pre>";
    return ($z);
}

print_r($_POST);
if ($_POST['game_id'] && $_POST['create_game']) {
	$file = "bdd/".$_POST['game_id'].".bdd";
	echo ($file);
	if (file_exists($file))
		header('Location: lobby.php');
	else {
		$game = init_game();   //Initialiser une GAME comme dans main.php
		file_put_contents($file, serialize($game));
		header('Location: ');                                    //GO TO NEW GAME
		$_SESSION['game_id'] = $_POST['game_id'];
	}
}
else if ($_POST['join_game']) {
	$file = "bdd/".$_POST['game_id'].".bdd";
	if (file_exists('$file')) {
		$_SESSION['game_id'] = $_POST['game_id'];
		print_r($_SESSION);
		// header('Location: ');                                 //GO TO JOIN GAME
	}
	else {
		header('Location: lobby.php');
	}
}



?>