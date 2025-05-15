<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function register($data)
    {
        return $this->db->insert('users', $data);
    }

    public function login($email)
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->row_array();
    }


    public function get_all_users()
    {
        $query = $this->db->get('users');
        return $query->result_array();
    }


    public function delete_user($user_id)
    {
        return $this->db->delete('users', ['user_id' => $user_id]);
    }

    public function update_user($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $data);
    }


    public function email_exists($email)
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->num_rows() > 0;
    }

    public function get_user_by_id($user_id)
    {
        $query = $this->db->get_where('users', ['user_id' => $user_id]);
        return $query->row_array();
    }


    public function change_password($user_id, $new_password)
    {

        $password_data = ['password' => password_hash($new_password, PASSWORD_BCRYPT)];
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $password_data);
    }


    public function update_bio($user_id, $bio)
    {
        $bio_data = ['bio' => $bio];
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $bio_data);
    }
}
