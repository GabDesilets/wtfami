<?php

class login_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }


    /**
     * user auth
     *
     * @param string $username
     * @param string $password
     *
     * @return boolean
     */
    public function doAuthentication($username, $password) {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('login', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);

        return $this->db->get()->num_rows() > 0;
    }


}