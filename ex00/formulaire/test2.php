<?php

echo " 
<META HTTP-EQUIV='Refresh' CONTENT='10; URL=test1.php'> 
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
	echo $i;
	file_put_contents("base_test", serialize($i));
}
?>