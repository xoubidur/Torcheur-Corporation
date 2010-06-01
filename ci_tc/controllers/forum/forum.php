<?php

class Forum extends Controller {
	
	function index() {
		$this->forums();
	}
	
	function listeTI() {
		$this->load->model('forum/thread_item_model');
		$liste['lesTI'] = $this->thread_item_model->getTIs();
		$data['maliste'] = $liste;
		//$this->load->view('films/liste',$liste);		
		$data['lesForums'] = $this->lesForums();
		$data['main_navigation'] = 'navigation';
		$data['main_menu'] = 'forum/listeForums';
		$data['main_content'] = 'forum/listeTI';
		$this->load->view('includes/template', $data);
	}	
	
	function listeT() {
		$this->load->model('forum/thread_model');
		$liste['lesT'] = $this->thread_model->getTs();
		$data['maliste'] = $liste;
		$data['lesForums'] = $this->lesForums();
		$data['main_navigation'] = 'navigation';
		$data['main_menu'] = 'forum/listeForums';
		$data['main_content'] = 'forum/listeT';
		$this->load->view('includes/template', $data);
	}
	
	function listeTIbyT($id) {
		$this->load->model('forum/thread_item_model');
		
		$liste['lesTIbyT'] = $this->thread_item_model->getTIbyT($id);
		$data['maliste'] = $liste;
		$data['lesForums'] = $this->lesForums();
		$data['main_navigation'] = 'navigation';
		$data['main_menu'] = 'forum/listeForums';
		$data['main_content'] = 'forum/listeTIbyT';
		$this->load->view('includes/template', $data);
	}
	
	function listeTIChrono() {
		$this->load->model('forum/thread_item_model');
		$liste['lesTIChrono'] = $this->thread_item_model->getTIChrono();
		$data['maliste'] = $liste;
		$data['lesForums'] = $this->lesForums();
		$data['main_navigation'] = 'navigation';
		$data['main_menu'] = 'forum/listeForums';
		$data['main_content'] = 'forum/listeTIChrono';
		$this->load->view('includes/template', $data);
	}
	
	
	function forums() {
		$this->auth->check();
		$this->load->model('forum/forum_model');
		$data['lesForums'] = $this->forum_model->getForums();
		
		/*
		foreach  ($data['lesForums'] as $leF) :
			$data['lesForums']['$leF->id']= $this->unread3($leF->id);
			//$data['unread'] = $unread; 
		endforeach;
		*/
		
		/*$data['lesForums'] = $this->lesForums();*/
		$data['main_menu'] = 'forum/listeForums';
		$data['right_menu'] = 'navigation/right';
		$data['main_header'] = 'includes/main_header';
		$data['main_content'] = 'vide';//forum/listeForums';
		$this->load->view('includes/template', $data);
	}

	function lesForums() {
		$this->load->model('forum/forum_model');
		$data = $this->forum_model->getForums();
		return $data;
		/* 
		$data['main_navigation'] = 'navigation';
		$data['main_menu'] = 'forum/listeForums';
		$data['main_content'] = 'forum/listeForums';
		$this->load->view('includes/template', $data);
		*/
	}
	
