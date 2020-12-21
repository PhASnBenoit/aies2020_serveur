<?php

function test_logged()
{
	if(!isset($_SESSION['account']))
	{
		return false;
	}
	if($_SESSION['account'] != "logged")
	{
		return false;
	}
	return true;
}

/*function test_admin()
{
	if(!isset($_SESSION['type']) or !isset($_SESSION['account']))
	{
		return false;
	}
	if($_SESSION['type'] != "admin")
	{
		return false;
	}
	return true;
}*/

function isA()
{
	if($_SESSION['type'] == "admin")
	{
		return true;
	}
	return false;
}
function isM()
{
	if($_SESSION['type'] == "moderator")
	{
		return true;
	}
	return false;
}
function isAM()
{
	if($_SESSION['type'] == "admin" or $_SESSION['type'] == "moderator")
	{
		return true;
	} 
	return false;
}
function isU()
{
	if($_SESSION['type'] != "admin" and $_SESSION['type'] != "moderator")
	{
		return true;
	} 
	return false;
}
?>