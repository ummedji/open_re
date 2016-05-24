<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['module_config'] = array(
    'description' => 'Category',
    'name' => 'Category',
    'version' => '0.0.1',
    'author' => 'super admin'
);

$config['module_config']['category_image_path']  = FCPATH . "assets" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "category_images";
$config['module_config']['category_banner_path'] = FCPATH . "assets" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "category_banner";
$config['module_config']['category_video_path']  = FCPATH . "assets" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "category_videos";


$config['module_config']['category_image_file_config'] = array(
    "allowed_types" => "gif|jpg|png|jpeg",
    "max_size" => "1000",
    "upload_path" => $config['module_config']['category_image_path']
);

$config['module_config']['category_banner_file_config'] = array(
    "allowed_types" => "gif|jpg|png|jpeg",
    "max_size" => "1000",
    "upload_path" => $config['module_config']['category_banner_path']
);

$config['module_config']['category_video_file_config'] = array(
    "allowed_types" => "mp4|swf",
    "max_size" => "4000",
    "upload_path" => $config['module_config']['category_video_path']
);

