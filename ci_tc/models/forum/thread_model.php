<?php

class Thread_model extends Model {
	
/*
id
t_author
t_created
t_name
t_description
t_fori
t_lastmod
t_lastauthor
t_nbitems
t_lastitem
t_archived
t_closed
*/
	
		
 	public function __construct()
    {
        parent::__construct();
    }
	
	function addT($data) 
	{
		$this->db->insert('thread', $data);
		return;
	}
	
	function delT($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('thread');
	}
	
 	public function getTs()
    {
    	$this->db->_compile_select();
		$lesT=$this->db->get('thread');
		echo $this->db->last_query();
    	return $lesT->result();
    }

	public function getT($id)
    {
		/* to debug SQL
		$this->db->_compile_select();
		*/
		//$leFilm=$this->db->get_where('thread', array('id' => $id));
		//$this->db->where('id', $this->uri->segment(4));
		$this->db->where('id', $id);
		$leT=$this->db->get('thread');
		/* to debug SQL
		echo $this->db->last_query();
		*/
    	return $leT->result();
    }
    
	public function getTPrevious($id)
    {
		$this->db->where('id <',$id);
		$this->db->order_by('id', 'desc');
		$leT=$this->db->get('thread', 1, 0);
    	return $leT->row();
    }
	
	public function getTNext($id)
	{
		$this->db->where('id >',$id);
		$this->db->order_by('id', 'asc');
		$leT=$this->db->get('thread', 1, 0);
    	return $leT->row();
    }
	
	
	public function getTMin()
	{
		$this->db->select_min('id');
		$query = $this->db->get('thread');
		$min = $query->row(); 
		return $min->id;
	}
	
	public function getTMax()
	{
		$this->db->select_max('id');
		$query = $this->db->get('thread');
		$max = $query->row(); 
		return $max->id;
	}
	
	function editT($id, $data)
	{
		/*
		$data = array(
			'id' => $id,
			't_author' => $t_author,
			't_created' => $t_created,
			't_name' => $t_name,
			't_description' => $t_description,
			't_fori' => $t_fori,
			't_lastmod' => $t_lastmod,
			't_lastauthor' => $t_lastauthor,
			't_nbitems' => $t_nbitems,
			't_lastitem' => $t_lastitem,
			't_archived' => $t_archived,
			't_closed' => $t_closed
		);
		*/
		$this->db->where('id', $id);
		$this->db->update('thread', $data);
	}

	function getNbMsgbyT($id) {
		$this->db->where('id', $id);
		$this->db->from('thread_item');
		$leNbT= $this->db->count_all_results();
		return $leNbT;//->result();
		//return $leNbT->result();
		
		
	}

	
	
	public function getThreadsSubject($idForum, $limit, $offset)
    {
    	//$this->db->_compile_select();
    	//$this->db->select('count(distinct thread_item.ti_author) as nbParticipants, count(thread.id) as nbLu, thread.id, thread.t_author, thread.t_created, thread.t_name, thread.t_description, thread.t_fori, thread.t_lastmod, thread.t_lastauthor, thread.t_nbitems, thread.t_lastitem, thread.t_archived, thread.t_closed , forum.id as fid, forum.f_name, u1.User_Name as userNameLast, u2.User_Name as userNameFirst');
    	$this->db->select('forum.id as fid, forum.f_name, 
    	thread.id, thread.t_name, thread.t_description, 
    	count(distinct thread_item.ti_author) as nbParticipants, count(thread.id) as nbLu, 
    	thread.t_created, thread.t_author, u2.User_Name as userNameFirst, 
    	thread.t_fori, 
    	thread.t_lastmod, thread.t_lastauthor, u1.User_Name as userNameLast'  
    	);
    	//$this->db->from('thread');
		$this->db->join('forum', 'thread.t_fori = forum.id');
		$this->db->join('thread_item', 'thread.id = thread_item.ti_thread');
		$this->db->join('users as u1', 'thread.t_lastauthor = u1.User_Id');
		$this->db->join('users as u2', 'thread.t_author = u2.User_Id');
		$this->db->where('t_fori', $idForum);
		$this->db->group_by('thread.id');
		$this->db->order_by('t_lastmod', 'desc'); 
		//$this->db->order_by('t_lastmod', 'desc'); 
    	$getThreads=$this->db->get('thread', $limit, $offset);
    	//echo $this->db->last_query();
    	//print_r($getThreads->result());
    	return $getThreads->result();
    	//return $getThreads->result_array();
    }
    
	public function getThreadsQuick($idForum, $limit, $offset)
    {
    	//$this->db->_compile_select();
    	$this->db->select('thread.id as tid, thread.t_name,   
    	thread_item.id as tiid, thread_item.ti_author, thread_item.ti_date, thread_item.ti_contents, thread_item.ti_archived, thread_item.ti_thread, thread_item.ti_insidenum, users.User_Name as userName, forum.id as fid, forum.f_name');
    	//$this->db->from('thread');
		$this->db->join('forum', 'thread.t_fori = forum.id');
		$this->db->join('thread_item', 'thread.id = thread_item.ti_thread');
		$this->db->join('users', 'thread_item.ti_author = users.User_Id');
		$this->db->where('t_fori', $idForum);
		//$this->db->group_by('thread.id');
		$this->db->order_by('t_lastmod', 'desc'); 
    	//$getThreads=$this->db->get();
    	$getThreads=$this->db->get('thread', $limit, $offset);
    	//echo $this->db->last_query();
    	return $getThreads->result();
    }
    
    function getNbThreads($idForum) {
    	//$this->db->_compile_select();
    	$this->db->select('thread.t_fori, count(thread.t_fori)');
		$this->db->from('thread');
    	$this->db->join('forum', 'thread.t_fori = forum.id');
    	$this->db->where('thread.t_fori', $idForum);
		$this->db->group_by('thread.t_fori');
    	$getNbThreads=$this->db->count_all_results();
    	//echo $this->db->last_query();
    	return $getNbThreads;
    }
    
	function getNbThreadItems($idForum) {
    	//$this->db->_compile_select();
    	$this->db->select('count(thread.t_fori)');
		$this->db->from('thread');
    	$this->db->join('forum', 'thread.t_fori = forum.id');
    	$this->db->join('thread_item', 'thread_item.ti_thread = thread.id');
    	$this->db->where('thread.t_fori', $idForum);
		$this->db->group_by('thread.t_fori');
    	$getNbThreads=$this->db->count_all_results();
    	//echo $this->db->last_query();
    	return $getNbThreads;
    }
}
?>