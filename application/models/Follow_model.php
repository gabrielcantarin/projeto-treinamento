<?php 
class Follow_model extends CI_Model {

        public function follow($user_id, $follow)
        {
            $data['user_id']    = $user_id;
            $data['follow']    = $follow;

            $this->db->insert('Follow', $data);
        } 

        public function unfollow($user_id, $follow)
        {
            $this->db->where('user_id', $user_id);
            $this->db->where('follow', $follow);

            $this->db->delete('Follow');
        }

        public function isAlreadyFollower($user_id, $follow)
        {
            $this->db->where('user_id', $user_id);
            $this->db->where('follow', $follow);

            $query = $this->db->get('Follow');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->row();
            }
        }

        public function shouldFollow($alreadyFollow)
        {

            if($alreadyFollow){
                $this->db->where_not_in('username', $alreadyFollow);
            }

            $this->db->limit(4);
            $this->db->order_by('RAND()');

            $query = $this->db->get('Usuario');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->result();
            }
        }

        public function imFollowing($user_id)
        {
            $this->db->join('Usuario', 'Usuario.id = Follow.follow');
            $this->db->where('Follow.user_id', $user_id);

            $query = $this->db->get('Follow');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->result();
            }
        }

        public function followingMe($user_id)
        {
            $this->db->join('Usuario', 'Usuario.id = Follow.user_id');
            $this->db->where('Follow.Follow', $user_id);

            $query = $this->db->get('Follow');

                // imprimir($this->db->last_query(),1);
            if($query !== FALSE && $query->num_rows() > 0){
                return $query->result();
            }
            return [];
        }

}










