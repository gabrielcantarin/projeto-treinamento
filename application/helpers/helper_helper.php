<?php 
	
	function imprimir($str,$exit=0){
		echo '<pre>';
        print_r($str);
        echo '</pre>';
        if($exit){
        	exit;
        }
	}

	function loged()
	{
		if(!isset($_SESSION['id'])){
			redirect(base_url('login'));
		}
	}

	function hasLocation()
	{
		if(!$_SESSION['last_lat'] || !$_SESSION['last_log']){
			redirect(base_url('localization'));
		}
	}

	function alerts($message = NULL)
	{
		if(validation_errors()){ 
                $string1 = '<div role="alert" class="alert alert-danger beautiful" style="width:100%"><div>'.validation_errors().'</div>
                </div>';
                print_r($string1);
        }
        if(isset($message['success']) && $message['success'] != ""){ 
        	$string2 = '<div role="alert" class="alert alert-success beautiful" style="width:100%"><div>'.$message['success'].'</div>
                </div>';
            print_r($string2);
        } 
        if(isset($message['error']) && $message['error'] != ""){ 
        	$string2 = '<div role="alert" class="alert alert-danger beautiful" style="width:100%"><div>'.$message['error'].'</div>
                </div>';
            print_r($string2);
        } 
	}

	function usuarioLogado()
	{
		if(isset($_SESSION['id'])){
			return true;
		}else{
			return false;
		}
	}

	function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
	{
	  // convert from degrees to radians
	  $latFrom = deg2rad($latitudeFrom);
	  $lonFrom = deg2rad($longitudeFrom);
	  $latTo = deg2rad($latitudeTo);
	  $lonTo = deg2rad($longitudeTo);

	  $lonDelta = $lonTo - $lonFrom;
	  $a = pow(cos($latTo) * sin($lonDelta), 2) +
	    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
	  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

	  $angle = atan2(sqrt($a), $b);
	  return ($angle * $earthRadius);
	}

	function arr2col($arr = NULL, $col)
	{
        $newArr = [];
        if($arr){
			foreach ($arr as $a) {
	                    $newArr[] = $a->$col;
	        }
        }

        return $newArr;
	}

	function unique_multidim_array($array, $key) { 
	    $temp_array = array(); 
	    $i = 0; 
	    $key_array = array(); 
	    
	    foreach($array as $val) { 
	    	$val = (array)$val;
	        if (!in_array($val[$key], $key_array)) { 
	            $key_array[$i] = $val[$key]; 
	            $temp_array[$i] = (object)$val; 
	        } 
	        $i++; 
	    } 
	    return $temp_array; 
	} 


	function upload_ajax1($base64_string) {
	    $data = explode(',', $base64_string)[1];

	    $milliseconds = round(microtime(true) * 1000).rand(0, 9999).".jpg";

		file_put_contents(FCPATH.'assets/img'.$milliseconds, $data);
	}


	function upload_ajax($base64_string) {
	    $milliseconds = round(microtime(true) * 1000).rand(0, 9999).".jpg";

	    $ifp = fopen(FCPATH.'assets/img/'.$milliseconds, "wb"); 

	    $data = explode(',', $base64_string);

	    fwrite($ifp, base64_decode($data[1])); 
	    fclose($ifp); 

	    return $milliseconds; 
	}

	function redirect_back()
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
        exit;
    }

	function converteDataAmericanaParaBrasileira()
	{

	}

	function ignora_acentos()
	{
		
	}

	function constroy_perfil_left($user)
	{
		$user = (object)$user;

		$s = "";

		$s .= '<div class="rp bqq agk">';
		$s .= '<div class="rv" style="background-image:url(' . base_url('media/').$user->last_bg.')"></div>';
        $s .= '<div class="rq awx">';
        $s .= '<a href="'.base_url($user->username).'">';
        $s .= '<img class="bqr" src="'.base_url('media/'. $user->last_picture).'" />';
        $s .= '</a>';
        $s .= '<h6 class="rr"><a class="bph" href="'.base_url($user->username).'">'.$user->name.'</a></h6>';
        $s .= '<p class="agk">@'.$user->username.'</p>';
        $s .= '<ul class="bqs">';
        $s .= '<li class="bqt">';
        $s .= '<a href="'.base_url($user->username).'" class="bph" data-toggle="modal">Waves';
        $s .= '<h6 class="afl">'. $user->last_wave.' </h6>';
        $s .= '</a>';
        $s .= '</li>';
       	$s .= '<li class="bqt">';
        $s .= '<a href="'.base_url($user->username.'/follow').'" class="bph" data-toggle="modal">Seguindo';
        $s .= '<h6 class="afl">'. $user->last_follow.'</h6>';
        $s .= '</a>';
        $s .= '</li>';
        $s .= '<li class="bqt">';
        $s .= '<a href="'.base_url($user->username.'/followed').'" class="bph" data-toggle="modal">Seguidores';
        $s .= '<h6 class="afl">'.$user->last_followed.'</h6>';
        $s .= '</a>';
        $s .= '</li>';
        $s .= '</ul>';
        $s .= '<div class="bqi">';
        if($user->id != $_SESSION['id']){ 
            if($user->isAlreadyFollower){ 
			$s .= '<a href="'.base_url('unfollow/'.$user->id) .'">';
            $s .= '<button class="cg pq pz">Unfollow</button>';
            $s .= '</a>';
            }else{
            $s .= '<a href="'.base_url('follow/'.$user->id).'">';
            $s .= '<button class="cg pq pz">Follow</button>';
            $s .= '</a>';
            }
        }else{
        	$s .= '</br>'; 
        }
        $s .= '</div>';
    	$s .= '</div>';
        $s .= '</div>';

        // imprimir($user);
                
		print_r($s);
	}

	function constroy_should_follow($should_follow)
	{
		$s = "";

		if($should_follow){ 
			$s .= 	'<div class="rp brb agk">';
			$s .= 	'<div class="rq">';
			$s .= 	'<h6 class="agd">Você deveria Seguir</h6>';
			$s .= 	'<ul class="bqe bqf">';

            foreach($should_follow as $follow) { 
				$s .= 	'<li class="tu afw">';
				$s .= 	'<a href="'. base_url($follow->username).'">';
				$s .= 	'<img class="bqa wp yy agc" src="'.base_url('media/'. $follow->last_picture).'" />';
				$s .= 	'</a>';
				$s .= 	'<div class="tv">';
				$s .= '<a class="bph" href="'.base_url($follow->username).'">';
				$s .= '<strong>'. $follow->name. '</strong>'.' @ '.$follow->username;
				$s .= '</a>';
				$s .= '<div class="bqi">';
				$s .= '<a href="'.base_url('follow/'.$follow->id).'">';
				$s .= '<button class="cg pq pz">Follow</button>';
				$s .= '</a>';
				$s .= '</div>';
				$s .= '</div>';
				$s .= '</li>';
            }
            
			$s .= '</ul>';
			$s .= '</div>';
			$s .= '</div>';
        } 

		print_r($s);

	}

	function constroy_btn_config($menu)
	{
		$menu1 = $menu == "data" ? "pj":"pl";
		$menu2 = $menu == "photo" ? "pj":"pl";
		$menu3 = $menu == "cover" ? "pj":"pl";
		$menu4 = $menu == "deactivate" ? "pj":"pl";
		$menu5 = $menu == "localization" ? "pj":"pl";

		$s = "";
		$s .= '<div class="rp brb agk">';
		$s .= '<div class="rq">';
		$s .= '<h6 class="agd">Configurações</h6>';
		$s .= '<ul class="bqe bqf">';

		$s .= '<li class="tu afw">';
		$s .= '<div class="tv">';
		$s .= '<div class="bqi">';
		$s .= '<a href="'.base_url('config').'">';
	    $s .= '<button class="cg '. $menu1 .' cem" type="button">Configurações Básicas</button>';
		$s .= '</a>';
		$s .= '</div>';
		$s .= '</div>';
		$s .= '</li>';

		$s .= '<li class="tu afw">';
		$s .= '<div class="tv">';
		$s .= '<div class="bqi">';
		$s .= '<a href="'.base_url('localization').'">';
	    $s .= '<button class="cg '. $menu5 .' cem" type="button">Localização</button>';
		$s .= '</a>';
		$s .= '</div>';
		$s .= '</div>';
		$s .= '</li>';

		$s .= '<li class="tu afw">';
		$s .= '<div class="tv">';
		$s .= '<div class="bqi">';
		$s .= '<a href="'.base_url('profile-photo').'">';
	    $s .= '<button class="cg '. $menu2 .' cem" type="button">Trocar Foto de Perfil</button>';
		$s .= '</a>';
		$s .= '</div>';
		$s .= '</div>';
		$s .= '</li>';

		$s .= '<li class="tu afw">';
		$s .= '<div class="tv">';
		$s .= '<div class="bqi">';
		$s .= '<a href="'.base_url('cover-photo').'">';
	    $s .= '<button class="cg '. $menu3 .' cem" type="button">Trocar Foto de Capa</button>';
		$s .= '</a>';
		$s .= '</div>';
		$s .= '</div>';
		$s .= '</li>';

		$s .= '<li class="tu afw">';
		$s .= '<div class="tv">';
		$s .= '<div class="bqi">';
		$s .= '<a href="'.base_url('deactivate-account').'">';
	    $s .= '<button class="cg '. $menu4 .' cem" type="button">Desativar Conta</button>';
		$s .= '</a>';
		$s .= '</div>';
		$s .= '</div>';
		$s .= '</li>';

		$s .= '</ul>';
		$s .= '</div>';
        $s .= '</div>';

		print_r($s);

	}

	function constroy_post($post)
	{
		$post->liked = $post->liked == 1? "liked" : "";
		$post->waved = $post->waved == 1? "waved" : "";

		$s = "";
		$s .= '<li class="tu b ahx post">';
		$s .= '<a class="yy" href="'.base_url($post->username).'">';
		$s .= '<img class="bqa wp agc" src="'.base_url('media/'. $post->last_picture).'" />';
		$s .= '</a>';

		$s .= '<div class="tv">';
		$s .= '<div class="bqj">';
		$s .= '<small class="aec axr">';
		$s .= date('d/m/Y - H:i:s',  strtotime($post->date)).' - ';
		$s .= $post->dis < 2 ? "Relativamente Perto" :  number_format($post->dis, 2, '.', ''). ' km' ;
		$s .= '</small>';
		$s .= '<a class="bph" href="'.base_url($post->username).'">';
		$s .= '<h6>'. $post->name .'</h6>';
		$s .= '</a>';
		$s .= '</div>';

		$s .= '<p>';
		$s .= htmlspecialchars($post->message);
		$s .= '</p>';

		if($post->father){
		$post->father->liked = $post->father->liked == 1? "liked" : "";
		$post->father->waved = $post->father->waved == 1? "waved" : "";

		$s .= '<ul class="bqe afw">';
          $s .= '<li class="tu agd waving">';
			$s .= '<a class="yy" href="'.base_url($post->father->username).'">';
            $s .= '<img class="bqa wp agc" src="'.base_url('media/'. $post->father->last_picture).'" />';
			$s .= '</a>';

            $s .= '<div class="tv">';
				$s .= '<a class="bph" href="'.base_url($post->father->username).'">';
                $s .= '<strong>'. $post->father->name .'</strong>';
				$s .= '</a>';
				$s .= '<p>';
				$s .= htmlspecialchars($post->father->message);
				$s .= '</p>';

				$s .= '<ul class="bqs">';
				$s .= '<li class="bqt">';
				$s .= '<a href="'.base_url('like/'.$post->father->post_id).'" class="bph">';
				$s .= '<i class="icon ion-heart like '. $post->father->liked .'"></i> '. $post->father->likes;
				$s .= '</a>';
				$s .= '</li>';

    			if($post->father->username != $_SESSION['username']){
					$s .= '<li class="bqt">';
					$s .= '<a href="'.base_url('wave/'.$post->father->post_id).'" class="bph">';
					$s .= '<i class="icon ion-radio-waves wave '. $post->father->waved .'"></i> '.$post->father->waves;
					$s .= '</a>';
					$s .= '</li>';
				}
		        $s .= '</ul>';

            $s .= '</div>';
          $s .= '</li>';
        $s .= '</ul>';
    	}

		$s .= '<ul class="bqs">';

		$s .= '<li class="bqt">';
		$s .= '<a href="'.base_url('like/'.$post->id_post).'" class="bph">';
		$s .= '<i class="icon ion-heart like '. $post->liked .'"></i> '. $post->likes;
		$s .= '</a>';
		$s .= '</li>';

    	if($post->username != $_SESSION['username']){
	    	if($post->message){
				$s .= '<li class="bqt">';
				$s .= '<a href="'.base_url('wave/'.$post->id_post).'" class="bph">';
				$s .= '<i class="icon ion-radio-waves wave '. $post->waved .'"></i> '.$post->waves;
				$s .= '</a>';
				$s .= '</li>';
	    	}
    	}



        $s .= '</ul>';

		$s .= '</div>';
        $s .= '</li>';

		print_r($s);

	}

	function constroy_situation_main($title,$message)
	{
		$s = "";
		$s .= '<li class="tu b ahx">';
	        $s .= '<div class="tv" style="text-align: center; margin: 30px">';
	            $s .= '<div class="bqj">';
	            $s .= '<h6>'.$title.'</h6>';
	            $s .= '</div>';
	            $s .= '<p>'.$message.'</p>';
	        $s .= '</div>';
	    $s .= '</li>';


	    print_r($s);
    }

?>

