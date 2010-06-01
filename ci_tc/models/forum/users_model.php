<?php
class Users_model extends Model {

    public function __construct()
    {
        parent::__construct();
    }
	
    public function getUsers()
    {
		$lesUsers=$this->db->get('users');
    	return $lesUsers->result();
    }
    
	public function getUser($id)
    {
		$this->db->where('id', $id);
		$leUser=$this->db->get('users');
    	return $leUser->result();
    }

    public function getUserNameV($id)
    {
    	$this->db->select('User_Name');
		$this->db->where('id', $id);
		$leUser=$this->db->get('users');
    	return $leUser->result();
    }
}
?>