<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index() {
		$this->layout();
	}

	public function layout($focus='') {
		if ($this->session->userdata('logged'))
			$this->register_success();
		else {
			$data = array('access'=>'disabled', 'display'=>'', 'value'=>'Se connecter', 'action'=>'#log');
			$this->load->view('head');
			$this->load->view('header', $data);
			$this->load->view('content');
			$data['focus'] = $focus;
			$this->load->view('register_form', $data);
			$this->load->view('login_form');
			$this->load->view('key_form');
			$this->load->view('footer');
		}
	}

	public function register() {
		$this->form_validation->set_rules('nom', 'user_fst_name', 'required');
		$this->form_validation->set_rules('prenom', 'user_lst_name', 'required');
		$this->form_validation->set_rules('login', 'user_login', 'required');
		$this->form_validation->set_rules('mail', 'user_email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'user_pwd', 'required');
		$this->form_validation->set_rules('passconf', 'user_pwd_conf', 'required|matches[password]');
		if ($this->form_validation->run() == FALSE)
			$this->layout('autofocus');
		else {
			$login = $this->input->post('login');
			$new_user = array('login'=>$login, 'mail'=>$this->input->post('mail'), 'nom'=>$this->input->post('nom'), 'prenom'=>$this->input->post('prenom'), 'password'=>$this->input->post('password'));
			$this->load->model('User');
			if ($this->User->register($new_user)) {
				$this->set_session($login);
				$this->register_success();
			}
			else {
				$this->form_validation->set_rules('nom', 'user_fst_name', 'min_length[31]');
				$this->form_validation->set_message('min_length', 'Login ou mail déjà pris !');
				if ($this->form_validation->run() == FALSE)
					$this->layout('autofocus');
			}
		}
	}

	public function register_success() {
		$data = array('access'=>'', 'display'=>'hidden', 'value'=>'Se déconnecter', 'action'=>'Welcome/unset_session');
		$this->load->view('head');
		$this->load->view('header', $data);
		$this->load->view('user');
		$this->load->view('footer');
	}

	public function login() {
		$this->form_validation->set_rules('login', 'user_login', 'required');
		$this->form_validation->set_rules('password', 'user_pwd', 'required');
		if ($this->form_validation->run() == FALSE)
			$this->layout();
		else {
			$login = $this->input->post('login');
			$pwd = $this->input->post('password');
			$new_user = array('login'=>$login, 'password'=>$pwd);
			$this->load->model('User');
			if ($this->User->exists($new_user)) {
				$this->set_session($login);
				$this->register_success();
			}
			else 
				$this->layout('autofocus');
		}
	}

	public function set_session($login) {
		$this->load->library('session');
		$this->session->set_userdata('login', $login);
		$this->session->set_userdata('logged', TRUE);
	}

	public function unset_session() {
		$this->load->library('session');
		$this->session->sess_destroy();
		$this->session->set_userdata('logged', FALSE);
		redirect('welcome', 'location');
	}

	public function update($id) {
		if ($id == 1) {
			$this->form_validation->set_rules('new_pwd', 'user_pwd', 'required');
			$this->form_validation->set_rules('new_conf', 'user_pwd_conf', 'required|matches[new_pwd]');
			if ($this->form_validation->run()) {
				$data = array('login'=>$this->session->userdata('login'), 'pwd'=>$this->input->post('new_pwd'));
				$this->load->model('User');
				$this->User->edit($data, 1);
			}
			$this->load('param');
		}
		else if ($id == 2) {
			$this->form_validation->set_rules('new_login', 'user_login', 'required|min_length[2]');
			if ($this->form_validation->run() == FALSE)
				$this->load('param');
			else {
				$data = array('old'=>$this->session->userdata('login'), 'new'=>$this->input->post('new_login'));
				$this->load->model('User');
				if ($this->User->edit($data, 2))
					$this->set_session($data['new']);
				$this->load('param');
			}
		}
		else {
			$this->form_validation->set_rules('conf', 'confirmation', 'required');
			if ($this->form_validation->run() == FALSE)
				$this->load('param');
			else {
				$this->load->model('User');
				$this->User->edit($this->session->userdata('login'), 3);
				$this->unset_session();
			}
		}
	}

	public function load($view, $array=NULL) {
		$data = array('access'=>'', 'display'=>'hidden', 'value'=>'Se déconnecter', 'action'=>'Welcome/unset_session');
		if ($view === 'contact_form' && !$this->session->userdata('logged'))
			$data = array('access'=>'disabled', 'display'=>'', 'value'=>'Se connecter', 'action'=>'#log');
		$this->load->view('head');
		$this->load->view('header', $data);
		$this->load->view($view, $array);
		$this->load->view('footer');
	}
	
	public function sondage_success($clef){
		$data = array('access'=>'', 'display'=>'hidden', 'value'=>'Se déconnecter', 'action'=>'Welcome/unset_session');
		$k = array('key' => $clef );
		$this->load->view('head');
		$this->load->view('header', $data);
		$this->load->view('key_show', $k);
		$this->load->view('footer');
	}

	public function sondage() {
		$count = (count($_POST) - 3) / 2;
		for ($i = 1 ; $i <= $count ; $i++) { 
			$this->form_validation->set_rules('date'.$i, 'sondage_date', 'trim');
			$this->form_validation->set_rules('time'.$i, 'sondage_time', 'trim');
		}
		$this->form_validation->set_rules('titre', 'sondage_titre', 'required');
		$this->form_validation->set_rules('lieu', 'sondage_lieu');
		$this->form_validation->set_rules('date', 'sondage_date', 'callback_date_check|required|trim');
		$this->form_validation->set_rules('time', 'sondage_time', 'callback_time_check|required|trim');
		$this->form_validation->set_rules('description', 'sondage_description');
		$this->form_validation->set_message('date_check', 'Date invalide (format attendu [YYYY-mm-dd])');
		$this->form_validation->set_message('time_check', 'Heure invalide (format attenu [HH-mm])');
		if ($this->form_validation->run() == FALSE)
			$this->register_success();
		else {
			$this->load->model('Horaire');
			$this->load->model('Sondage');
			$k = $this->Sondage->key_gen();
			$data = array('clef'=>$k, 'login'=>$this->session->userdata('login'), 'titre'=>$this->input->post('titre'), 'lieu'=>$this->input->post('lieu'), 'description'=>$this->input->post('description'));			
			if ($this->Sondage->create($data)) {
            	for ($i = 0 ; $i < $count ; $i++) { 
            		if ($i === 0)
            			$datime = array('clef'=>$k, 'Jour'=>$this->input->post('date'), 'Heure'=>$this->input->post('time') );
            		else
            			$datime = array('clef'=>$k, 'Jour'=>$this->input->post('date'.$i), 'Heure'=>$this->input->post('time'.$i) );
            		$this->Horaire->create($datime);
            	}
            	$this->sondage_success($k);
            }
            else
            	$this->register_success();
        }
    }
   
    public function date_check($str) {
    	$regex = DateTime::createFromFormat('Y-m-d', $str);
    	return $regex !== false && !array_sum($regex->getLastErrors());
    }

    public function time_check($str) {
    	$regex = DateTime::createFromFormat('G:i', $str);
   	 	return $regex && $regex->format('G:i') === $str;
    }

    public function participation() {
    	$this->form_validation->set_rules('id', 'clef', 'required|trim');
    	if ($this->form_validation->run() == FALSE)
			echo '<p>2</p>'; //ce sondage existe pas 404
		else {
			$k = $this->input->post('id');
			$this->load->model('Sondage');
			if ($this->Sondage->exists($k)) {
				$tmp = $this->Sondage->get($k);
				$data = array('titre'=>$tmp[0]->Titre, 'lieu'=>$tmp[0]->Lieu, 'dscrp'=>$tmp[0]->Description);
				unset($tmp);
				$this->load->model('Horaire');
				$tmp = $this->Horaire->get($k);
				$data['horaire'] = $tmp;
				$this->load('sondage_form', $data);
			}
			else {
				echo '<p>2</p>'; //ce sondage existe pas 404
			}
		}
    }
}
?>
<!-- 
- un connecté doit pouvoir répondre à un sondage 
- pas de date avant ajd
-->