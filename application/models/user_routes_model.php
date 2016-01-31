<?php


class user_routes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_routes()
    {
        $this->db
            ->select('routes.id, routes.name, routes.description')
            ->from('routes');
        return $this->db->get()->result();
    }

    public function where_user($user_id)
    {
        $this->db
            ->join('users_routes', 'routes.id = users_routes.route_id')
            ->where('users_routes.user_id', $user_id);
        return $this;
    }

    public function delete($route_id, $uid)
    {
        $this->db->where('users_routes.route_id', $route_id);
        $this->db->where('users_routes.user_id', $uid);
        $success = $this->db->delete('users_routes');

        if ($success) {
            $this->db->where('routes_markers.route_id', $route_id);
            $this->db->delete('routes_markers');

            $this->db->where('route_marker_descriptions.route_id', $route_id);
            $this->db->delete('route_marker_descriptions');

            $this->db->where('routes.id', $route_id);
            $this->db->delete('routes');
        }
    }
}