	// Exemple de pagination
	function display($row=0){
		// load pagination library
		$this->load->library('pagination');
		// set pagination parameters
		$config['base_url']='<?php echo base_url(); ?>index.php/forum/forum/forumSubject/';
		$config['total_rows']=$this->Users->getNumUsers();
		$config['per_page']='5';
		$this->pagination->initialize($config);
		// store data for being displayed on view file
		$data['users']=$this->Users->getUsers($row);
		$data['title']='Displaying user data';
		$data['header']='User List';
		$data['links']=$this->pagination->create_links();
		// load 'testview' view
		$this->load->view('users_view',$data);
	}
	
function forumSubject($idForum) {
		$this->load->model('forum/thread_model');
		
		$this->load->library('pagination');
		$this->load->library('table');
		
		$config['base_url']='http://localhost/benoit.lemaitre.free.fr/ci_tc/index.php/forum/forum/forumSubject/'.$idForum.'/';
		$config['total_rows']=$this->thread_model->getNbThreads($idForum);
		$config['per_page']=15;
		$config['num_links']=10;
		$config['uri_segment'] = 5; 
		$config['full_tag_open']='<div id="pagination">';
		$config['full_tag_close']='</div>';
		$this->table->set_heading('fId', 'fName', 'tId', 'tName', 'Decription', 'NbMess', 'Non Lu', 'dateFirst', 'idFirst', 'nameFirst', 'tForiId', 'dateLast', 'idLast', 'nameLast');
		
		$this->pagination->initialize($config);
		
		//$data['lesThreads'] = $this->thread_model->getThreadsSubject($idForum);
		$data['lesThreads'] = $this->thread_model->getThreadsSubject($idForum, $config['per_page'], $this->uri->segment(5));
		//$data['lesThreads'] = $this->thread_model->getNbMsgbyT($idForum);
		$data['lesForums'] = $this->lesForums();
		/*
		$data['main_menu'] = 'forum/listeForums';
		$data['right_menu'] = 'navigation/right';
		$data['main_header'] = 'vide';
		$data['main_content'] = 'vide';//forum/listeForums';
		*/

		$data['main_menu'] = 'forum/listeForums';
		$data['right_menu'] = 'navigation/right';
		$data['main_header'] = 'includes/main_header';
		$data['main_content'] = 'forum/listeThreadsSub';
		$this->load->view('includes/template', $data);
	}
	
	function forumQuick($idForum) {
		$this->load->model('forum/thread_model');
		
		$this->load->library('pagination');
		$this->load->library('table');
		
		$config['base_url']='http://localhost/benoit.lemaitre.free.fr/ci_tc/index.php/forum/forum/forumQuick/'.$idForum.'/';
		$config['total_rows']=$this->thread_model->getNbThreadItems($idForum);
		$config['per_page']=15;
		$config['num_links']=2;
		$config['uri_segment'] = 5; 
		$config['full_tag_open']='<div id="pagination">';
		$config['full_tag_close']='</div>';
		//$this->table->set_heading('fId', 'fName', 'tId', 'tName', 'Decription', 'NbMess', 'Non Lu', 'dateFirst', 'idFirst', 'nameFirst', 'tForiId', 'dateLast', 'idLast', 'nameLast');
		
		$this->pagination->initialize($config);
		
		$data['lesThreads'] = $this->thread_model->getThreadsQuick($idForum, $config['per_page'], $this->uri->segment(5));
		$data['lesForums'] = $this->lesForums();
		//$data['main_navigation'] = 'navigation';
		$data['main_menu'] = 'forum/listeForums';
		$data['right_menu'] = 'navigation/right';
		$data['main_header'] = 'includes/main_header';
		$data['main_content'] = 'forum/listeThreadsQuick';
		$this->load->view('includes/template', $data);
	}
	
	function thread($idThread) {
		$this->load->model('forum/thread_item_model');
		$data['lesTIbyT'] = $this->thread_item_model->getTIbyT($idThread);
		$data['lesForums'] = $this->lesForums();
		//$data['main_navigation'] = 'navigation';
		//$data['main_menu'] = 'forum/listeForums';
		$data['right_menu'] = 'navigation/right';
		$data['main_header'] = 'includes/main_header';
		$data['main_menu'] = 'forum/listeForums';
		$data['main_content'] = 'forum/listeTIbyT';
		$this->load->view('includes/template', $data);
	}
	
	function unread($idForum) {
		$this->load->model('forum/forum_model');
		$data = $this->forum_model->getUnread($idForum);
		//print_r($data);
		return $data;
	} 
	
	function unread2($idForum) {
		$this->load->model('forum/forum_model');
		$data = $this->forum_model->getUnread2($idForum);
		//print_r($data);
		return $data;
	} 
	
	function unread3($idForum) {
		$this->load->model('forum/forum_model');
		$data = $this->forum_model->getUnread3($idForum);
		?>
		<pre>
		<?php 
		print_r($data);
		//f_name
		//unread
		?>
		</pre>
		<?php 
		return $data;
	} 

}
?>