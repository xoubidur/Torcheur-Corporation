<?php
class Forum_model extends Model {

    public function __construct()
    {
        parent::__construct();
    }
	
    public function getForums()
    {
    	
    	$this->db->order_by('f_name', 'asc'); 
		$lesForums=$this->db->get('forum');
    	return $lesForums->result();
    	/*
    	$this->db->select('forum.*, ');
		$this->db->from('forum');
		$this->db->join('thread', 'forum.id = thread.t_fori');
		$this->db->join('thread_item', 'thread.id = thread_item.ti_thread');
		$this->db->join('read_table', 'thread_item.id = read_table.thread_item_id');
		$this->db->where('id', $idForum);
		*/
	
    }
    
	public function getforum($id)
    {
		$this->db->where('id', $id);
		$leForum=$this->db->get('forum');
    	/*
    	$this->db->select('*');
		$this->db->from('forum');
		$this->db->join('thread', 'forum.id = thread.t_fori');
		$this->db->join('thread_item', 'thread.id = thread_item.ti_thread');
		$this->db->join('read_table', 'thread_item.id = read_table.thread_item_id');
		$this->db->where('id', $id);
		*/
		
    	return $leForum->result();
    }
    
	public function getUnread($idForum)
    {
    	$this->db->select('forum.*, thread.*');
		$this->db->from('forum');
		$this->db->join('thread', 'forum.id = thread.t_fori');
		$this->db->join('thread_item', 'thread.id = thread_item.ti_thread');
		$this->db->join('read_table', 'thread_item.id = read_table.thread_item_id');
		$this->db->where('forum.id', $idForum);
		//$unread=$this->db->get('forum');
		$unread = $this->db->get();
    	return $unread->result();
    }
    
    public function getUnread2($idForum)
    {
    	//$this->db->_compile_select();
    	$unread = $this->db->query("SELECT sum(nb) as unread 
			FROM 
			((
				SELECT 	count(*) as nb
				FROM 	read_table as a, 
						thread as b
				WHERE 	a.rt_thread = b.id
				AND 	b.t_fori=$idForum
				AND 	a.user_id=109
				AND 	b.t_archived=0
			 ) 
			union ALL
			(
				SELECT 	count(*)*-1 as nb
				FROM 	thread_item as d, 
						thread as e
				WHERE 	d.ti_thread = e.id
				AND 	e.t_fori=$idForum
				AND 	e.t_archived=0
			))
			AS truc
		");
    	//echo $this->db->last_query();
		return $unread->result();
    	
    }
	public function getUnread3($idForum)
    {
    	//$this->db->_compile_select();
    	$unread = $this->db->query("
    		SELECT forum.f_name, sum(nb) as unread 
			FROM 
			((
				SELECT 	count(*) as nb
				FROM 	read_table as a, 
						thread as b
				WHERE 	a.rt_thread = b.id
				AND 	b.t_fori=$idForum
				AND 	a.user_id=109
				AND 	b.t_archived=0
			 ) 
			union ALL
			(
				SELECT 	count(*)*-1 as nb
				FROM 	thread_item as d, 
						thread as e
				WHERE 	d.ti_thread = e.id
				AND 	e.t_fori=$idForum
				AND 	e.t_archived=0
			))
			AS truc, forum
			where forum.id = $idForum
		");
    	//echo $this->db->last_query();
		return $unread->result();
    	
    }  
}
?>