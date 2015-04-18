<?php
namespace App\Lib;

class Debug 
{
	public static function p($thing, $exit=true)
	{
		echo '<pre>';
		print_r($thing);
		echo '</pre>';

		if ($exit) exit;
	}

	public static function d($thing, $exit=true)
	{
		echo '<pre>';
		var_dump($thing);
		echo '</pre>';

		if ($exit) exit;
	}
}