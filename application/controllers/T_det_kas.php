<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_det_kas extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_det_kas_model');
        $this->load->library('form_validation');

    }

    public function index()
    {
        $t_det_kas = $this->T_det_kas_model->get_all();

        $data = array(
            't_det_kas_data' => $t_det_kas
        );

        $this->template->load('template','t_det_kas_list', $data);
    }

    public function read($id) 
    {
        $row = $this->T_det_kas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kas' => $row->id_kas,
		'nama_kegiatan' => $row->nama_kegiatan,
		'pengeluaran' => $row->pengeluaran,
		'pemasukan' => $row->pemasukan,
		'saldo' => $row->saldo_akhir,
		'keterangan' => $row->keterangan,
		'tanggal' => $row->tanggal,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','t_det_kas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_det_kas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_det_kas/create_action'),
	    'id_kas' => set_value('id_kas'),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'pengeluaran' => set_value('pengeluaran'),
	    'pemasukan' => set_value('pemasukan'),
	    'saldo' => set_value('saldo'),
	    'keterangan' => set_value('keterangan'),
	    'tanggal' => set_value('tanggal'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','t_det_kas_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
			$data2 = array(
			'bulan' => substr($this->input->post('tanggal',TRUE),5,2),
			'tahun' => substr($this->input->post('tanggal',TRUE),0,4),
			);
			$no_kwitansi = $this->T_det_kas_model->getNomorKwitansi($data2);
						
            $data = array(
		'no_kwitansi' => $no_kwitansi,	
		'id_kegiatan' => $this->input->post('id_kegiatan',TRUE),
		'bulan' => substr($this->input->post('tanggal',TRUE),5,2),
		'tahun' => substr($this->input->post('tanggal',TRUE),0,4),
		'pengeluaran' => $this->input->post('pengeluaran',TRUE),
		'pemasukan' => $this->input->post('pemasukan',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );
            $this->T_det_kas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_det_kas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_det_kas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_det_kas/update_action'),
		'id_kas' => set_value('id_kas', $row->id_kas),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'no_kwitansi' => set_value('no_kwitansi', $row->no_kwitansi),
		'pengeluaran' => set_value('pengeluaran', $row->pengeluaran),
		'pemasukan' => set_value('pemasukan', $row->pemasukan),
		'saldo' => set_value('saldo', $row->saldo_akhir),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','t_det_kas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_det_kas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kas', TRUE));
        } else {
            $data = array(
		'id_kegiatan' => $this->input->post('id_kegiatan',TRUE),
		'bulan' => substr($this->input->post('tanggal',TRUE),5,2),
		'tahun' => substr($this->input->post('tanggal',TRUE),0,4),
		'pengeluaran' => $this->input->post('pengeluaran',TRUE),
		'pemasukan' => $this->input->post('pemasukan',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->T_det_kas_model->update($this->input->post('id_kas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_det_kas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_det_kas_model->get_by_id($id);

        if ($row) {
            $this->T_det_kas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_det_kas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_det_kas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_kegiatan', 'id kegiatan', 'trim|required');
	$this->form_validation->set_rules('pengeluaran', 'pengeluaran', 'trim|numeric');
	$this->form_validation->set_rules('pemasukan', 'pemasukan', 'trim|numeric');
	$this->form_validation->set_rules('saldo', 'saldo', 'trim|numeric');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('aktif', 'aktif', 'trim|required');

	$this->form_validation->set_rules('id_kas', 'id_kas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t_det_kas.xls";
        $judul = "t_det_kas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Pengeluaran");
	xlsWriteLabel($tablehead, $kolomhead++, "Pemasukan");
	xlsWriteLabel($tablehead, $kolomhead++, "Saldo");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Aktif");
	xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated By");
	xlsWriteLabel($tablehead, $kolomhead++, "Revised");

	foreach ($this->T_det_kas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kegiatan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->pengeluaran);
	    xlsWriteNumber($tablebody, $kolombody++, $data->pemasukan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->saldo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->aktif);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_by);
	    xlsWriteNumber($tablebody, $kolombody++, $data->revised);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t_det_kas.doc");

        $data = array(
            't_det_kas_data' => $this->T_det_kas_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('t_det_kas_doc',$data);
    }

    function pdf()
    {
        $data = array(
            't_det_kas_data' => $this->T_det_kas_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('t_det_kas_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('t_det_kas.pdf', 'D'); 
    }

}

/* End of file T_det_kas.php */
/* Location: ./application/controllers/T_det_kas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-04-05 20:56:11 */
/* http://harviacode.com */