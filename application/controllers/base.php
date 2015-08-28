<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
	
	function index() {
	    
	    /* jika sudah login */
	    if($this->session->userdata('logged_in')) {
	        //go to default page
			redirect($this->config->item('default_page'));
	    }
	    
		$data = array();
		$data['login_url'] = BASE_URL."base/login";
		$this->load->view('base/login', $data);
	}
	
	function login() {
		if($this->session->userdata('logged_in')) {
		    //go to default page
			redirect($this->config->item('default_page'));
		}

		$username = $this->input->post('uname');
		$password  = $this->input->post('password');
        
        $data = array();
		if(empty($username) or empty($password)) {
		    $data['errormsg'] = 'Please Enter Your Username and Password';
			$this->load->view('base/login', $data);
			return;
		}
		
		$items = file_get_contents(PAYMENT_WS_URL.'ws.php?type=json&module=paymentccbs&class=p_user_loket&method=valid_login&user_name='.$username.'&password='.$password);
        $items = json_decode($items, true);
            
        $p_user_loket_id = $items['rows'];
        
        if( $p_user_loket_id < 0 and $p_user_loket_id == -11 ) {
            $data['errormsg'] = "Your password has been expired. Please contact Your administrators.";
			$this->load->view('base/login', $data);	
			return;
       
        }else if( $p_user_loket_id < 0 or empty($p_user_loket_id) ) {
            $data['errormsg'] = "Your Username or Password is Incorrect, Please check again.";
			$this->load->view('base/login', $data);	
			return;
        }else {
            		    
            $items = file_get_contents(PAYMENT_WS_URL.'ws.php?type=json&module=paymentccbs&class=p_user_loket&method=get_user_loket&p_user_loket_id='.$p_user_loket_id);
            $items = json_decode($items, true);
		    
		    $row = $items['rows'];
		   		    
            $userdata = array('p_user_loket_id'	=> $p_user_loket_id,
                          'p_bank_branch_id'    => $row['p_bank_branch_id'],
						  'user_name' 	        => $row['user_name'],
						  'full_name'           => $row['full_name'],
						  'logged_in'	        => true
						  );
						  
			$this->session->set_userdata($userdata);
            
			//go to default page
			redirect($this->config->item('default_page'));
        }
        
	}
	
	function logout() {
		
		$userdata = array('p_user_loket_id'	=> '',
                          'p_bank_branch_id'    => '',
						  'user_name' 	        => '',
						  'full_name'           => '',
						  'logged_in'	        => ''
						  );

		$this->session->unset_userdata($userdata);
		$this->session->sess_destroy();
		redirect('base/index');
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/base.php */