<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

// This is required to load the Exceptions library early enough
$hook['pre_system'] = array(
	'function' => 'load_exceptions',
	'filename' => 'uhoh.php',
	'filepath' => 'hooks',
);

$hook['pre_system'] = function () {
    $dotenv = new Symfony\Component\Dotenv\Dotenv();
    $dotenv->load(__DIR__.'/../../.env');
};

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */
