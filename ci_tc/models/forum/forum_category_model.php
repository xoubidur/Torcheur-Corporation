<?php
class Forum_category_model extends Model {

    public function __construct()
    {
        parent::__construct();
    }
	
    public function getUsers()
    {
		$lesFC=$this->db->get('forum_category');
    	return $lesFC->result();
    }
    
	public function getUser($id)
    {
		$this->db->where('id', $id);
		$leFC=$this->db->get('forum_category');
    	return $leFC->result();
    }
    
}
?>