<?php
class Admin_model extends CI_Model {

    public function get_admin_by_email($email)
    {
        $query = $this->db->get_where('admins', ['email' => $email]);
        return $query->row_array();
    }
}