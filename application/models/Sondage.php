<?php
class Sondage extends CI_Model {
	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($data) {
    	$data['titre'] = ucfirst(strtolower($data['titre']));
    	$data['lieu'] = ucfirst(strtolower($data['lieu']));
        return $this->db->insert('Sondage', $data);
    }

    public function key_gen() {
        $seed = 'abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789';
        $res = '';
        for ($i = 0 ; $i < 35 ; $i++) {
            $c = $seed[rand(0, strlen($seed)-1)];
            $res = $res.$c;
        }
        if ($this->defined($res))
            $this->key_gen();
        return $res;
    }  

    public function defined($key) {
        $query = $this->db->select('Clef')
            ->from('Sondage')
            ->where('clef', $key)
            ->get();
        $query = $query->result();
        if (count($query) === 0)
            return false;
        return true;
    }

    public function exists($key) {
        $query = $this->db->select('Clef')
            ->from('Sondage')
            ->where('clef', $key)
            ->get();
        $query = $query->result();
        if (count($query) === 1)
            return true;
        return false;
    }

    public function get($key) {
        $query = $this->db->select('Titre, Lieu, Description')
            ->from('Sondage')
            ->where('clef', $key)
            ->get();
        $query = $query->result();
        return $query;
    }
}
?>