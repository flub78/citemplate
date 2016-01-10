<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Migration_test_db extends CI_Migration {
    public function up() {
        $this->dbforge->drop_table('meta_test1', TRUE);

        $fields = array (
                'id' => array (
                        'type' => 'MEDIUMINT',
                        'constraint' => '8',
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                ),
                'name' => array (
                        'type' => 'VARCHAR',
                        'constraint' => '20'
                ),
                'description' => array (
                        'type' => 'VARCHAR',
                        'constraint' => '100'
                ),
                'email' => array (
                        'type' => 'VARCHAR',
                        'constraint' => '100'
                ),
                'expiration_date' => array (
                        'type' => 'TIMESTAMP',
                        'null' => true
                ),
                'active' => array (
                        'type' => 'TINYINT',
                        'constraint' => '1'
                ),
                'birthday' => array (
                        'type' => 'DATE',
                        'null' => true
                ),
                'time' => array (
                        'type' => 'TIME',
                        'null' => true
                ),
                'epoch' => array(
                        'type' => 'INT',
                        'constraint' => 11
                ),
                'price' => array(
                        'type' => 'DECIMAL',
                        'constraint' => '8,2'
                )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('meta_test1');
    }
    public function down() {
        $this->dbforge->drop_table('meta_test1', true);
    }
}
