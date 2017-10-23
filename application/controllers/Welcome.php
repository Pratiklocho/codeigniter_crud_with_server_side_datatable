<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('Welcome');
    }

    public function addData() {
        extract($_REQUEST);

        $config['upload_path'] = './assets/users_profile/';
        $config['allowed_types'] = 'jpg|png|gif|PNG|JPG|GIF';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $filen = $this->upload->data();
            $filename = $filen['file_name'];
        }

        $data = array(
            'name' => $party_name,
            'email' => $email,
            'gender' => $gender,
            'reg_date' => date('Y-m-d', strtotime($date)),
            'image' => $filename,
            'create_date' => date('Y-m-d H:s:i')
        );

        $id = $this->Data_Model->Insert_data_id('reg', $data);
        $sessdata = ['error' => '<strong>Success!</strong> Add New Brand.', 'errorcls' => 'alert-success'];
        $this->session->set_userdata($sessdata);
        redirect(base_url());
    }

    public function GetData() {

        $requestData = $_REQUEST;

        $columns = array(
            0 => 'reg_id',
            1 => 'name',
            2 => 'email',
            3 => 'gender',
            4 => 'reg_date',
        );

        $sql = "select * from reg where status!='B'";
        $query = $this->Data_Model->Custome_query($sql);
        $totalData = count($query);
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            $sql .= " AND ( reg_id LIKE '" . $requestData['search']['value'] . "%' ";
            $sql .= " OR name LIKE '" . $requestData['search']['value'] . "%' ";
            $sql .= " OR email LIKE '" . $requestData['search']['value'] . "%' ";
            $sql .= " OR gender LIKE '" . $requestData['search']['value'] . "%' ";
            $sql .= " OR reg_date LIKE '" . $requestData['search']['value'] . "%' )";
        } else {
            $c = count($columns);
            for ($i = 0; $i < $c; $i++) {
                if (!empty($requestData['columns'][$i]['search']['value'])) {
                    $sql .= " AND " . $columns[$i] . " LIKE '" . $requestData['columns'][$i]['search']['value'] . "%'  ";
                }
            }
        }
        $query = $this->Data_Model->Custome_query($sql);
        $totalFiltered = count($query);
        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $query = $this->Data_Model->Custome_query($sql);

        $data = array();
        $cnt = $requestData['start'] + 1;


        foreach ($query as $dt) {
            $nestedData = array();
            if ($dt['status'] == "A"):
                $sts = "<a class='status' data-id='" . $dt['reg_id'] . "' data-status='D' ><button class='btn btn-xs btn-success'><span class='fa-stack'><i class='fa fa-flag fa-stack-1x fa-inverse'></i></span></button></a>";
            else:
                $sts = "<a class='status' data-id='" . $dt['reg_id'] . "' data-status='A' ><button class='btn btn-xs btn-default'><span class='fa-stack'><i class='fa fa-flag fa-stack-1x fa-inverse'></i></span></button></a>";
            endif;
            $edit = "<a class='edit' data-id='" . $dt['reg_id'] . "' data-status='" . $dt['status'] . "' ><button class='btn btn-xs btn-info'><span class='fa-stack'><i class='fa fa-pencil fa-stack-1x fa-inverse'></i></span></button></a>";
            $delete = "<a class='delete' data-id='" . $dt['reg_id'] . "' data-status='B' ><button class='btn btn-xs btn-danger'><span class='fa-stack'><i class='fa fa-trash-o fa-stack-1x fa-inverse'></i></span></button></a>";
            if ($dt['gender'] == 'M') {
                $gn = "Male";
            } else {
                $gn = "Female";
            }
            $nestedData[] = $cnt++;
            $nestedData[] = $dt['name'];
            $nestedData[] = $dt['email'];
            $nestedData[] = $gn;
            $nestedData[] = date('Y-m-d', strtotime($dt['reg_date']));
            $nestedData[] = '<img src="' . base_url('assets/users_profile/') . $dt["image"] . '" height="100" width="100">';
            $nestedData[] = $sts . "&nbsp" . $edit . "&nbsp" . $delete;
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    public function change_status() {
        extract($_REQUEST);
        $con = array($tbl . '_id' => $id);
        $data = array('status' => $status);
        $this->Data_Model->Update_data($tbl, $con, $data);
        echo 1;
    }

    public function GetEditData() {
        extract($_POST);
        $con = [$tbl . '_id' => $id];
        $data = $this->Data_Model->Get_data_one($tbl, $con);
        echo json_encode($data);
    }

    public function Edit() {
        extract($_REQUEST);


        if ($images == " ") {
            $con = array('reg_id' => $id);
            $data = array(
                'name' => $party_name,
                'email' => $email,
                'gender' => $gender,
                'reg_date' => date('Y-m-d', strtotime($date)),
                'update_date' => date('Y-m-d H:s:i')
            );
            $this->Data_Model->Update_data('reg', $con, $data);
            $sessdata = ['error' => '<strong>Success!</strong> Add New Brand.', 'errorcls' => 'alert-success'];
            $this->session->set_userdata($sessdata);
            redirect(base_url());
        } else {
            $config['upload_path'] = './assets/users_profile/';
            $config['allowed_types'] = 'jpg|png|gif|PNG|JPG|GIF';
            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('images')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } else {
                $filen = $this->upload->data();
                $filename = $filen['file_name'];
            }

            $data = array(
                'name' => $party_name,
                'email' => $email,
                'gender' => $gender,
                'reg_date' => date('Y-m-d', strtotime($date)),
                'image' => $filename,
                'create_date' => date('Y-m-d H:s:i')
            );
            $con = array('reg_id' => $id);
            

            $this->Data_Model->Update_data('reg', $con, $data);
            $sessdata = ['error' => '<strong>Success!</strong> Add New Brand.', 'errorcls' => 'alert-success'];
            $this->session->set_userdata($sessdata);
            redirect(base_url());
        }
    }

}
