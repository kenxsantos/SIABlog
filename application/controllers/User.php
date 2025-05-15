<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Post_model');
        $this->load->model('Tag_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
        $this->load->library(['form_validation', 'session']);
    }



    public function dashboard()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/user_login');
        }
        $user_id = $this->session->userdata('user_id');
        $tag_id = $this->input->post('tag_id');
        if ($this->input->post()) {
            $content = $this->input->post('content');
            $this->Post_model->create_post([
                'user_id' => $user_id,
                'content' => $content,
                'tag_id' => $tag_id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            redirect('user/dashboard');
        }
        $data['users'] = $this->User_model->get_all_users();
        $data['posts'] = $this->Post_model->get_all_posts();
        $data['tags'] = $this->Tag_model->get_all_tags();

        $this->load->view('user/dashboard', $data);
    }
    public function edit_post($post_id)
    {
        $user_id = $this->session->userdata('user_id');
        $post = $this->Post_model->get_post_by_id($post_id);

        if (!$post) {
            show_404();
        }

        if ($this->input->post()) {
            $content = $this->input->post('content');
            $tag_id = $this->input->post('tag_id');
            $this->Post_model->edit_post($post_id, $user_id, $tag_id, $content);
            redirect('user/dashboard');
        }

        $data['post'] = $post;
        $data['tags'] = $this->Tag_model->get_all_tags();
        $this->load->view('user/edit_post', $data);
    }


    public function explore()
    {
        $user_id = $this->session->userdata('user_id');
        $data['posts'] = $this->Post_model->get_user_posts($user_id);
        $this->load->view('user/explore', $data);
    }

    public function info()
    {
        $this->load->view('user/info');
    }


    public function delete_post($post_id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->Post_model->delete_post($post_id, $user_id);
        redirect('user/dashboard');
    }

    public function edit_profile()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            redirect('auth/user_login');
            return;
        }

        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('user/update_profile', $data); // create or use this view
    }


    public function update_profile()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            redirect('auth/user_login');
            return;
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        $update_data = ['username' => $username];

        if (!empty($password)) {
            if ($password === $confirm_password) {
                $update_data['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $this->session->set_flashdata('error', 'Passwords do not match');
                redirect('user/edit_profile');
                return;
            }
        }

        $this->User_model->update_user($user_id, $update_data);
        $this->session->set_flashdata('success', 'Profile updated successfully');
        redirect('user/edit_profile');
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/user_login');
    }
}
