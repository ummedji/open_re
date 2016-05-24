<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_bf_master_category_applicable extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'bf_master_category_applicable';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'category_applicable_id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
			'status' => array(
				'type' => 'TINYINT',
				'default' => 1,
			),
        'applicable_name' => array(
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => false,
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
		$this->dbforge->add_key('category_applicable_id', true);
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