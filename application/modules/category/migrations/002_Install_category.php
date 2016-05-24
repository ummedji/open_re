<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_category extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'ID' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'category_title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'category_slug' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'category_description' => array(
				'type' => 'LONGTEXT',
				
			),
			'category_image' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
                                'null' => TRUE
				
			),
			'category_video' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
                                'null' => TRUE
				
			),
			'category_banner' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
                                'null' => TRUE
				
			),
			'category_status' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				
			),
			'category_parent_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('ID', true);
		$this->dbforge->create_table('category');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('category');

	}

	//--------------------------------------------------------------------

}