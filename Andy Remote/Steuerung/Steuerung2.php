<?php
error_log(print_r($_POST, true));

define("GPIOPATH","/sys/class/gpio/");

define ('EnableMotor1', 25);
define ('EnableMotor2', 11);
define ('RightForward', 24);
define ('RightBackward', 23);
define ('LeftForward', 10);
define ('LeftBackward', 9);

function gpio_exporten(){
	shell_exec ("gpio export 9 out");
	shell_exec ("gpio export 10 out");
	shell_exec ("gpio export 11 out"); //Enable
	shell_exec ("gpio export 23 out");
	shell_exec ("gpio export 24 out");
	shell_exec ("gpio export 25 out"); //Enable
}

function set_enable_pin(){
	shell_exec ("gpio -g write 11 1");
	shell_exec ("gpio -g write 25 1");
}

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


if() {
	$mode = $_POST['mode'];
//	error_log("Mode: *" . $mode . "*");

  	gpio_set_value(EnableMotor1, 1); //Motor1 enabled
  	gpio_set_value(EnableMotor2, 1); //Motor2 enabled

	switch ($mode) {

		case 'A':
			gpio_set_value(RightForward, 0);
			gpio_set_value(RightBackward, 0);
			gpio_set_value(LeftForward, 0);
			gpio_set_value(LeftBackward, 0);
			gpio_set_value(RightForward, 1);
			break;
		case 'B':
      gpio_set_value(RightForward, 0);
      gpio_set_value(RightBackward, 0);
      gpio_set_value(LeftForward, 0);
      gpio_set_value(LeftBackward, 0);
      gpio_set_value(RightBackward, 1);
			break;
		case 'C':
      gpio_set_value(RightForward, 0);
      gpio_set_value(RightBackward, 0);
      gpio_set_value(LeftForward, 0);
      gpio_set_value(LeftBackward, 0);
      gpio_set_value(LeftForward, 1);
			break;
		case 'D':
      gpio_set_value(RightForward, 0);
      gpio_set_value(RightBackward, 0);
      gpio_set_value(LeftForward, 0);
      gpio_set_value(LeftBackward, 0);
      gpio_set_value(LeftBackward, 1);
			break;
		default:
			error_log("Bummer!");
	}
}
?>
