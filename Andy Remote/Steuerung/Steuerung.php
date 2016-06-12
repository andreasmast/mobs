<?php
  echo "Funktioniert!";

  define ('Pin_Motor1_forw',9);
  define ('Pin_Motor1_backw',10);
  define ('Pin_Motor2_forw',23);
  define ('Pin_Motor2_backw',24);
  define ('Pin_Motor1_enable',11);
  define ('Pin_Motor2_enable',25);

  function set_gpio_export_out(){         //direction "out"
    	shell_exec(gpio export 9 out);
    	shell_exec(gpio export 10 out);
    	shell_exec(gpio export 11 out); //Enable
    	shell_exec(gpio export 23 out);
    	shell_exec(gpio export 24 out);
    	shell_exec(gpio export 25 out); //Enable

      echo "Export complete!";
  }

  function set_gpio_enable(){
    shell_exec(gpio -g write 11 1);
    shell_exec(gpio -g write 25 1);

    echo "Both Enable on!";
  }

  function write_pin($pin,$value){
    shell_exec(gpio -g write $pin $value);
  }

  //Programmstart

  set_gpio_export_out();
  set_enable_pin();

  $ButtonEingabe = $_Post['ButtonEingabe'];

  switch ($ButtonEingabe) {
    case 'forward':
      write_pin(Pin_Motor1_forw, 0);
      write_pin(Pin_Motor1_backw, 0);
      write_pin(Pin_Motor2_forw, 0);
      write_pin(Pin_Motor2_backw, 0);
      write_pin(Pin_Motor1_forw, 1);
      write_pin(Pin_Motor2_forw, 1);
      break;
    case 'backward':
      write_pin(Pin_Motor1_forw, 0);
      write_pin(Pin_Motor1_backw, 0);
      write_pin(Pin_Motor2_forw, 0);
      write_pin(Pin_Motor2_backw, 0);
      write_pin(Pin_Motor1_backw, 1);
      write_pin(Pin_Motor2_backw, 1);
      break;
    case 'right':
      write_pin(Pin_Motor1_forw, 0);
      write_pin(Pin_Motor1_backw, 0);
      write_pin(Pin_Motor2_forw, 0);
      write_pin(Pin_Motor2_backw, 0);
      write_pin(Pin_Motor1_forw, 1);
      write_pin(Pin_Motor2_backw, 1);
      break;
    case 'left':
      write_pin(Pin_Motor1_forw, 0);
      write_pin(Pin_Motor1_backw, 0);
      write_pin(Pin_Motor2_forw, 0);
      write_pin(Pin_Motor2_backw, 0);
      write_pin(Pin_Motor1_backw, 1);
      write_pin(Pin_Motor2_forw, 1);
      break;

    default:
      echo "Switch default! -> Error";
      break;
  }

 ?>
