<?php
class Read_table_model extends Model {

    public function __construct()
    {
        parent::__construct();
    }
	
    public function getReadTable()
    {
		$lesRT=$this->db->get('read_table');
    	return $lesRT->result();
    }
    
	public function getUser($id)
    {
		$this->db->where('id', $id);
		$leRT=$this->db->get('read_table');
    	return $leRT->result();
    }
    
}
?>