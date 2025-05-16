<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tag_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_tags()
    {
        return $this->db->get('tags')->result_array();
    }

    // public function get_user_tags($user_id)
    // {
    //     return $this->db
    //         ->order_by('created_at', 'DESC')
    //         ->get_where('tags', ['id' => $user_id])
    //         ->result_array();
    // }
    public function get_tag_name_by_id($id)
    {
        $this->db->select('name');
        $this->db->from('tags');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row_array();

        return $result ? $result['name'] : null;
    }


    public function get_tag_by_id($id)
    {
        $query = $this->db->get_where('tags', ['id' => $id]);
        return $query->row_array();
    }
}
