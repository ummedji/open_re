<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_user_management extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'role_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 120,
				
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
				
			),
			'password_hash' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				
			),
			'reset_hash' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				
			),
			'salt' => array(
				'type' => 'VARCHAR',
				'constraint' => 7,
				
			),
			'last_login' => array(
				'type' => 'DATETIME',
				'default' => '0000-00-00 00:00:00',
				
			),
			'last_ip' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				
			),
			'deleted' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				
			),
			'banned' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				
			),
			'ban_message' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'reset_by' => array(
				'type' => 'INT',
				'constraint' => 10,
				
			),
			'display_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'display_name_changed' => array(
				'type' => 'DATE',
				'default' => '0000-00-00',
				
			),
			'timezone' => array(
				'type' => 'CHAR',
				'constraint' => 4,
				
			),
			'language' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				
			),
			'activate_hash' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				
			),
			'created_on' => array(
				'type' => 'datetime',
				'default' => '0000-00-00 00:00:00',
			),
			'active' => array(
				'type' => 'TINYINT',
				'default' => 1,
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('user_management');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('user_management');

	}

	//--------------------------------------------------------------------

}