<?php

class C_Main extends CI_Controller

{
    public $page = 'settings/department';

    public $table_name = 'departments';
    public $col_id = 'department_id';
    public $list = 'list';

    
    public function __construct()
    {
        parent::__construct();
    }


    public function main_index()
    {
        $data = null;
        $this->function_model->load_form('v_template_main',$data);
    }
    

    public function department_index($param = null)
    {
       
        $page = '';
        
        if($param == null)
        {
            $data[$this->list] = $this->function_model->getData($this->table_name,'department_name Asc');      
        }
        else
        {
            $arr = array($this->col_id => $param);
            $data[$this->list] = $this->function_model->getID($this->table_name,$arr);
            $data['table_id'] = $data[$this->list][$this->col_id];

        }
        
        $this->function_model->load_form($this->page,$data);

    }

    public function addDepartment()
    {
        $dept_name = $this->input->post('dept_name');
        $dept_head = $this->input->post('dept_head');

        $arr = array(
            'department_name' => $dept_name,
            'department_head' => $dept_head);
        $this->function_model->addData($this->table_name,$arr);
        // echo 'Insert';
        // print_r($arr);
        redirect(base_url().'department');
    }

    public function editDepartment()
    {
        $edit_id = $this->input->post('id');
        $dept_name = $this->input->post('dept_name');
        $dept_head = $this->input->post('dept_head');

        $arr1 = array($this->col_id => $edit_id);
        $arr2 = array(
            $this->col_id => $edit_id,
            'department_name' => $dept_name,
            'department_head' => $dept_head);

        $this->function_model->updateData($this->table_name,$arr1,$arr2);
        // echo 'Edit';
        // print_r($arr1);
        // print_r($arr2);
        redirect(base_url().'department');
    }

    public function deleteDepartment()
    {
        $del_id = $this->input->post('id');
        $arr = array($this->col_id => $del_id);

        //$data[$this->list] = $this->function_model->getID($this->table_name,array($this->col_id => $del_id));

        $this->function_model->deleteData($this->table_name,$arr);
        // echo 'Delete';
        // print_r($arr);
        redirect(base_url().'department');
    }


}




?>