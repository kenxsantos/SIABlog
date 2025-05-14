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
        $user_id = $this->session->userdata('user_id');

        if ($this->input->post()) {
            $content = $this->input->post('content');
            $tag_id = $this->input->post('tag_id'); // Single tag selected

            $this->Post_model->create_post([
                'user_id' => $user_id,
                'content' => $content,
                'tag_id' => $tag_id, // Store only the selected tag ID
                'created_at' => date('Y-m-d H:i:s')
            ]);

            redirect('user/dashboard');
        }

        $data['posts'] = $this->Post_model->get_user_posts($user_id);
        $data['tags'] = $this->Tag_model->get_all_tags();
        $this->load->view('user/dashboard', $data);
    }


    // Show a single user
    public function show($user_id)
    {
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        if (!$data['user']) {
            show_404();
        }
        $this->load->view('users/show', $data);
    }

    public function login($email)
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->row_array(); // ✅ important: return as array
    }


    // Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user/login');
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
    // Delete user
    public function delete($user_id)
    {
        $this->User_model->delete_user($user_id);
        redirect('user/index');
    }
}