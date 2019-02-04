<?php  
ob_start();/// bach nb9a nhat fiha cokes dyal host
$timezone= date_default_timezone_set("Africa/Casablanca");

session_start();////kanbda session 
$con = mysqli_connect("localhost", "root", "", "myweb"); /////kandir connect m3a data base 

if(mysqli_connect_errno()) ////////kant2akd wach mtasla lamakantch mtasla i3tini error
{
	echo "Failed to connect: " . mysqli_connect_errno();
}
?>