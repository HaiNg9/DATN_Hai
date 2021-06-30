<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Migrations extends CI_Migration {

        public function up()
        {
            /** START Create table homes */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'logo' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'unique' => true
                ),
                'phone' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '20'
                ),
                'web_link' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255'
                ),
                'updated_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('homes');
            /** START Create table homes */

            /** START Create table users */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'display_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'unique' => true
                ),
                'password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'role' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30'
                ),
                'role_number' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'default' => ''
                ),
                'img' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'default' => 'default.png'
                ),
                'del_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('users');
            /** START Create table users */

             /** START Create table roles */
             $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'display_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255'
                ),
                'del_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'updated_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'delete_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('roles');
            /** END Create table roles */

            /** START Create table categories */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'del_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'created_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15
                ),
                'updated_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'delete_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('categories');
            /** END Create table categories */

            /** START Create table types */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'id_category' => array(
                    'type' => 'BIGINT',
                    'unsigned' => TRUE,
                ),
                'del_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'created_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15
                ),
                'updated_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'delete_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_category) REFERENCES categories(id)');
            $this->dbforge->create_table('types');
            /** END Create table types */

            /** START Create table posts */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'img' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                    'default' => 'default.png'
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50'
                ),
                'content' => array(
                    'type' => 'LONGTEXT'
                ),
                'like' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'default' => 0
                ),
                'description' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255'
                ),
                'id_type' => array(
                    'type' => 'BIGINT',
                    'unsigned' => TRUE
                ),
                'id_user' => array(
                    'type' => 'BIGINT',
                    'unsigned' => TRUE
                ),
                'del_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'created_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15
                ),
                'updated_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'delete_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_type) REFERENCES types(id)');
            $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_user) REFERENCES users(id)');
            $this->dbforge->create_table('posts');
            /** END Create table posts */

            /** START Create table comments */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'content' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255'
                ),
                'id_post' => array(
                    'type' => 'BIGINT',
                    'unsigned' => TRUE
                ),
                'id_user' => array(
                    'type' => 'BIGINT',
                    'unsigned' => TRUE
                ),
                'updated_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'del_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'delete_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_post) REFERENCES posts(id)');
            $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_user) REFERENCES users(id)');
            $this->dbforge->create_table('comments');
            /** END Create table comments */
            
            /** START Create table positions */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'del_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'created_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15
                ),
                'updated_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'delete_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('positions');
            /** END Create table positions */

            /** START Create table employees */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'img' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                    'default' => 'default.png'
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'id_position' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE
                ),
                'del_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'created_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15
                ),
                'updated_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'delete_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'created_date datetime default current_timestamp', 
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_position) REFERENCES positions(id)');
            $this->dbforge->create_table('employees');
            /** END Create table posts */

            /** START Create table histories */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'table' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                ),
                'id_table' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                ),
                'name_table' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'user' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                ),
                'status' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'message' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255'
                ),
                'seen_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'created_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('histories');
            /** START Create table histories */

            /** START Create table subscribe */
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'del_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'delete_by' => array(
                    'type' => 'BIGINT',
                    'constraint' => 15,
                    'null' => TRUE,
                    'default' => false
                ),
                'seen_flag' => array(
                    'type' => 'BOOLEAN',
                    'default' => false
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp'
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('subscribe');
            /** END Create table subscribe */
        }

        public function down()
        {
            $this->dbforge->drop_table('homes');
            $this->dbforge->drop_table('users');
            $this->dbforge->drop_table('categories');
            $this->dbforge->drop_table('types');
            $this->dbforge->drop_table('posts');
            $this->dbforge->drop_table('positions');
            $this->dbforge->drop_table('employees');
            $this->dbforge->drop_table('histories');
        }
}