<?php
session_start();


/*

if(!$_SESSION['i'])
	$_SESSION['i'] = 0;
else
	$_SESSION['i']++;

function test($u){

	return $u++;
}

*/

echo " 
<META HTTP-EQUIV='Refresh' CONTENT='5; URL=test1.php'> 
";


if (!file_exists("base_test"))
{
	$i = 0;
	file_put_contents("base_test", serialize($i));
	echo $i;

}
else
{
	$i = unserialize(file_get_contents("base_test"));
	$i++;
	echo $i;
	file_put_contents("base_test", serialize($i));
}

//print_r($_SESSION);
 ?>