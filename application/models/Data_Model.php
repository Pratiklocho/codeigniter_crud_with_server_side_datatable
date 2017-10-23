<?php

/**
 * Created by PhpStorm.
 * User: Pratik Lochawala
 * Date: 23/10/17
 * Time: 10:42 AM
 */
class Data_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
        date_default_timezone_set('Asia/Calcutta');
    }

    function Get_data($tbl) {
        $query = $this->db->get($tbl);
        return $query->result_array();
    }

    function Get_data_order($tbl, $tblcol, $type) {
        $this->db->order_by($tblcol, $type);
        $query = $this->db->get($tbl);
        return $query->result_array();
    }

    function Insert_data($tbl, $data) {
        $this->db->insert($tbl, $data);
    }

    function Insert_batch($tbl, $data) {
        $this->db->insert_batch($tbl, $data);
    }

    function Insert_data_id($tbl, $data) {
        $this->db->insert($tbl, $data);
        $query = $this->db->insert_id();
        return $query;
    }

    function Update_data($tbl, $con, $data) {
        $this->db->where($con);
        $this->db->update($tbl, $data);
        return $this->db->affected_rows();
    }

    function Update_batch($tbl, $data, $con) {
        $this->db->update_batch($tbl, $data, $con);
        return $this->db->affected_rows();
    }

    function Deleta_data($tbl, $con) {
        $this->db->where($con);
        $this->db->delete($tbl);
    }

    function Get_data_all($tbl, $con) {
        $this->db->where($con);
        $query = $this->db->get($tbl);
        return $query->result_array();
    }

    function Get_data_order_all($tbl, $con, $tblcol, $type) {
        $this->db->order_by($tblcol, $type);
        $this->db->where($con);
        $query = $this->db->get($tbl);
        return $query->result_array();
    }

    function Get_data_one($tbl, $con) {
        $this->db->where($con);
        $res = $this->db->get($tbl);
        $query = $res->result_array();
        return $query[0];
    }

    function Custome_query($str) {
        $query = $this->db->query($str);
        return $query->result_array();
    }

    function Custome_query_exe($str) {
        $query = $this->db->query($str);
    }

    function change_status($id, $table) {
        $this->db->where($table . '_id', $id);
        $ans = $this->db->get($table);
        $data = $ans->result_array();
        if ($data[0]['status'] == 0)
            $info['status'] = 1;
        else
            $info['status'] = 0;
        $this->db->where($table . '_id', $id);
        $this->db->update($table, $info);
        return $info['status'];
    }

    function Login() {
        extract($_POST);
        $username = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('status', 'A');
        $query = $this->db->get('admin');
        $res = $query->result_array();
        if (count($res) == 1) {
            $row = $query->row();
            $data = array(
                'name' => $row->name,
                'password' => $row->password,
                'id' => $row->of_admin_id,
                'role' => $row->role,
                'validated' => true,
            );
            $this->session->set_userdata($data);
            if (isset($rmmbr)) {
                setcookie("username", $row->username, time() + (10 * 365 * 24 * 60 * 60));
                setcookie("password", $row->password, time() + (10 * 365 * 24 * 60 * 60));
            }
            return true;
        }
        return false;
    }

    public function sentmail($email, $title, $subject, $msg) {
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.googlemail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "your email address";
        $config['smtp_pass'] = "your password";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        $ci->email->from("lochawalapratik5@gmail.com", $title);
        $list = array($email);
        $ci->email->to($list);
        $ci->email->subject($subject);
        $ci->email->message($msg);
        $ci->email->send();
    }


    public function __destruct() {
        $this->db->close();
    }

}
