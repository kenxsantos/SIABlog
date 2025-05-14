<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Post_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    /**
     * Show all posts by a user
     */
    public function user_posts($user_id)
    {
        $data['posts'] = $this->Post_model->get_user_posts($user_id);
        $this->load->view('posts/user_posts', $data);
    }

    /**
     * Show single post
     */
    public function show($post_id)
    {
        $data['post'] = $this->Post_model->get_post_by_id($post_id);
        if (!$data['post']) {
            show_404();
        }
        $this->load->view('posts/show', $data);
    }

    /**
     * Create a new post
     */
    public function create()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('user_id', 'User ID', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('user/dashboard');
        } else {
            $data = [
                'title'      => $this->input->post('title'),
                'content'    => $this->input->post('content'),
                'user_id'    => $this->input->post('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->Post_model->create_post($data);
            redirect('user/dashboard' . $data['user_id']);
        }
    }

    /**
     * Edit a post
     */

    public function edit_post($post_id)
    {
        $user_id = $this->session->userdata('user_id');
        $post = $this->Post_model->get_post_by_id($post_id, $user_id);

        if (!$post) {
            show_404(); // Prevent editing others' posts
        }

        // If form is submitted
        if ($this->input->post()) {
            $content = $this->input->post('content');
            $this->Post_model->edit_post($post_id, $user_id, $content);
            redirect('user/dashboard');
        }

        $data['post'] = $post;
        $this->load->view('user/edit_post', $data);
    }


    /**
     * Delete a post
     */
    public function delete($post_id, $user_id)
    {
        $this->Post_model->delete_post($post_id, $user_id);
        redirect('post/user_posts/' . $user_id);
    }
}