<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_tags extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tags');
    }

    public function down()
    {
        if ($this->db->table_exists('tags')) {
            $this->dbforge->drop_table('tags');
        }
    }
}