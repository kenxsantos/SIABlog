<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['User_model', 'Post_model']);
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('url');
    }

    // Admin Dashboard
    public function dashboard() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/admin_login');
        }
    
        // Load admin dashboard view
        $this->load->view('admin/dashboard');
    }

    // Show all users (excluding Admins)
    public function users() {
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/admin_login');
        }

        $data['users'] = $this->User_model->get_all_users(); // Load users from model
        $this->load->view('admin/users', $data);
    }

    // View a single user's posts
    public function view_user_posts($user_id) {
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/admin_login');
        }

        $data['posts'] = $this->Post_model->get_posts_by_user($user_id);
        $data['user'] = $this->User_model->get_user($user_id);
        $this->load->view('admin/user_posts', $data);
    }

    // Edit user (stub, for later expansion)
    public function edit_user($user_id) {
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/admin_login');
        }

        // Logic for editing user goes here
        echo "Edit user functionality for user ID: " . $user_id;
    }

    // Delete user
    public function delete_user($user_id) {
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/admin_login');
        }

        $this->User_model->delete_user($user_id);
        redirect('admin/users');
    }

    // Delete post
    public function delete_post($post_id) {
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/admin_login');
        }

        $this->Post_model->delete_post($post_id);
        redirect('admin/dashboard');
    }
}
