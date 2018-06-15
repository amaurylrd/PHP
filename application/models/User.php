<?php
class User extends CI_Model {
    public function register($data) {
        $data['nom'] = ucfirst(strtolower($data['nom']));
        $data['prenom'] = ucfirst(strtolower($data['prenom']));
        $data['password'] = $this->ft_hash($data['password']);
        $query = $this->db->select('*')
            ->from('User')
            ->where('login', $data['login'])
            ->or_where('mail', $data['mail'])
            ->get();
        $query = $query->result();
        if (count($query) === 0)
            return $this->db->insert('User', $data);
        return false;
    }

    public function ft_hash($password) {
        $seed = 'abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789';
        $salt = '';
        for ($i = 0 ; $i < 4 ; $i++) {
            $c = $seed[rand(0, strlen($seed)-1)];
            $salt = $salt.$c;
        }
        $password = sha1($password).$salt;
        return $password;
    }

    public function exists($data) {
        $query = $this->db->select('password')
            ->from('User')
            ->where('login', $data['login'])
            ->get();
        $query = $query->result();
        if (count($query) === 1)
            return $this->matches($query[0]->password, $data['password']);
        return false;
    }
        
    public function matches($a, $b) {
        $a = substr($a, 0, -4);
        $b = substr($this->ft_hash($b), 0, -4);
        if ($a === $b)
            return true;
        return false;
    }

    public function edit($data, $id) {
        if ($id === 1) {
            $this->db->set('password', $this->ft_hash($data['pwd']));
            $this->db->where('login', $data['login']);
            $this->db->update('User');
        }
        else if ($id === 2) {
            $query = $this->db->select('password')
                ->from('User')
                ->where('login', $data['old'])
                ->get();
            $query = $query->result();
            if (count($query) === 1) {
                $this->db->set('login', $data['new']);
                $this->db->where('login', $data['old']);
                $this->db->update('User');
            }
            else
                return false;
        }
        else
            $this->db->delete('User', array('login' => $data));
        return true;
    }
}
?>