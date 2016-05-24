<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Newsletter_model extends BF_Model {



    protected $table_name = "newsletter";

    protected $key = "ID";

    protected $soft_deletes = false;

    protected $date_format = "datetime";

    protected $set_created = false;

    protected $set_modified = false;

    public $ns_listId = "104a1386bd";



    const ID = 'ID';

    const FIRSTNAME = "firstName";

    const LASTNAME = "lastName";

    const EMAILID = "emailID";

    const SUBSCRIBEDATE = "subscribeDate";



    public function __construct() {

        parent::__construct();

        $this->load->library('MCAPI'); // mail chimp

        $params = array(

            $this->table_name,

            SITE_AREA . '/content/newsletter/index',

            ""

        );



        $this->load->library("grid_generator", $params, "grid");

         $arrayOfOrder = array(

            "sortby" => self::ID,

            "order" => "DESC"

        );
   $this->grid->setOrderBy($arrayOfOrder);
    }

    public function subscribeToMailchimp($data)
    {
        $curr_date = date('Y-m-d h:i:s');
        $check_email = $this->db->get_where('newsletter', array('emailID' => $data['emailID']));
        if ($check_email->num_rows() == 0) {
            $data = array('firstName' => $data['FirstName'], 'lastName' => $data['LastName'], 'emailID' => $data['emailID'],
            'subscribeDate' => $curr_date);
            $this->db->insert('newsletter', $data);
            $this->mcapi->listSubscribe($this->ns_listId,$data['emailID']);
        }
        return;
    }

    public function read($arrayOfSpec) {

        return $this->grid->read($arrayOfSpec);

    }

    public function getArrayOfData() {

        return $this->grid->arrayOfData;

    }

    public function getUsers($data){
        $sql = "SELECT * FROM ".$this->db->dbprefix('newsletter')." WHERE emailID LIKE ? ORDER BY id DESC ";
        $query = $this->db->query($sql, $data);
        return $query->result();
    }
    
    public function get_users($data){
          $sql = "SELECT * FROM ".$this->db->dbprefix('users')." WHERE active = '1' AND deleted=0 AND email LIKE ? ";
        $query = $this->db->query($sql, $data);
        return $query->result();
    }
    
    public function get_all_subscribedUser()
    {
        $query=$this->db->query("SELECT id,emailID FROM ".$this->db->dbprefix('newsletter')."");
        $get_result=$query->result();
      //  var_dump($get_result);die;
        return $get_result;
    }



}

