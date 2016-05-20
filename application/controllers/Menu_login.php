<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_login extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_menu_login');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'menu_login/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'menu_login/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'menu_login/index.html';
            $config['first_url'] = base_url() . 'menu_login/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_menu_login->total_rows($q);
        $menu_login = $this->M_menu_login->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'menu_login_data' => $menu_login,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','login_attempts_list', $data);
    }

    public function read($id) 
    {
        $row = $this->M_menu_login->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'ip_address' => $row->ip_address,
		'login' => $row->login,
		'time' => $row->time,
	    );
            $this->template->load('template','login_attempts_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_login'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('menu_login/create_action'),
	    'id' => set_value('id'),
	    'ip_address' => set_value('ip_address'),
	    'login' => set_value('login'),
	    'time' => set_value('time'),
	);
        $this->template->load('template','login_attempts_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ip_address' => $this->input->post('ip_address',TRUE),
		'login' => $this->input->post('login',TRUE),
		'time' => $this->input->post('time',TRUE),
	    );

            $this->M_menu_login->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menu_login'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_menu_login->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('menu_login/update_action'),
		'id' => set_value('id', $row->id),
		'ip_address' => set_value('ip_address', $row->ip_address),
		'login' => set_value('login', $row->login),
		'time' => set_value('time', $row->time),
	    );
            $this->template->load('template','login_attempts_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_login'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'ip_address' => $this->input->post('ip_address',TRUE),
		'login' => $this->input->post('login',TRUE),
		'time' => $this->input->post('time',TRUE),
	    );

            $this->M_menu_login->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menu_login'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_menu_login->get_by_id($id);

        if ($row) {
            $this->M_menu_login->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu_login'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_login'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ip_address', 'ip address', 'trim|required');
	$this->form_validation->set_rules('login', 'login', 'trim|required');
	$this->form_validation->set_rules('time', 'time', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Menu_login.php */
/* Location: ./application/controllers/Menu_login.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-20 18:57:28 */
/* http://harviacode.com */