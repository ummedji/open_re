<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config['module_config'] = array(
    'description' => 'User Master',
    'name' => 'User Master',
    'version' => '0.0.1',
    'author' => 'keyideas.superadmn'
);

//Set module for role...
$config['module_config']['module_title'] = "User Master";
$config['module_config']['module_name'] = "user_master";
$config['module_config']['module_permission_name'] = "User_Master";
$config['module_config']['role'] = "User";
