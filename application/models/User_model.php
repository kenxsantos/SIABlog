<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Register new user
    public function register($data)
    {
        // Insert user data into the 'users' table
        return $this->db->insert('users', $data);
    }

    // Login user by email
    public function login($email)
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->row_array(); // ✅ important: return as array
    }

    // Get all users
    public function get_all_users()
    {
        // Get all users from the 'users' table
        $this->db->select('user_id, username, email, role, status');
        $query = $this->db->get('users');
        return $query->result_array();  // Return all users
    }
    public function get_user($user_id) {
        return $this->db->get_where('users', ['user_id' => $user_id])->row_array();
    }
    // Delete a user by user_id
    public function delete_user($user_id)
    {
        // Delete user based on user_id
        return $this->db->delete('users', ['user_id' => $user_id]);
    }

    // Update user details (e.g., password or bio)
    public function update_user($user_id, $data)
    {
        // Update user details in 'users' table based on user_id
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $data);
    }

    
    // Check if email already exists (for registration or password reset)
    public function email_exists($email)
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->num_rows() > 0;  // Returns true if email exists
    }

    // Fetch user by user_id
    public function get_user_by_id($user_id) {
        return $this->db->get_where('users', ['user_id' => $user_id])->row_array();
    }

    // Change the user password
    public function change_password($user_id, $new_password)
    {
        // Encrypt the new password and update it in the database
        $password_data = ['password' => password_hash($new_password, PASSWORD_BCRYPT)];
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $password_data);
    }

    // Update user bio
    public function update_bio($user_id, $bio)
    {
        $bio_data = ['bio' => $bio];
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $bio_data);
    }
}
