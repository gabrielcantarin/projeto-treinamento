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
            $id = $this->db->insert_id();
            $this->updateSession($id);
        }

        public function update()
        {
            if(isset($_POST['name']) && $_POST['name'] != "") {
                $d['name'] = $_POST['name'];
            } if(isset($_POST['username']) && $_POST['username'] != "") {
                $d['username'] = $_POST['username'];
            } if(isset($_POST['email']) && $_POST['email'] != "") {
                $d['email'] = $_POST['email'];
            } if(isset($_POST['pass']) && $_POST['pass'] != "") {
                $d['pass'] = $_POST['pass'];
            } if(isset($_POST['bio'])) {
                $d['bio'] = $_POST['bio'];
            } if(isset($_POST['sexo']) && $_POST['sexo'] != "") {
                $d['sexo'] = $_POST['sexo'];
            }

            $id = $this->session->userdata('id');

            $this->db->where('id', $id);

            $this->db->update('Usuario', $d);
            $this->updateSession($id);
        }

        public function login()
        {
            $this->db->where('email', $_POST['email']);
            $this->db->where('pass', md5($_POST['pass']));

            $query = $this->db->get('Usuario');

            if($query !== FALSE && $query->num_rows() > 0){
                $this->updateSession($query->row()->id);
                return $query->row();
            }
        }

        public function createSession($username)
        {
            $user = $this->getUserByUsername($username);
            // $user = $this->getUserByUsername($username);

            $this->session->set_userdata(array(
                'id'            => $user->id,
                'name'          => $user->name,
                'username'      => $user->username,
                'email'         => $user->email,
                'valid'         => $user->valid,
                'hash'          => $user->hash,
                'last_lat'      => $user->last_lat,
                'last_log'      => $user->last_log,
                'last_city'     => $user->last_city,
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

        public function updateLiveLocationUser($lat = NULL, $log = NULL, $city = NULL, $id=NULL)
        {
            if($lat && $log){
                $this->db->set('last_lat', $lat);
                $this->db->set('last_log', $log);
                $this->db->set('last_city', $city);
                $this->db->where('id', $this->session->userdata('id'));

                $this->db->update('Usuario');
                $this->updateSession($id);
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

        public function updateUserPhoto($user_id, $data)
        {
            $this->db->set('last_picture', $data['upload_data']['file_name']);
            $this->db->where('id', $user_id);
            $this->db->update('Usuario');
        }

        public function updateUserCover($user_id, $data)
        {
            $this->db->set('last_bg', $data['upload_data']['file_name']);
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

        public function getUserById($user_id)
        {
            $this->db->where('id', $user_id);

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