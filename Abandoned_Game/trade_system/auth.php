<?php

session_start();
if(empty($_SESSION['logined']))
{
    $_SESSION['logined'] = false;
}

if(!$_SESSION['logined'])
{
    header("Location: login.php") ;
	exit ;  
}
session_write_close();

?>