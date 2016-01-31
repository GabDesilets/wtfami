<?php


class user_routes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_one_route()
    {
        $this->db
            ->select('rm.id, rm.route_id, rm.marker_lat, rm.marker_long')
            ->select('r.name, r.description')
            ->from('routes r')
            ->join('routes_markers rm', 'r.id = rm.route_id');
        return $this->db->get()->result();
    }

    public function get_routes_markers_description($route_id)
    {
        $this->db
            ->select('rmd.id, rmd.route_id, rmd.marker_lat, rmd.marker_long')
            ->from('routes r')
            ->join('route_marker_descriptions rmd', 'r.id = rmd.route_id')
            ->where('rmd.route_id', $route_id);
        return $this->db->get->result();

    }

    public function get_routes()
    {
        $this->db
            ->select('r.id, r.name, r.description')
            ->from('routes r');
        return $this->db->get()->result();
    }

    public function where_user($user_id)
    {
        $this->db
            ->join('users_routes', 'r.id = users_routes.route_id')
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

            $this->db->where('r.id', $route_id);
            $this->db->delete('routes r');
        }
    }

    public function where_route($route_id)
    {
        $this->db->where('users_routes.route_id', $route_id);
        return $this;
    }
}