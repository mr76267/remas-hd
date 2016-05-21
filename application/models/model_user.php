<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_user extends CI_Model {

		public function cek_user($formValues) {
			extract($formValues);
			$sql = "SELECT 
					users.id,
					username,
					password,
					first_name,
					email,
					active,
					groups.name as level
				from users
				inner JOIN users_groups on (users.id = user_id)
				inner JOIN groups on (groups.id = group_id)
				Where username = '".$username."' and password = '".$password."'";
			$query = $this->db->query($sql);
			return $query;
		}
		function register($formValues){
			extract($formValues);
			$sql = "Select * from users where username = '".$username."'";
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return '2';
			}else{
				$data = array(
			"username"=>$username,
			"password"=>$password,
			"first_name"=>$first_name,
			'email'=>$email,
			'phone'=>$phone,
			'created_on'=>date("Y-m-d H:i:s"),
			'active'=>1
			);
			$this->db->insert('users',$data);
			if($this->db->affected_rows()){
				$id = $this->db->select_max('id')
                            ->get('users')->row()->id;
				$this->user_groups($id);
				return '1';
			}else{
				return '0';
			}
			}
			
		}
		
		function user_groups($master_id){
			$sql = "Select * from groups where name = 'members'";
			$query = $this->db->query($sql);
			$row = $query->row();
			
			$data = array (
			'user_id'=>$master_id,
			'group_id'=>$row->id
			);
			$this->db->insert('users_groups',$data);
		}

	}

?>
