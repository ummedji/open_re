<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Migration_Install_newsletter extends Migration {

    public function up() {
        $prefix = $this->db->dbprefix;

        $fields = array(
            'ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
            ),
            'firstName' => array(
                'type' => 'VARCHAR',
                'constraint' => 25,
            ),
            'lastName' => array(
                'type' => 'VARCHAR',
                'constraint' => 25,
            ),
            'emailID' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
            ),
            'subscribeDate' => array(
                'type' => 'DATETIME',
                'default' => '0000-00-00 00:00:00',
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('ID', true);
        $this->dbforge->create_table('newsletter');
    }

    //--------------------------------------------------------------------

    public function down() {
        $prefix = $this->db->dbprefix;

        $this->dbforge->drop_table('newsletter');
    }

    //--------------------------------------------------------------------
}