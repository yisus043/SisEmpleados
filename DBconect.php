
<?php
$db_host="127.0.0.1"; //localhost server 
$db_user="u995420991_sistemadigital";	//database username
$db_password="U995420991_sistemadigital";	//database password   
$db_name="u995420991_sistemadigital";	//database name

try
{
	$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}

?>


