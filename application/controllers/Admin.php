<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['User_model', 'Post_model']);
        $this->load->library('session');  // Make sure this line is added
        $this->load->helper('url');
    }

    public function dashboard() {
        // Check if the admin is logged in
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/admin_login'); // Redirect to login if not logged in
        }

        $data['posts'] = $this->Post_model->get_all_posts();
        $this->load->view('admin/dashboard', $data);
    }

    public function users() {
        // Check if the admin is logged in
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/admin_login'); // Redirect to login if not logged in
        }

        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('admin/users', $data);
    }

    public function delete_user($user_id) {
        // Check if the admin is logged in
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/admin_login'); // Redirect to login if not logged in
        }

        $this->User_model->delete_user($user_id);
        redirect('admin/users');
    }

    public function delete_post($post_id) {
        // Check if the admin is logged in
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/admin_login'); // Redirect to login if not logged in
        }

        $this->Post_model->delete_post($post_id);
        redirect('admin/dashboard');
    }
}
?>
