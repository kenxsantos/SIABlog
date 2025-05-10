<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function register()
    {
        if ($this->input->post()) {
            // Gather form data
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password_raw = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');

            if ($password_raw !== $confirm_password) {
                echo "Passwords do not match!";
                return;
            }

            $password = password_hash($password_raw, PASSWORD_BCRYPT);

            // Prepare data to insert into the database
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => 'User',
                'status' => 'Active',
                'created_at' => date('Y-m-d H:i:s')  // Adding created_at field
            ];

            // Insert data into database using model
            $result = $this->User_model->register($data);

            // Debug: Check if the insert was successful
            if ($result) {
                log_message('debug', 'User registration successful');
                redirect('auth/user_login'); // Redirect to login page after successful registration
            } else {
                log_message('error', 'User registration failed');
                echo "Something went wrong, please try again!";
            }
        }

        $this->load->view('auth/register');
    }


    public function admin_login()
    {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->login($email);

            if ($user && $user['role'] == 'Admin' && password_verify($password, $user['password'])) {
                $this->session->set_userdata('admin_id', $user['user_id']);
                redirect('admin/dashboard');
            } else {
                echo "alert(Invalid admin credentials.);";
            }
        }
        $this->load->view('auth/admin_login');
    }

    public function user_login()
    {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->login($email);

            if ($user && $user['role'] == 'User' && password_verify($password, $user['password'])) {
                $this->session->set_userdata('user_id', $user['user_id']);
                redirect('user/dashboard');
            } else {
                echo "<script>alert('Invalid email or password.');</script>";

            }
        }
        $this->load->view('auth/user_login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/user_login');
    }
}
