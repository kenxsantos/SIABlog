<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Ensure db is loaded here
        $this->load->database();
    }
    
    public function create_post($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('posts', $data);
    }

    public function get_user_posts($user_id) {
        return $this->db->get_where('posts', ['user_id' => $user_id])->result_array();
    }

    public function get_all_posts() {
        return $this->db->get('posts')->result_array();
    }

    public function delete_post($post_id) {
        return $this->db->delete('posts', ['post_id' => $post_id]);
    }
}
?>
