<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['module_config'] = array(
	'description'	=> 'Menu Management',
	'name'		=> 'Menu',
	'version'		=> '0.0.1',
	'author'		=> 'keyideas.superadmn'
);


$config['module_config']['menu_image_path']  = FCPATH . "assets" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "menu_images";

$config['module_config']['menu_image_file_config'] = array(
    "allowed_types" => "gif|jpg|png|jpeg",
    "max_size" => "1000",
    "upload_path" => $config['module_config']['menu_image_path']
);
