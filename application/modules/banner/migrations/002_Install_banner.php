<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_banner extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'description' => array(
				'type' => 'TEXT',
				
			),
			'image' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				
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
		$this->dbforge->create_table('banner');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('banner');

	}

	//--------------------------------------------------------------------

}