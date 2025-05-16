<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_posts extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field([
            'user_id' => [
                'type' => 'INT',
                'unsigned' => TRUE
            ],
            'post_id' => [
                'type' => 'INT',
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'content' => [
                'type' => 'TEXT'
            ],
            'tag_id' => [
                'type'     => 'INT',
                'unsigned' => TRUE
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ]
        ]);
        $this->dbforge->add_key('post_id', TRUE);
        $this->dbforge->create_table('posts');
    }

    public function down()
    {
        if ($this->db->table_exists('posts')) {
            $this->dbforge->drop_table('posts');
        }
    }
}