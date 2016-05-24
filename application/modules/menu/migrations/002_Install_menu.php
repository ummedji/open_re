<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_menu extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'alias' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'link' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
                        'link_type' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'parent_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'navigation_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'window' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				
			),
			'image_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
                                'default' => NULL
				
			),
			'access_role_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'meta_title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'meta_keyword' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'meta_description' => array(
				'type' => 'LONGTEXT',
				
			),
			'status' => array(
				'type' => 'TINYINT',
				'default' => 1,
			),
			'position' => array(
				'type' => 'INT',
                                'default' => 1,
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('menu');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('menu');

	}

	//--------------------------------------------------------------------

}