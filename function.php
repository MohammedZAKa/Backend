<?php
session_start();
function is_logged_in() : bool
{
	if(!empty($_SESSION['USER']) && is_array($_SESSION['USER']))
	{
		return true;
	} 
	return false;
}
function redirect($page)
{
	header("Location: $page.php");
	die;
}
function auth($row)
{
	$_SESSION['USER'] = $row;
}
function user($key)
{
	if(!empty($_SESSION['USER'][$key]))
		return $_SESSION['USER'][$key];
	return '';
}
function esc($str)
{
	return htmlspecialchars($str);
}
function old_vlue($key)
{
	if(!empty($_POST[$key]))
	{
		return $_POST[$key];
	}
	return "";
}

function query($query)
{
	global $con;
	$result = mysqli_query($con,$query);
	if(!is_bool($result))
	{
		if(mysqli_num_rows($result) > 0)
		{
			$rows = [];
			while($row = mysqli_fetch_assoc($result))
			{
				$rows[] = $row;
			}
			return $rows;
		}
	}
	return false;

}

function get_image($path = '')
{
	if(file_exists($path))
		return $path;
	return 'assets/images/no_user.jpg';
}