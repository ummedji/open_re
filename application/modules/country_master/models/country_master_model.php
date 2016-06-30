<?php defined('BASEPATH') || exit('No direct script access allowed');

class Country_master_model extends BF_Model
{
    protected $table_name	= 'countries';
	protected $key			= 'counrty_id';
	protected $date_format	= 'datetime';

	protected $log_user 	= false;
	protected $set_created	= true;
	protected $set_modified = false;
	protected $soft_deletes	= true;
    protected $status_field = "status";
	protected $created_field     = 'created_on';
    protected $deleted_field     = 'deleted';

	// Customize the operations of the model without recreating the insert,
    // update, etc. methods by adding the method names to act as callbacks here.
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 	    = array();
	protected $after_find 		= array();
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	// For performance reasons, you may require your model to NOT return the id
	// of the last inserted row as it is a bit of a slow method. This is
    // primarily helpful when running big loops over data.
	protected $return_insert_id = true;

	// The default type for returned row data.
	protected $return_type = 'object';

	// Items that are always removed from data prior to inserts or updates.
	protected $protected_attributes = array();

	// You may need to move certain rules (like required) into the
	// $insert_validation_rules array and out of the standard validation array.
	// That way it is only required during inserts, not updates which may only
	// be updating a portion of the data.
	protected $validation_rules 		= array(
		array(
			'field' => 'iso',
			'label' => 'lang:country_master_field_iso',
			'rules' => 'max_length[2]',
		),
		array(
			'field' => 'name',
			'label' => 'lang:country_master_field_name',
			'rules' => 'required|max_length[80]',
		),
		array(
			'field' => 'printable_name',
			'label' => 'lang:country_master_field_printable_name',
			'rules' => 'required|max_length[80]',
		),
		array(
			'field' => 'iso3',
			'label' => 'lang:country_master_field_iso3',
			'rules' => 'max_length[3]',
		),
		array(
			'field' => 'numcode',
			'label' => 'lang:country_master_field_numcode',
			'rules' => 'required|is_numeric|max_length[6]',
		),
		array(
			'field' => 'status',
			'label' => 'lang:country_master_field_status',
			'rules' => 'max_length[4]',
		),
	);
	protected $insert_validation_rules  = array();
	protected $skip_validation 			= false;

    /**
     * Constructor
     *
     * @return void
     */
    
            public function __construct(){
                parent::__construct();
                $config = array(
                "table" => $this->table_name,
                "key" => $this->key,
                "status_field" => $this->status_field,
                
            );
            $this->load->library("CH_Grid_generator", $config, "grid");
            }
    public function read($req_data) {
    $orderbymultiple = array(
                      array("sortby"=>$this->table_name.".status","order"=>"DESC"),
                      array("sortby"=>$this->table_name.".name","order"=>"ASC")
                      );
        $where = array(
            $this->table_name.".".$this->deleted_field => 0,
        );
    $this->grid->initialize(array("req_data" => $req_data,"orderbymultiple"=>$orderbymultiple,"where"=>$where));
    return $this->grid->get_result();
        }
    public function country_insert($data_insert_country)
    {
        $this->db->insert('bf_countries',$data_insert_country);
        return $this->db->insert_id();
    }

	public function get_all_country()
	{
		$this->db->select('*');
		$this->db->from('countries');
		$this->db->where('status','1');
		$this->db->where('deleted','0');
		$this->db->order_by('name','ASC');
		$country=$this->db->get()->result_array();
		return $country;
	}
}