<?php 
class Like_model extends CI_Model {

        public function like($user_id, $post_id)
        {
            $this->db->set('user_id', $user_id);
            $this->db->set('post_id', $post_id);

            $this->db->insert('Likes');
        } 

        public function unlike($user_id, $post_id)
        {
            $this->db->where('user_id', $user_id);
            $this->db->where('post_id', $post_id);

            $this->db->delete('Likes');
        }

        public function hasAlreadyLiked($user_id, $post_id)
        {
            $this->db->where('user_id', $user_id);
            $this->db->where('post_id', $post_id);

            $query = $this->db->get('Likes');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->row();
            }
        }

        public function getLikesOfListPosts($listPosts, $user_id)
        {
            if($listPosts){
                foreach ($listPosts as $post) {
                    $post->liked = $this->hasAlreadyLiked($user_id, $post->id_post) ? 1: 0;
                }
                return $listPosts;
            }
        }

        

}










