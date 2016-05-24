<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_master_category_regional extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'master_category_regional';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'category_id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
			'status' => array(
				'type' => 'TINYINT',
				'default' => 1,
			),
        'category_name' => array(
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => false,
        ),
        'category_code' => array(
            'type'       => 'VARCHAR',
            'constraint' => 30,
            'null'       => false,
        ),
        'category_applicable_id' => array(
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => false,
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
		$this->dbforge->add_key('category_id', true);
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