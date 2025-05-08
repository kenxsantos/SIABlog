<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function log_action($admin_id, $action) {
    return $this->db->insert('admin_logs', [
        'admin_id' => $admin_id,
        'action' => $action
    ]);
}
}
