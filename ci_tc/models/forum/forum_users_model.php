<?php
class Forum_users_model extends Model {

    public function __construct()
    {
        parent::__construct();
    }
	
    public function getUsers()
    {
		$lesFU=$this->db->get('forum_users');
    	return $lesFU->result();
    }
    
	public function getUser($id)
    {
		$this->db->where('id', $id);
		$leFU=$this->db->get('forum_users');
    	return $leFU->result();
    }
    
}
?>