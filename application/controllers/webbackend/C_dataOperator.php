<?php
class C_dataOperator extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('form_validation','table'));
		$this->load->model('mod_dataOperator');
	}

	public function login(){
		$this->load->view('webbackend/V_loginAdmin');
	}

	public function homeAdmin(){
		$this->load->view('webbackend/V_homeAdmin');
	}

	public  function lihatDataOperator(){

		$idOperator = $this->session->userdata('idOperator');
		$data['operator'] = $this->mod_dataOperator->updateDataOperator($idOperator)->result();
		$this->load->view('webbackend/V_lihatDataOperator',$data);
	}

	public function inputDataOperator(){
		$this->load->view('webbackend/V_inputDataOperator');
	}

	public function prosesInputDataOperator(){

		$this->form_validation->set_rules('namaLengkap','nama lengkap','trim|required|min_length[4]');
		$this->form_validation->set_rules('username','username','trim|required|min_length[4]|alpha_dash');
	    $this->form_validation->set_rules('password','password','trim|required|min_length[4]|alpha_dash');
	    $this->form_validation->set_rules('tanggalLahir','tanggal lahir','required');
	    $this->form_validation->set_rules('noTelepon','no telepon','required|min_length[10]|numeric');
	    $this->form_validation->set_rules('email','email','required|min_length[3]|valid_email');
	    $this->form_validation->set_rules('jenisKelamin','jenis kelamin','required');

	    if(isset($_POST['submit'])){
		    if($this->form_validation->run() == false){
		        $this->load->view('webbackend/V_inputDataOperator');
		    }
		    else{

		        $data 	= $this->mod_dataOperator->lihatDataOperator()->result_array();
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$no =0;
				foreach ($data as $key) {
					if($username == $key['username'] && $password == $key['password']){
						$no=1;
						
						$this->session->set_flashdata('pesan2', 
				                '<div class="alert alert-danger">    
				                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                <h7>GAGAL BUAT AKUN! </h7>
				                    <p>Data Username dan Password Sudah Terpakai<br/>
				                    Terima kasih.</p>
				                </div>');
						redirect('webbackend/C_dataOperator/inputDataOperator');
						
					}
				}
				if ($no==0) {

					$config['upload_path']='./gambar_proyek/';
			        $config['allowed_types']='jpg|png|jpeg|gif';
			        $config['max_size'] = 500000;
			        $this->load->library('upload',$config);
			        $this->upload->do_upload();
			        $data   =  $this->upload->data();

					$this->session->set_flashdata('pesan1', 
				                '<div class="alert alert-info ">    
				                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                <h7>BERHASIL ! </h7>
				                    <p>Berhasil membuat data operator baru</p>
				                </div>');
					$this->mod_dataOperator->inputDataOperator($data['file_name'],$username,$password);
					redirect('webbackend/C_dataOperator/lihatDataOperator');
				}

			}
		}
	}

	public function updateDataOperator($idOperator){
		$data["operator"] = $this->mod_dataOperator->updateDataOperator($idOperator)->result();
		$this->load->view('webbackend/V_updateDataOperator', $data);
	}

	public function prosesUpdateDataOperator(){

		$this->form_validation->set_rules('namaLengkap','nama lengkap','trim|required|min_length[4]');
		$this->form_validation->set_rules('username','username','trim|required|min_length[4]|alpha_dash');
	    $this->form_validation->set_rules('password','password','trim|required|min_length[4]|alpha_dash');
	    $this->form_validation->set_rules('tanggalLahir','tanggal lahir','required');
	    $this->form_validation->set_rules('noTelepon','no telepon','required|min_length[10]|numeric');
	    $this->form_validation->set_rules('email','email','required|min_length[3]|valid_email');
	    $this->form_validation->set_rules('jenisKelamin','jenis kelamin','required');

	    if(isset($_POST['submit'])){
		    if($this->form_validation->run() == false){
		    	$idOperator = $this->input->post("idOperator");
		        $data["operator"] = $this->mod_dataOperator->updateDataOperator($idOperator)->result();
				$this->load->view('webbackend/V_updateDataOperator', $data);
		    }
		    else{

				$config['upload_path']='./gambar_proyek/';
	            $config['allowed_types']='jpg|png|jpeg|gif';
	            $config['max_size'] = 500000;
	            $this->load->library('upload',$config);
	            $this->upload->do_upload();
	            $data   =  $this->upload->data();

				$this->session->set_flashdata('pesan3', 
			                '<div class="alert alert-info ">    
			                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			                <h7>BERHASIL ! </h7>
			                    <p>Berhasil mengubah data operator</p>
			                </div>');
				$this->mod_dataOperator->prosesUpdateDataOperator($data['file_name']);
				redirect('webbackend/C_dataOperator/lihatDataOperator');
					
			}
		}
	}

	public function deleteDataOperator($idOperator){
		$this->session->set_flashdata('pesan5', 
		                '<div class="alert alert-info ">    
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                <h7>BERHASIL ! </h7>
		                    <p>Berhasil menghapus data operator<br/></p>
		                </div>');
		$this->mod_dataOperator->deleteDataOperator($idOperator);
		redirect('webbackend/C_dataOperator/lihatDataOperator');
	}

	public function prosesLoginAdmin(){
		$data 	= $this->mod_dataOperator->lihatDataOperator()->result_array();
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$no =0;

		foreach ($data as $key) {
			if($username == $key['username'] && $password == $key['password']){
				$no=1;
				$this->session->set_userdata('namaLengkap',$key['namaLengkap']);
				$this->session->set_userdata('idOperator',$key['idOperator']);
				$this->session->set_userdata('email',$key['email']);
				$this->session->set_userdata('foto',$key['foto']);
				$this->session->set_flashdata('pesan6', 
	 	                '<div class="alert alert-info ">    
	                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                <h7>BERHASIL ! </h7>
	                    <p>Berhasil login sebagai Admin<br/></p>
	                </div>');
				redirect('webbackend/C_dataOperator/homeAdmin');
			}
		}

		if ($no==0) {
			$this->session->set_flashdata('pesan7', 
		                '<div class="alert alert-danger">    
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                <h7>GAGAL LOGIN ! </h7>
		                    <p>Harap memasukan data valid<br/>
		                    Terima kasih.</p>
		                </div>');
			redirect('webbackend/C_dataOperator/login');
		}
	}

	public function detailDataOperator($idOperator){
		$data["row"] = $this->mod_dataOperator->detailDataOperator($idOperator)->result();
		$this->load->view('webbackend/V_detailDataOperator', $data);
	}

	public function logout(){
		$this->session->unset_userdata('namaLengkap');
		$this->session->unset_userdata('idOperator');
		// $this->session->unset_userdata('namaLengkap');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('foto');
		
		redirect('webbackend/C_dataOperator/login');
	}

	//----------------------------------------------------------
	// web page

	public function lihatDataCuaca(){
		$this->load->view('webbackend/V_lihatDataCuaca');
	}

	public function prosesCekCuaca(){

		$namaDaerah = $this->input->post('namaDaerah');

		$api_cuaca = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$namaDaerah."&appid=677e77487b1ef3c45bc059b979a6f866");
		$array_cuaca = json_decode($api_cuaca, true);
		$data["cuaca"] = $array_cuaca;

		foreach ($array_cuaca['weather'] as $key) {

			$dataCuaca = array(
								'lat'			=> $array_cuaca['coord']['lat'],
								'lon'			=> $array_cuaca['coord']['lon'],
								'timezone'		=> $array_cuaca['timezone'],
								'pressure'		=> $array_cuaca['main']['pressure'],
								'humidity'		=> $array_cuaca['main']['humidity'],
								'wind_speed'	=> $array_cuaca['wind']['speed'],
								'weather_id'	=> $key['id'],
								'weather_main'	=> $key['main'],
								'weather_description'	=> $key['description']);
			
			$this->mod_dataOperator->inputDataCuaca($dataCuaca);
		}

		$this->load->view('webbackend/V_detailApiCuaca', $data);

	}

	public function exportJson(){
		$datacuaca 	= $this->mod_dataOperator->lihatDataCuaca()->result_array();
		$idOperator = $this->session->userdata('idOperator');
		$datauser 	= $this->mod_dataOperator->updateDataOperator($idOperator)->result_array();

		$response = array(
			'status' => 1,
			'message' => 'Get List Cuaca',
			'num' => count($datacuaca),
			'user' => $datauser,
			'data' => $datacuaca

		);

		header('Content-Type: application/json');
		echo json_encode($response);

	}

	public function register(){
		$this->load->view('webbackend/V_registerAdmin');
	}

	public function prosesRegisterAdmin(){

		$this->form_validation->set_rules('namaLengkap','nama lengkap','trim|required|min_length[4]');
		$this->form_validation->set_rules('username','username','trim|required|min_length[4]|alpha_dash');
	    $this->form_validation->set_rules('password','password','trim|required|min_length[4]|alpha_dash');
	    $this->form_validation->set_rules('noTelepon','no telepon','required|min_length[10]|numeric');
	  
	    if($this->form_validation->run() == false){
	        $this->load->view('webbackend/V_registerAdmin');
	    }
	    else{

	        $data 	= $this->mod_dataOperator->lihatDataOperator()->result_array();
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$no =0;

			foreach ($data as $key) {
				if($username == $key['username'] && $password == $key['password']){
					$no=1;
					
					$this->session->set_flashdata('pesan2', 
			                '<div class="alert alert-danger">    
			                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			                <h7>gagal register akun user! </h7>
			                    <p>Data Username dan Password Sudah Terpakai</p>
			                </div>');
					redirect('webbackend/C_dataOperator/register');
					
				}
			}

			if ($no==0) {

				$this->session->set_flashdata('pesan1', 
			                '<div class="alert alert-info ">    
			                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			                <h7>Sukses ! </h7>
			                    <p>Berhasil membuat data user baru</p>
			                </div>');
				$this->mod_dataOperator->registerUser();
				redirect('webbackend/C_dataOperator/homeAdmin');
			}

		}
		
	}

}
?>