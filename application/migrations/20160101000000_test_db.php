<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Migration_test_db extends CI_Migration {
    public function up() {

        $this->dbforge->drop_table('meta_test1', TRUE);
        
        // As db_forge does not handle foreign keys, use 
        $sql="create table meta_test1 (
	    id int primary key auto_increment,
        name varchar(50) not null,
        description varchar(100),
        email varchar(100) not null,
        expiration_date timestamp,
        active tinyint,
        birthday date,
        time time,
        epoch int(11),
        price decimal(8,2),
        oaci varchar(4),
	    foreign key(oaci) references meta_test2(oaci))";

	    $this->db-query($sql);
        
        $this->dbforge->drop_table('meta_test2', true);
        $fields = array (
                'oaci' => array (
                        'type' => 'VARCHAR',
                        'constraint' => '4'
                ),
                'description' => array (
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => true
                )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('oaci', TRUE);
        $this->dbforge->create_table('meta_test2');
    }
    
    public function down() {
        $this->dbforge->drop_table('meta_test1', true);
        $this->dbforge->drop_table('meta_test2', true);
    }
}
