<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Post_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function dashboard()
    {
        $user_id = $this->session->userdata('user_id');
        if ($this->input->post()) {
            $content = $this->input->post('content');
            $this->Post_model->create_post([
                'user_id' => $user_id,
                'content' => $content,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            redirect('/user/dashboard');
        }

        $data['posts'] = $this->Post_model->get_user_posts($user_id);
        $this->load->view('user/dashboard', $data);
    }

    public function explore()
    {
        $user_id = $this->session->userdata('user_id');
        $data['posts'] = $this->Post_model->get_user_posts($user_id); // Show user's posts only
        $this->load->view('user/explore', $data);
    }

    public function info()
    {
        $this->load->view('user/info');
    }

    public function add_post()
    {
        $user_id = $this->session->userdata('user_id');
        $content = $this->input->post('content');

        if (!empty($content)) {
            $this->load->model('Post_model');
            $this->Post_model->create_post($user_id, $content);
        }

        redirect('user/dashboard');
    }

    public function delete_post($post_id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->Post_model->delete_post($post_id, $user_id);
        redirect('index.php/user/dashboard');
    }

    public function edit_post($id)
    {
        $user_id = $this->session->userdata('user_id');
        $post = $this->Post_model->get_post_by_id($id);

        if (!$post || $post['user_id'] != $user_id) {
            show_error('You are not authorized to edit this post.');
        }

        // Check if form is submitted
        if ($this->input->method() === 'post') {
            $content = $this->input->post('content');

            $this->Post_model->update_post($id, [
                'content' => $content,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            redirect('user/dashboard');
        }

        $data['post'] = $post;
        $this->load->view('user/edit_post', $data);
    }

    public function update_profile()
    {
        $this->load->library('session');
        $this->load->model('User_model');

        $user_id = $this->session->userdata('user_id');

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        if ($password && $password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $this->User_model->update_user($user_id, [
                'username' => $username,
                'password' => $hashed_password
            ]);
        } else {
            $this->User_model->update_user($user_id, ['username' => $username]);
        }

        redirect('user/dashboard');
    }

    public function edit_profile()
    {
        $this->load->library('session');
        $this->load->model('User_model');

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        $this->load->view('user/edit_profile', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/user_login');
    }
}
