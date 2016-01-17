<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Migration_test_db extends CI_Migration {
    public function up() {

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


        $this->dbforge->drop_table('meta_test1', TRUE);
        // As db_forge does not handle foreign keys, use
        $sql="create table meta_test1 (
	    id int not null auto_increment,
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
        PRIMARY KEY (`id`),
	    foreign key(oaci) references meta_test2(oaci)) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	    $this->db->query($sql);

	    // create views
	    $sql = "CREATE ALGORITHM=UNDEFINED DEFINER=`ci3`@`localhost` SQL SECURITY DEFINER VIEW
	            `users_groups_view` AS select `users`.`username` AS `username`,`groups`.`name` AS `groupname`
	            from ((`users` join `users_groups`) join `groups`)
	            where ((`users`.`id` = `users_groups`.`user_id`)
	            and (`groups`.`id` = `users_groups`.`group_id`));
	    ";
	    $this->db->query($sql);

	    // SELECT *, concat(first_name, ' ', last_name) as image From users
	    $sql = "CREATE ALGORITHM=UNDEFINED DEFINER=`ci3`@`localhost` SQL SECURITY DEFINER VIEW
	            `users_view` AS select
	            *, concat(first_name, ' ', last_name) as image From users
	    ";
	    $this->db->query($sql);
    }

    public function down() {
        $this->dbforge->drop_table('meta_test1', true);
        $this->dbforge->drop_table('meta_test2', true);
    }
}
