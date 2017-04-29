<?php 
class Post_model extends CI_Model {

        public function create()
        {
            $data['user_id']    = $this->session->userdata('id');
            $data['message']    = $_POST['message'];
            $data['lat']        = $_POST['lat'];
            $data['log']        = $_POST['log'];

            $this->db->insert('Post', $data);
        } 

        public function getPostsFirstLoad()
        {
            $a = "fn_distance(".$this->session->userdata('last_lat').",".$this->session->userdata('last_log').",lat,log) as dis";
            $this->db->select('*');
            $this->db->select($a, false);

            $this->db->join('Usuario', 'Usuario.id = Post.user_id');
            $this->db->order_by('date', 'DESC');

            $query = $this->db->get('Post');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->result();
            }
        }

        public function getPostsByUsername($username)
        {
            $a = "fn_distance(".$this->session->userdata('last_lat').",".$this->session->userdata('last_log').",last_lat,last_log) as dis";
            $this->db->select('*');
            $this->db->select($a, false);

            $this->db->join('Usuario', 'Usuario.id = Post.user_id');
            $this->db->order_by('date', 'DESC');

            $this->db->where('username', $username);

            $query = $this->db->get('Post');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->result();
            }
        }

        public function getPostsOfListUsers($arr)
        {
            $arr = arr2col($arr, 'username');

            $a = "fn_distance(".$this->session->userdata('last_lat').",".$this->session->userdata('last_log').",last_lat,last_log) as dis";
            $this->db->select('*');
            $this->db->select("Post.id as id_post", false);
            $this->db->select($a, false);

            $this->db->join('Usuario', 'Usuario.id = Post.user_id');
            $this->db->order_by('date', 'DESC');
            $this->db->limit(10);

            if($arr){
                $this->db->where_in('username', $arr);
            }

            $query = $this->db->get('Post');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->result();
            }
        }

        public function updateLike($post_id, $action)
        {
            $this->db->set('likes', 'likes' . $action, FALSE);
            $this->db->where('id', $post_id);
            $this->db->update('Post');
        }
}