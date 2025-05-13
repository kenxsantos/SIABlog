<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

    public function get_user_posts($user_id) {
        return $this->db->get_where('posts', ['user_id' => $user_id])->result_array();
    }

    public function create_post($data) {
        return $this->db->insert('posts', $data);
    }

    public function delete_post($post_id, $user_id) {
        return $this->db->delete('posts', ['post_id' => $post_id, 'user_id' => $user_id]);
    }

    // Get a single post
    public function get_post_by_id($post_id) {
    return $this->db->get_where('posts', ['post_id' => $post_id,])->row_array();
}
    // Update a post
    public function edit_post($post_id, $user_id, $content) {
        $this->db->where('post_id', $post_id);
        $this->db->where('user_id', $user_id);
        return $this->db->update('posts', ['content' => $content]);
    }    
}
