<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_master_customer_type_regional extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'master_customer_type_regional';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'customer_type_id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
			'status' => array(
				'type' => 'TINYINT',
				'default' => 1,
			),
        'customer_level' => array(
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => false,
        ),
        'customer_type_name' => array(
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => false,
        ),
        'customer_type_code' => array(
            'type'       => 'VARCHAR',
            'constraint' => 100,
            'null'       => false,
        ),
        'customer_type_description' => array(
            'type'       => 'TEXT',
            'null'       => true,
        ),
        'created_by_user' => array(
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => true,
        ),
        'modified_by_user' => array(
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => true,
        ),
        'deleted' => array(
            'type'       => 'TINYINT',
            'constraint' => 1,
            'default'    => '0',
        ),
        'created_on' => array(
            'type'       => 'datetime',
            'default'    => '0000-00-00 00:00:00',
        ),
        'modified_on' => array(
            'type'       => 'datetime',
            'default'    => '0000-00-00 00:00:00',
        ),
	);

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field($this->fields);
		$this->dbforge->add_key('customer_type_id', true);
		$this->dbforge->create_table($this->table_name);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->table_name);
	}
}