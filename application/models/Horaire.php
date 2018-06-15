<?php
class Horaire extends CI_Model {
	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($data) {
    	return $this->db->insert('Horaire', $data);    
    }

    public function get($key) {
    	$query = $this->db->select('Jour, Heure')
            ->from('Horaire')
            ->where('clef', $key)
            ->get();
        $query = $query->result();
        return $query;
    }
}
?>