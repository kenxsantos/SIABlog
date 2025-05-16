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
            ->select('posts.*, tags.name AS tag_name')
            ->join('tags', 'tags.id = posts.tag_id', 'left')
            ->order_by('posts.created_at', 'DESC')
            ->get_where('posts', ['user_id' => $user_id])
            ->result_array();
    }

    public function get_all_posts()
    {
        return $this->db
            ->select('posts.*, tags.name AS tag_name, users.username')
            ->from('posts')
            ->join('tags', 'tags.id = posts.tag_id', 'left')
            ->join('users', 'users.user_id = posts.user_id', 'left')
            ->order_by('posts.created_at', 'DESC')
            ->get()
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
    public function delete_admin_post($post_id)
    {
        return $this->db->delete('posts', ['post_id' => $post_id]);
    }

    public function get_post_by_id($post_id)
    {
        return $this->db->get_where('posts', ['post_id' => $post_id,])->row_array();
    }

    public function edit_admin_post($post_id, $tag_id, $content)
    {
        $data = [
            'content' => $content,
            'tag_id' => $tag_id
        ];

        $this->db->where('post_id', $post_id);
        return $this->db->update('posts', $data);
    }




    public function edit_post($post_id, $user_id, $tag_id, $content)
    {
        $data = [
            'content' => $content,
            'tag_id' => $tag_id
        ];

        $this->db->where('post_id', $post_id);
        $this->db->where('user_id', $user_id);
        return $this->db->update('posts', $data);
    }
}
