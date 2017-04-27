<?php 
class Usuario_model extends CI_Model {

        public function insert()
        {
            $data['name']        = $_POST['name'];
            $data['username']    = trim($_POST['username']);
            $data['email']       = trim($_POST['email']);
            $data['pass']        = md5($_POST['pass']);
            $data['hash']        = $this->hashGenerator($_POST['email']);

            $this->db->insert('Usuario', $data);
        }

        public function update()
        {
            !isset($_POST['name']) ? : = $d['name'] = $_POST['name'];
            $d['username']    = trim($_POST['username']);
            $d['email']       = trim($_POST['email']);
            $d['pass']        = md5($_POST['pass']);
            $d['hash']        = $this->hashGenerator($_POST['email']);

            $this->db->update('Usuario', $data);
        }

        public function login()
        {
            $this->db->where('email', $_POST['email']);
            $this->db->where('pass', md5($_POST['pass']));

            $query = $this->db->get('Usuario');

            if($query !== FALSE && $query->num_rows() > 0){
                 return $query->row();
            }
        }

        public function createSession($username)
        {
            // imprimir($username,1);
            $user = $this->getUserByUsername($username);

            $this->session->set_userdata(array(
                'id'            => $user->id,
                'name'          => $user->name,
                'username'      => $user->username,
                'email'         => $user->email,
                'valid'         => $user->valid,
                'hash'          => $user->hash,
                'last_lat'      => $user->last_lat,
                'last_log'      => $user->last_log,
                'last_wave'     => $user->last_wave,
                'last_follow'   => $user->last_follow,
                'last_followed' => $user->last_followed,
                'last_range'    => $user->last_range,
                'last_login'    => $user->last_login,
                'last_picture'  => $user->last_picture,
                'last_bg'       => $user->last_bg
            ));

        }

        public function hashGenerator($string)
        {
                return md5("!@#$".strrev($string)."!@#$".date('Y-m-d H:i:s'));
        }

        public function emailAvaliable($email)
        {
                $this->db->where('email', $email);

                $query = $this->db->get('Usuario');

                if($query !== FALSE && $query->num_rows() > 0){
                     return $query->row();
                }

        }

        public function validUser($email)
        {
                $this->db->where('email', $email);
                $this->db->where('valid', USUARIO_CONFIRMADO);

                $query = $this->db->get('Usuario');

                if($query !== FALSE && $query->num_rows() > 0){
                     return $query->row();
                }
        }

        public function updateLiveLocationUser($lat = NULL, $log = NULL)
        {
            if($lat && $log){
                $this->db->set('last_lat', $lat);
                $this->db->set('last_log', $log);

                $this->db->where('id', $this->session->userdata('id'));

                $this->db->update('Usuario');
            }
        }

        public function updateFollow($user_id, $action)
        {
            $this->db->set('last_follow', $this->session->userdata('last_follow') + $action);
            $this->db->where('id', $user_id);
            $this->db->update('Usuario');
        }

        public function updateWaves($user_id, $action)
        {
            $this->db->set('last_wave', $this->session->userdata('last_wave') + $action);
            $this->db->where('id', $user_id);
            $this->db->update('Usuario');
            imprimir($this->db->last_query());
        }

        public function updateFollowed($user_id, $action)
        {
            $this->db->set('last_followed', 'last_followed' . $action, FALSE);
            $this->db->where('id', $user_id);
            $this->db->update('Usuario');
        }

        public function updateUserPhoto($user_id, $file)
        {
            $this->db->set('last_picture', $file);
            $this->db->where('id', $user_id);
            $this->db->update('Usuario');
        }

        public function updateUserCover($user_id, $file)
        {
            $this->db->set('last_bg', $file);
            $this->db->where('id', $user_id);
            $this->db->update('Usuario');
        }

        public function getUserByUsername($username)
        {
            $this->db->where('username', $username);

            $query = $this->db->get('Usuario');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->row();
            }
        }

        public function getClosestPeople($num)
        {
            $a = "fn_distance(".$this->session->userdata('last_lat').",".$this->session->userdata('last_log').",last_lat,last_log) as dis";
            $this->db->select('*');
            $this->db->select($a, false);

            $this->db->where('last_lat IS NOT NULL');
            $this->db->where('last_log IS NOT NULL');
            $this->db->order_by('dis', 'ASC');
            $this->db->limit($num);

            $query = $this->db->get('Usuario');

            if($query !== FALSE && $query->num_rows() > 0){
                return $query->result();
            }
        }

}