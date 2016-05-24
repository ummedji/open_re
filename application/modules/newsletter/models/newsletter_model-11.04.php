<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsletter_model extends BF_Model {

    protected $table = "newsletter";
    protected $key = "ID";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = false;
    protected $set_modified = false;

    const ID = 'ID';
    const FIRSTNAME = "firstName";
    const LASTNAME = "lastName";
    const EMAILID = "emailID";
    const SUBSCRIBEDATE = "subscribeDate";

    public function __construct() {
        parent::__construct();
        $params = array(
            $this->table,
            SITE_AREA . '/content/newsletter/index',
            ""
        );

        $this->load->library("grid_generator", $params, "grid");
    }

    public function read($arrayOfSpec) {
        return $this->grid->read($arrayOfSpec);
    }

    public function getArrayOfData() {
        return $this->grid->arrayOfData;
    }

}
