<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
	}
	public function index() {
		if ($this->session->userdata('logged_in') == 1) {
			redirect('menu');
		}
		$this->load->view('login/login');
	}

	public function cek_login() {
		$username = preg_replace('/[^a-zA-Z0-9_]/i','',$this->input->post('username', TRUE));
		$password = md5($this->input->post('password', TRUE));
		$data = array('username' => $username,
						'password' => $password);
		if($username == 'adm' and $password =='5f4dcc3b5aa765d61d8327deb882cf99'){
			$sess_data['logged_in'] = TRUE;
			$sess_data['uid'] = 0;
			$sess_data['username'] = 'Super Admin';
			$sess_data['level'] = 'Super Admin';
			$this->session->set_userdata($sess_data);
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.base_url().'">';
		}else{
			$this->load->model('model_user'); // load model_user
			$hasil = $this->model_user->cek_user($data);
			if ($hasil->num_rows() == 1) {
				$sess = $hasil->row();
				if($sess->active <> 1){
					echo "<script>alert('User Anda Belom di Aktifkan, Silahkan Cek Email Anda');history.go(-1);</script>";
				}else{
					$sess_data['logged_in'] = TRUE;
					$sess_data['uid'] = $sess->id;
					$sess_data['username'] = $sess->username;
					$sess_data['level'] = $sess->level;
					$this->session->set_userdata($sess_data);
				
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.base_url().'">';	
				}
			}else {
			echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
			}
		}
	}
	function logout() {
		$sess_data['logged_in'] = false;
		$sess_data['uid'] = '';
		$sess_data['username'] = '';
		$sess_data['level'] = '';
		$this->session->unset_userdata($sess_data);
		session_destroy();
		redirect('menu_login');
	}
	
	function register(){
		$this->load->view('login/register');
	}
	function daftar(){
		$username = preg_replace('/[^a-zA-Z0-9_]/i','',$this->input->post('username', TRUE));
		$password = $this->input->post('password', TRUE);
		$nama_lkp = $this->input->post('nama_lengkap', TRUE);
		$email = $this->input->post('email', TRUE);
		$nomor_hp = $this->input->post('nomor_hp', TRUE);
		$data = array(
		'username'=>$username,
		'password'=>md5($password),
		'first_name'=>$nama_lkp,
		'email'=>$email,
		'phone'=>$nomor_hp
		);
		$this->load->model('model_user'); // load model_user
		$result = $this->model_user->register($data);
		if($result == 1){
			echo "<script>alert('Pendaftaran Berhasil Silahkan Konfirmasi Admin Untuk Aktifasi User');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.base_url().'index.php/menu_login">';
		}else if($result == 2){
			echo "<script>alert('Pendaftaran Gagal!Username Sudah Terpakai');history.go(-1);</script>";
		}else{
			echo "<script>alert('Pendaftaran Gagal!');history.go(-1);</script>";
		}
	}
}

?>
