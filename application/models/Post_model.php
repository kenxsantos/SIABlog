<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function get_user_posts($user_id)
    {
        return $this->db
            ->order_by('created_at', 'DESC')
            ->get_where('posts', ['user_id' => $user_id])
            ->result_array();
    }

    public function get_all_posts()
    {
        return $this->db
            ->order_by('created_at', 'DESC')
            ->get('posts')
            ->result_array();
    }

    public function create_post($data)
    {
        return $this->db->insert('posts', $data);
    }

    public function delete_post($post_id, $user_id)
    {
        return $this->db->delete('posts', ['post_id' => $post_id, 'user_id' => $user_id]);
    }

    public function get_post_by_id($post_id)
    {
        return $this->db->get_where('posts', ['post_id' => $post_id,])->row_array();
    }

    public function edit_post($post_id, $user_id, $content)
    {
        $this->db->where('post_id', $post_id);
        $this->db->where('user_id', $user_id);
        return $this->db->update('posts', ['content' => $content]);
    }
}