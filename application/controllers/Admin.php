<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['User_model', 'Post_model', 'Tag_model']);
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('url');
    }

    // Admin Dashboard


    public function dashboard()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/admin_login');
        }
        $user_id = $this->session->userdata('admin_logged_in');

        $data['users'] = $this->User_model->get_all_users();
        $data['posts'] = $this->Post_model->get_all_posts();
        $data['tags'] = $this->Tag_model->get_all_tags();
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('admin/dashboard', $data);
    }

    // Show all users (excluding Admins)
    public function users()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/admin_login');
        }
        $data['users'] = $this->User_model->get_all_users();
        $data['posts'] = $this->Post_model->get_all_posts();
        $this->load->view('admin/users', $data);
    }

    // View a single user's posts
    public function view_user_posts($user_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/admin_login');
        }

        $data['posts'] = $this->Post_model->get_user_posts($user_id);
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('admin/view_user_post', $data);
    }


    public function edit_post($post_id)
    {
        $post = $this->Post_model->get_post_by_id($post_id);
        if (!$post) {
            show_404();
        }
        if ($this->input->post()) {
            $content = $this->input->post('content');
            $tag_id = $this->input->post('tag_id');
            $this->Post_model->edit_admin_post($post_id, $tag_id, $content);
            redirect('admin/dashboard');
        }
        $data['post'] = $post;
        $data['tags'] = $this->Tag_model->get_all_tags();
        $this->load->view('admin/edit_post', $data);
    }



    public function show_edit_user($user_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/admin_login');
            return;
        }

        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('admin/edit_profile', $data);
    }


    public function edit_user()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/admin_login');
            return;
        }

        $user_id = $this->input->post('user_id'); // Ensure user_id is posted

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        $update_data = ['username' => $username];

        if (!empty($password)) {
            if ($password === $confirm_password) {
                $update_data['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $this->session->set_flashdata('error', 'Passwords do not match');
                redirect('admin/show_edit_user/' . $user_id);
                return;
            }
        }

        $this->User_model->update_user($user_id, $update_data);
        $this->session->set_flashdata('success', 'Profile updated successfully');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('admin/edit_profile', $data);
        redirect('admin/users');
    }




    // Delete user
    public function delete_user($user_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/admin_login');
        }
        $this->User_model->delete_user($user_id);
        redirect('admin/users');
    }

    // Delete post
    public function delete_post($post_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/admin_login');
        }
        $this->Post_model->delete_admin_post($post_id);
        redirect('admin/dashboard');
    }
}
//