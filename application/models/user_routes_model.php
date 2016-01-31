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
            ->select('rmd.id, rmd.route_id, rmd.marker_lat, rmd.marker_long, rmd.name, rmd.description')
            ->from('routes r')
            ->join('route_marker_descriptions rmd', 'r.id = rmd.route_id')
            ->where('rmd.route_id', $route_id);
        return $this->db->get()->result();

    }

    public function with_search($search_string = '')
    {
        $this->db
            ->join('users_routes', 'r.id = users_routes.route_id')
            ->join('users', 'r.id = users_routes.route_id')
            ->like('users.fname', $search_string)
            ->or_like('users.lname', $search_string)
            ->or_like('users.email', $search_string)
            ->or_like('r.name', $search_string)
            ->or_like('r.description', $search_string);
        $this->db->select("CONCAT_WS(' ', users.fname, users.lname) as author", false);
        $this->db->select('users.id user_id');
        return $this;
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

    public function save_new_routes($routes, $uid)
    {
        $this->db->insert(
            'routes',
            [
                'name' => 'todo',
                'description' => 'todo'
            ]
        );
        $rid = $this->db->insert_id();

        $this->db->insert(
            'users_routes',
            [
                'user_id' => $uid,
                'route_id' => $rid
            ]
        );

        foreach ($routes['routes_markers'] as $rm) {
            $rm['route_id'] = $rid;
            $this->db->insert(
                'routes_markers',
                [
                    'route_id' => $rid,
                    'marker_lat' => (float)$rm['lat'],
                    'marker_long' => (float)$rm['long']
                ]
            );
        }

        foreach ($routes['route_markers_descriptions'] as $rmd) {
            $this->db->insert(
                'route_marker_descriptions',
                [
                    'route_id' => $rid,
                    'name' => $rmd['name'],
                    'description' => $rmd['description'],
                    'marker_lat' => (float)$rmd['lat'],
                    'marker_long' => (float)$rmd['long']
                ]
            );
        }
    }
}