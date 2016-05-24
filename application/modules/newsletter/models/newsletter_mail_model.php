<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Newsletter_mail_model extends BF_Model {


    protected $table_name = "newsletter_mail";

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

            $this->table_name,

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
    
    public function getNewsTemplates($id=""){
        $whr = "1=1";       
        if($id != ""){
            $whr = "id=".$id;
        }
        $query=$this->db->query("SELECT id,title,content FROM ".$this->db->dbprefix('newsletter_mail')." WHERE ".$whr);
        if($id != ""){
            $get_result=$query->row_array();
        }else{
            $get_result=$query->result();
        }
      //  var_dump($get_result);die;
        return $get_result;
    }

}

