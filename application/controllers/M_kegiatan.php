<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_kegiatan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_kegiatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $m_kegiatan = $this->M_kegiatan_model->get_all();

        $data = array(
            'm_kegiatan_data' => $m_kegiatan
        );

        $this->template->load('template','m_kegiatan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->M_kegiatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kegiatan' => $row->id_kegiatan,
		'nama_kegiatan' => $row->nama_kegiatan,
		'keterangan' => $row->keterangan,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','m_kegiatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_kegiatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('m_kegiatan/create_action'),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'nama_kegiatan' => set_value('nama_kegiatan'),
	    'keterangan' => set_value('keterangan'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','m_kegiatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->M_kegiatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('m_kegiatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_kegiatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('m_kegiatan/update_action'),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','m_kegiatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_kegiatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kegiatan', TRUE));
        } else {
            $data = array(
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->M_kegiatan_model->update($this->input->post('id_kegiatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('m_kegiatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_kegiatan_model->get_by_id($id);

        if ($row) {
            $this->M_kegiatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('m_kegiatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_kegiatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kegiatan', 'nama kegiatan', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
	$this->form_validation->set_rules('aktif', 'aktif', 'trim');

	$this->form_validation->set_rules('id_kegiatan', 'id_kegiatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "m_kegiatan.xls";
        $judul = "m_kegiatan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Aktif");

	foreach ($this->M_kegiatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->aktif);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=m_kegiatan.doc");

        $data = array(
            'm_kegiatan_data' => $this->M_kegiatan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('m_kegiatan_doc',$data);
    }

    function pdf()
    {
        $data = array(
            'm_kegiatan_data' => $this->M_kegiatan_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('m_kegiatan_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('m_kegiatan.pdf', 'D'); 
    }

}

/* End of file M_kegiatan.php */
/* Location: ./application/controllers/M_kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-04-05 20:56:11 */
/* http://harviacode.com */