<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_det_kas_model extends CI_Model
{

    public $table = 't_det_kas';
    public $id = 'id_kas';
    public $order = 'DESC';
	
	public $main_sql = "SELECT
			id_kas,
			no_kwitansi,
			t_det_kas.id_kegiatan,
			m_kegiatan.nama_kegiatan,
			bulan,
			tahun,
			saldo_awal,
			pemasukan,
			pengeluaran,
			saldo_akhir,
			DATE_FORMAT(tanggal,'%Y-%m-%d')as tanggal,
			t_det_kas.keterangan,
			t_det_kas.aktif,
			created_by
			
		FROM
			t_det_kas
		INNER JOIN m_kegiatan ON t_det_kas.id_kegiatan = m_kegiatan.id_kegiatan
		where id_kas is not null
		";
	
    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
		$sql = $this->main_sql;
		$sql .= " ORDER BY
				id_kas ASC" ;
		$result = $this->db->query($sql);
		return $result->result();
        /* $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result(); */
    }

    // get data by id
    function get_by_id($id)
    {
		$sql = $this->main_sql;
		$sql .= " AND id_kas = '".$id."'";
		$result = $this->db->query($sql);
		return $result->row();
       /*  $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row(); */
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_kas', $q);
	$this->db->or_like('id_kegiatan', $q);
	$this->db->or_like('pengeluaran', $q);
	$this->db->or_like('pemasukan', $q);
	$this->db->or_like('saldo', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('aktif', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('updated_date', $q);
	$this->db->or_like('updated_by', $q);
	$this->db->or_like('revised', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_kas', $q);
	$this->db->or_like('id_kegiatan', $q);
	$this->db->or_like('pengeluaran', $q);
	$this->db->or_like('pemasukan', $q);
	$this->db->or_like('saldo', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('aktif', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('updated_date', $q);
	$this->db->or_like('updated_by', $q);
	$this->db->or_like('revised', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($form)
    {
		extract($form);
		$sql = "select saldo_awal,saldo_akhir from t_det_kas where 
				bulan = EXTRACT(MONTH FROM '".$tanggal."') and 
				tahun = EXTRACT(YEAR FROM '".$tanggal."') 
				ORDER BY id_kas desc limit 1";
		$rs = $this->db->query($sql);
		$row = $rs->row();
		$modal = $row->saldo_akhir;
		$nbrows = $rs->num_rows();
		$data = array(
			"no_kwitansi"=>$no_kwitansi,
			"id_kegiatan"=>$id_kegiatan,
			"bulan"=>$bulan,
			"tahun"=>$tahun,
			"pengeluaran"=>$pengeluaran,
			"pemasukan"=>$pemasukan,
			"keterangan"=>$keterangan,
			"tanggal"=>$tanggal,
			"aktif"=>$aktif
			);
		if($nbrows>0){
			$data['saldo_awal'] = $modal;
				$hasil = $modal + (helpNumeric($pemasukan) - helpNumeric($pengeluaran));
				$data["saldo_akhir"] = $hasil;
		}else{
			$sql2 = "SELECT
						saldo_awal,
						saldo_akhir
					FROM
						t_det_kas
					ORDER BY
						id_kas DESC
					LIMIT 1";
			$rs2 = $this->db->query($sql2);
			$row2 = $rs2->row();
			$modal2 = $row2->saldo_akhir;
			$nbrows2 = $rs2->num_rows();
			if($nbrows2>0){
				$data['saldo_awal'] = $modal2;
				$hasil2 = $modal2 + (helpNumeric($pemasukan) - helpNumeric($pengeluaran));
				$data["saldo_akhir"] = $hasil2;
			}else{
			$data['saldo_awal'] = 0;
			$hasil = 0 + (helpNumeric($pemasukan) - helpNumeric($pengeluaran));
			$data["saldo_akhir"] = $hasil;	
			}
		}
		$data['created_date']= date("Y-m-d H:i:s");
		$data['created_by']= $this->session->userdata('username');
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $form)
    {
      
		
		extract($form);
		$sql = "select saldo_awal,saldo_akhir from t_det_kas where 
				bulan = EXTRACT(MONTH FROM '".$tanggal."') and 
				tahun = EXTRACT(YEAR FROM '".$tanggal."') 
				ORDER BY id_kas desc limit 1";
		$rs = $this->db->query($sql);
		$row = $rs->row();
		$modal = $row->saldo_akhir;
		$nbrows = $rs->num_rows();
		$data = array(
			"id_kegiatan"=>$id_kegiatan,
			"bulan"=>$bulan,
			"tahun"=>$tahun,
			"pengeluaran"=>$pengeluaran,
			"pemasukan"=>$pemasukan,
			"keterangan"=>$keterangan,
			"tanggal"=>$tanggal,
			"aktif"=>$aktif
			);
		if($nbrows>0){
			$data['saldo_awal'] = $modal;
				$hasil = $modal + (helpNumeric($pemasukan) - helpNumeric($pengeluaran));
				$data["saldo_akhir"] = $hasil;
		}else{
			$sql2 = "SELECT
						saldo_awal,
						saldo_akhir
					FROM
						t_det_kas
					ORDER BY
						id_kas DESC
					LIMIT 1";
			$rs2 = $this->db->query($sql2);
			$row2 = $rs2->row();
			$modal2 = $row2->saldo_akhir;
			$nbrows2 = $rs2->num_rows();
			if($nbrows2>0){
				$data['saldo_awal'] = $modal2;
				$hasil2 = $modal2 + (helpNumeric($pemasukan) - helpNumeric($pengeluaran));
				$data["saldo_akhir"] = $hasil2;
			}else{
			$data['saldo_awal'] = 0;
			$hasil = 0 + (helpNumeric($pemasukan) - helpNumeric($pengeluaran));
			$data["saldo_akhir"] = $hasil;	
			}
		}
		$data['updated_date']= date("Y-m-d H:i:s");
		$data['updated_by']= $this->session->userdata('username');
		
		$this->db->set('revised', '(revised+1)', FALSE);
		$this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    
    }

    // delete data
    function delete($id)
    {		
		$this->db->set('aktif', 't')
				->where_in($this->id, $id)
				->update($this->table);
    }
	function getNomorKwitansi($formValues){
		extract($formValues);
		$year = $tahun;
		$month = $bulan;
		$sqlSelectNomor = "SELECT no_kwitansi FROM t_det_kas
		WHERE tahun = '".$year."' and
		bulan = '".$month."'
		ORDER BY id_kas DESC LIMIT 1";
		$querySelectNomor = $this->db->query($sqlSelectNomor);
		if($querySelectNomor->num_rows()){
			$lastNomorMati = $querySelectNomor->row()->no_kwitansi;
			$expLastNomorMati = explode('/',$lastNomorMati);
			$lastNomorMati = $expLastNomorMati[0];
			$nomorUrutMati = $lastNomorMati + 1;
		}else{
			$nomorUrutMati = 1;
		}
		/* format nomor = "nomorUrut/SM/bulanRomawi/tahun" */
		$nomorMati = "00".$nomorUrutMati."/".$month."/".$year;
		return $nomorMati;
	}

}

/* End of file T_det_kas_model.php */
/* Location: ./application/models/T_det_kas_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-04-05 20:56:11 */
/* http://harviacode.com */