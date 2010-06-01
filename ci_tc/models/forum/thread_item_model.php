<?php

class Thread_item_model extends Model {
/*
id
ti_author
ti_date
ti_contents
ti_archived
ti_thread
ti_insidenum
*/	
 	public function __construct()
    {
        parent::__construct();
    }
	
	function addTI($data) 
	{
		$this->db->insert('thread_item', $data);
		return;
	}
	
	function delTI($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('thread_item');
	}
	
	public function getTIs()
    {
		$lesTI=$this->db->get('thread_item');
    	return $lesTI->result();
    }
	
    public function getTIbyT($id)
    {
		$this->db->select('thread_item.*, users.User_Name, thread.t_description, thread.t_name, thread.t_fori');
		$this->db->from('thread_item');
		$this->db->join('thread', 'thread_item.ti_thread = thread.id');
		$this->db->join('users', 'thread_item.ti_author = users.User_Id');
		$this->db->where('thread.id', $id);
		$this->db->order_by('ti_date', 'desc');

		//$query = $this->db->get();
		$lesTIbyT = $this->db->get();
		return $lesTIbyT->result();
		
		// Produces:
		// SELECT * FROM blogs
		// JOIN comments ON comments.id = blogs.id
    }
    
    
	public function getTI($id)
    {
		/* to debug SQL
		$this->db->_compile_select();
		*/
		//$leFilm=$this->db->get_where('thread_item', array('id' => $id));
		//$this->db->where('id', $this->uri->segment(4));
		$this->db->where('id', $id);
		$leTI=$this->db->get('thread_item');
		/* to debug SQL
		echo $this->db->last_query();
		*/
    	return $leTI->result();
    }
    
	public function getTIPrevious($id)
    {
		$this->db->where('id <',$id);
		$this->db->order_by('id', 'desc');
		$leTI=$this->db->get('thread_item', 1, 0);
    	return $leTI->row();
    }
	
	public function getTINext($id)
	{
		$this->db->where('id >',$id);
		$this->db->order_by('id', 'asc');
		$leTI=$this->db->get('thread_item', 1, 0);
    	return $leTI->row();
    }
	
	
	public function getTIMin()
	{
		$this->db->select_min('id');
		$query = $this->db->get('thread_item');
		$min = $query->row(); 
		return $min->id;
	}
	
	public function getTIMax()
	{
		$this->db->select_max('id');
		$query = $this->db->get('thread_item');
		$max = $query->row(); 
		return $max->id;
	}
	
	function editT($id, $data)
	{
		/*
		$data = array(
			'id' => $id	,
			'ti_author' => $ti_author,
			'ti_date' => $ti_date,
			'ti_contents' => $ti_contents,
			'ti_archived' => $ti_archived,
			'ti_thread' => $ti_thread,
			'ti_insidenum' => $ti_insidenum,
		);
		*/
		$this->db->where('id', $id);
		$this->db->update('thread_item', $data);
	}
	
	function getTIChrono() {
		$this->db->select('*');
		$this->db->from('thread_item');
		$this->db->join('thread', 'thread_item.ti_thread = thread.id');
		$this->db->order_by("ti_date", "desc"); 
		//$this->db->where('thread.id', $id);
		

		//$query = $this->db->get();
		$lesTIChrono = $this->db->get();
		return $lesTIChrono->result();
		
		// Produces:
		// SELECT * FROM blogs
		// JOIN comments ON comments.id = blogs.id
    }
	

}
?>