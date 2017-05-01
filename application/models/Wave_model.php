<?php 
class Wave_model extends CI_Model {

        public function wave($user_id, $post_id)
        {
            $this->db->set('user_id', $user_id);
            $this->db->set('post_id', $post_id);

            $this->db->insert('Waves');
        } 

        public function unwave($user_id, $post_id)
        {
            $this->db->where('user_id', $user_id);
            $this->db->where('post_id', $post_id);

            $this->db->delete('Waves');
        }

        public function hasAlreadyWaved($user_id, $post_id)
        {
            $this->db->where('user_id', $user_id);
            $this->db->where('post_id', $post_id);

            $query = $this->db->get('Waves');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->row();
            }
        }

        public function getWavesOfListPosts($listPosts, $user_id)
        {
            if($listPosts){
                foreach ($listPosts as $post) {
                    $post->waved = $this->hasAlreadyWaved($user_id, $post->id_post) ? 1: 0;
                    if($post->father){
                        $post->father->waved = $this->hasAlreadyWaved($user_id, $post->father->post_id) ? 1: 0;
                    }
                }
                return $listPosts;
            }
        }

        

}










