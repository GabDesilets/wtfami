<?php


class users_model extends CI_Model
{

    /**
     * users_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function insert($user)
    {
        $this->db->insert('users', $user);
    }

    public function get_one($id)
    {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->limit(1);

        return $this->db->get()->row();
    }
}