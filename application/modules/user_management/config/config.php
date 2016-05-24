<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config['module_config'] = array(
    'description' => 'User Management',
    'name' => 'User Management',
    'version' => '0.0.1',
    'author' => 'keyideas.superadmn'
);

//Set module for role...
$config['module_config']['module_title'] = "User management";
$config['module_config']['module_name'] = "user_management";
$config['module_config']['module_permission_name'] = "User_Management";
$config['module_config']['role'] = "User";
