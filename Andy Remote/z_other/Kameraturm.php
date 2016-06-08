<?php
error_log(print_r($_POST, true));

define("GPIOPATH","/sys/class/gpio/");

define ('Enable1', 25);
define ('Enable2', 11);
define ('DrehPosMotor1', 24);
define ('DrehNegMotor1', 23);
define ('DrehPosMotor2', 10);
define ('DrehNegMotor2', 9); 

function gpio_is_exported($pin)
// prueft, ob der Pin exportiert ist
{
	return file_exists(GPIOPATH.'gpio'.$pin.'');
}

function gpio_get_direction($pin)
// gibt die eingestellte Richtung zurueck
{
	$Dir = '';
	if (gpio_is_exported($pin))
	{ $Dir = trim(file_get_contents(GPIOPATH.'gpio'.$pin.'/direction')); }
	return $Dir;
}

function gpio_set_direction($pin, $direction)
// Stellt die Richtung ein ($direction: 'in' oder 'out')
{
	if (gpio_is_exported($pin)
			&& ($direction == 'in' || $direction == 'out'))
	{
		file_put_contents(GPIOPATH.'gpio'.$pin.'/direction', $direction);
		return true;
	}
	else
	{ return false; }
}

function gpio_get_value($pin)
// gibt den augenblicklichen Wert (0/1) des Pins zurueck
// oder einen leeren String im Fehlerfall
{
	$Val = '';
	if (gpio_is_exported($pin) && gpio_get_direction($pin) == 'in')
	{ $Val = trim(file_get_contents(GPIOPATH.'gpio'.$pin.'/value')); }
	return $Val;
}

function gpio_set_value($pin, $value)
// gibt den Wert in $value (0/1) auf dem Pin aus
{
	if (gpio_is_exported($pin)
			&& gpio_get_direction($pin) == 'out'
			&& ($value == '0' || $value == '1'))
	{
		file_put_contents(GPIOPATH.'gpio'.$pin.'/value', $value);
		return true;
	}
	else
	{ return false; }
}



if (isset($_POST['user'])&&($_POST['user']=='mobs')&&isset($_POST['pass'])&&($_POST['pass']=='2016')) {

	$mode = $_POST['mode'];
//	error_log("Mode: *" . $mode . "*");

	gpio_set_value(Enable1, 1); //Motor1 enabled
	gpio_set_value(Enable2, 1); //Motor2 enabled
	
	switch ($mode) {

		case 'A':
			gpio_set_value(DrehPosMotor1, 0);
			gpio_set_value(DrehNegMotor1, 0);
			gpio_set_value(DrehPosMotor2, 0);
			gpio_set_value(DrehNegMotor2, 0);
			gpio_set_value(DrehPosMotor1, 1);
			break;
		case 'B':
			gpio_set_value(DrehPosMotor1, 0);
			gpio_set_value(DrehNegMotor1, 0);
			gpio_set_value(DrehPosMotor2, 0);
			gpio_set_value(DrehNegMotor2, 0);
			gpio_set_value(DrehNegMotor1, 1);
			break;
		case 'C':
			gpio_set_value(DrehPosMotor1, 0);
			gpio_set_value(DrehNegMotor1, 0);
			gpio_set_value(DrehPosMotor2, 0);
			gpio_set_value(DrehNegMotor2, 0);
			gpio_set_value(DrehPosMotor2, 1);
			break;
		case 'D':
		    gpio_set_value(DrehPosMotor1, 0);
		    gpio_set_value(DrehNegMotor1, 0);
		    gpio_set_value(DrehPosMotor2, 0);
			gpio_set_value(DrehNegMotor2, 0);
			gpio_set_value(DrehNegMotor2, 1);
			break;
		default:
			error_log("Bummer!");
	}
}
?>

