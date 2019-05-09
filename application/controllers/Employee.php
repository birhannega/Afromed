<?php

class Employee extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->not_logged_in();
        
        $this->data['page_title'] = 'Users';
        
        
        $this->load->model('model_employee');
        $this->load->model('model_groups');
    }
    
    
    public function index()
    {
        if (!in_array('viewEmployee', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $user_data = $this->model_employee->getEmployeeData();
        $result = array();
        foreach ($user_data as $k => $v) {
            
            $result[$k]['user_info'] = $v;
            
            $group = $this->model_employee->getUserGroup($v['emp_user_id']);
            $result[$k]['user_group'] = $group;
        }
        $this->data['user_data'] = $result;
        $this->render_template('employee/index', $this->data);
    }
    
    public function create()
    {
        if (!in_array('createUser', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        
        $this->form_validation->set_rules('fname', 'First name', 'trim|required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('mname', 'Middle name', 'trim|required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('lname', 'Last name', 'trim|required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'trim|is_unique[tbl_employee.emp_email]');
        $this->form_validation->set_rules('phone', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('salary', 'Salary', 'trim|required');
        $this->form_validation->set_rules('hdate', 'Hire Date', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="error text-danger">', '</p>');
        
        if ($this->form_validation->run() == TRUE) {
            // true case
            $currentDate = date("Y-m-d H:i:s", strtotime("now"));
            $loggeduser = $this->session->userdata('username');
            $data = array(
                'emp_first_name' => $this->input->post('fname'),
                'emp_middle_name' => $this->input->post('mname'),
                'emp_last_name' => $this->input->post('lname'),
                'emp_hire_date' => $this->input->post('hdate'),
                'emp_email' => $this->input->post('email'),
                'emp_salary' => $this->input->post('salary'),
                'emp_phone' => $this->input->post('phone'),
                'emp_gender' => $this->input->post('gender'),
                'emp_created_by' => $loggeduser,
                'emp_date_created' => $currentDate
            );
            
            $create = $this->model_employee->create($data);
            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('employee/', 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('employee/create', 'refresh');
            }
        } else {
            // false case
            $group_data = $this->model_groups->getGroupData();
            $this->data['group_data'] = $group_data;
            
            $this->render_template('employee/create', $this->data);
        }
        
        
    }
    
    public function password_hash($pass = '')
    {
        if ($pass) {
            $password = password_hash($pass, PASSWORD_DEFAULT);
            return $password;
        }
    }
    
    public function edit($id = null)
    {
        if (!in_array('updateEmployee', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        if ($id) {
            $this->form_validation->set_rules('fname', 'First name', 'trim|required|min_length[3]|max_length[12]');
            $this->form_validation->set_rules('mname', 'Middle name', 'trim|required|min_length[3]|max_length[12]');
            $this->form_validation->set_rules('lname', 'Last name', 'trim|required|min_length[3]|max_length[12]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('phone', 'phone', 'trim|required|min_length[10]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('salary', 'Salary', 'trim|required');
            $this->form_validation->set_rules('hdate', 'Hire Date', 'trim|required');
            
            if ($this->form_validation->run() == TRUE) {
                // true case
                if (empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
                    $data = array(
                        'emp_first_name' => $this->input->post('fname'),
                        'emp_middle_name' => $this->input->post('mname'),
                        'emp_last_name' => $this->input->post('lname'),
                        'emp_hire_date' => $this->input->post('hdate'),
                        'emp_email' => $this->input->post('email'),
                        'emp_salary' => $this->input->post('salary'),
                        'emp_phone' => $this->input->post('phone'),
                        'emp_gender' => $this->input->post('gender'),
                        'emp_created_by' => $this->session->userdata('username'),
                        'emp_date_created' => date('ee-mm-2017')
                    );
                    
                    $update = $this->model_employee->edit($data, $id, $this->input->post('groups'));
                    if ($update == true) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect('employee/', 'refresh');
                    } else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect('employee/edit/' . $id, 'refresh');
                    }
                } else {
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
                    $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
                    
                    if ($this->form_validation->run() == TRUE) {
                        
                        $password = $this->password_hash($this->input->post('password'));
                        
                        $data = array(
                            'username' => $this->input->post('username'),
                            'password' => $password,
                            'email' => $this->input->post('email'),
                            'firstname' => $this->input->post('fname'),
                            'lastname' => $this->input->post('lname'),
                            'phone' => $this->input->post('phone'),
                            'gender' => $this->input->post('gender'),
                        );
                        
                        $update = $this->model_employee->edit($data, $id, $this->input->post('groups'));
                        if ($update == true) {
                            $this->session->set_flashdata('success', 'Successfully updated');
                            redirect('employee/');
                        } else {
                            $this->session->set_flashdata('errors', 'Error occurred!!');
                            redirect('employee/edit/' . $id);
                        }
                    } else {
                        // false case
                        $user_data = $this->model_employee->getEmployeeData($id);
                        $groups = $this->model_employee->getUserGroup($id);
                        
                        $this->data['user_data'] = $user_data;
                        $this->data['user_group'] = $groups;
                        
                        $group_data = $this->model_groups->getGroupData();
                        $this->data['group_data'] = $group_data;
                        
                        $this->render_template('employee/edit', $this->data);
                    }
                    
                }
            } else {
                // false case
                $user_data = $this->model_employee->getEmployeeData($id);
                $groups = $this->model_employee->getUserGroup($id);
                
                $this->data['user_data'] = $user_data;
                $this->data['user_group'] = $groups;
                
                $group_data = $this->model_groups->getGroupData();
                $this->data['group_data'] = $group_data;
                
                $this->render_template('employee/edit', $this->data);
            }
        }
    }
    
    public function delete($id)
    {
        if (!in_array('deleteEmployee', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        if ($id) {
            if ($this->input->post('confirm')) {
                $delete = $this->model_employee->delete($id);
                if ($delete == true) {
                    $this->session->set_flashdata('success', 'Successfully removed');
                    redirect('employee/');
                } else {
                    $this->session->set_flashdata('error', 'Error occurred!!');
                    redirect('employee/delete/' . $id);
                }
                
            } else {
                $this->data['id'] = $id;
                $this->render_template('employee/delete', $this->data);
            }
        }
    }
    
    public function profile()
    {
        if (!in_array('viewProfile', $this->permission)) {
            redirect('dashboard');
        }
        
        $user_id = $this->session->userdata('id');
        
        $user_data = $this->model_employee->getUserData($user_id);
        $this->data['user_data'] = $user_data;
        
        $user_group = $this->model_employee->getUserGroup($user_id);
        $this->data['user_group'] = $user_group;
        
        $this->render_template('employee/profile', $this->data);
    }
    function show($id){
        if (!in_array('viewEmployee', $this->permission)) {
            redirect('dashboard');
        }
        if ($id) {
            $user_data = $this->model_employee->getEmployeeData($id);
            $result = array();
            foreach ($user_data as $k => $v) {
                $result[$k] = $v;
            }
            $this->data['user_data'] = $result;
            $this->render_template('employee/profile', $this->data);
        }
    }
    /**
     *
     */
    public function setting()
    {
        if (!in_array('updateSetting', $this->permission)) {
            redirect('dashboard');
        }
        
        $id = $this->session->userdata('id');
        
        if ($id) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('fname', 'First name', 'trim|required');
            
            
            if ($this->form_validation->run() == TRUE) {
                // true case
                if (empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
                    $data = array(
                        'username' => $this->input->post('username'),
                        'email' => $this->input->post('email'),
                        'firstname' => $this->input->post('fname'),
                        'lastname' => $this->input->post('lname'),
                        'phone' => $this->input->post('phone'),
                        'gender' => $this->input->post('gender'),
                    );
                    
                    $update = $this->model_employee->edit($data, $id);
                    if ($update == true) {
                        $this->session->set_flashdata('success', 'Successfully updated');
                        redirect('users/setting/');
                    } else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect('users/setting/');
                    }
                } else {
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
                    $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
                    
                    if ($this->form_validation->run() == TRUE) {
                        
                        $password = $this->password_hash($this->input->post('password'));
                        
                        $data = array(
                            'username' => $this->input->post('username'),
                            'password' => $password,
                            'email' => $this->input->post('email'),
                            'firstname' => $this->input->post('fname'),
                            'lastname' => $this->input->post('lname'),
                            'phone' => $this->input->post('phone'),
                            'gender' => $this->input->post('gender'),
                        );
                        
                        $update = $this->model_employee->edit($data, $id, $this->input->post('groups'));
                        if ($update == true) {
                            $this->session->set_flashdata('success', 'Successfully updated');
                            redirect('users/setting/');
                        } else {
                            $this->session->set_flashdata('errors', 'Error occurred!!');
                            redirect('users/setting/');
                        }
                    } else {
                        // false case
                        $user_data = $this->model_employee->getUserData($id);
                        $groups = $this->model_employee->getUserGroup($id);
                        
                        $this->data['user_data'] = $user_data;
                        $this->data['user_group'] = $groups;
                        
                        $group_data = $this->model_groups->getGroupData();
                        $this->data['group_data'] = $group_data;
                        
                        $this->render_template('users/setting', $this->data);
                    }
                }
            } else {
                // false case
                $user_data = $this->model_employee->getUserData($id);
                $groups = $this->model_employee->getUserGroup($id);
                
                $this->data['user_data'] = $user_data;
                $this->data['user_group'] = $groups;
                
                $group_data = $this->model_groups->getGroupData();
                $this->data['group_data'] = $group_data;
                
                $this->render_template('users/setting', $this->data);
            }
        }
    }
}