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

    public function get_post_by_id($id) {
        return $this->db->get_where('posts', ['post_id' => $id])->row_array();
    }
    
    public function update_post($id, $data) {
        $this->db->where('post_id', $id);
        return $this->db->update('posts', $data);
    }    
}
