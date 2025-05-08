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
        $data['posts'] = $this->Post_model->get_user_posts($user_id);
        $this->load->view('user/dashboard', $data);
    }

    public function explore()
    {
        $data['posts'] = $this->Post_model->get_all_posts();
        $this->load->view('user/explore', $data);
    }


    public function info()
    {
        $this->load->view('user/info');
    }

    public function create_post()
    {
        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'content' => $this->input->post('content')
        ];
        $this->Post_model->create_post($data);
        redirect('user/dashboard');
    }

    public function delete_post($post_id)
    {
        $this->Post_model->delete_post($post_id);
        redirect('user/dashboard');
    }
}
