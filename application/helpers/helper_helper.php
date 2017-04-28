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

	function alerts($success = NULL)
	{
		if(validation_errors()){ 
                $string1 = '<div role="alert" class="alert alert-danger beautiful"><div>'.validation_errors().'</div>
                </div>';
                print_r($string1);
        }
        if(isset($success)){ 
        	$string2 = '<div role="alert" class="alert alert-success beautiful"><div>'.$success.'</div>
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
		$s .= '<div class="rv" style="background-image:url(' . base_url('assets/img/').$user->last_bg.')"></div>';
        $s .= '<div class="rq awx">';
        $s .= '<a href="'.base_url($user->username).'">';
        $s .= '<img class="bqr" src="'.base_url('assets/img/'.$user->last_picture) .'" />';
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
    	$s .= '</div>';
        $s .= '</div>';

                
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
				$s .= 	'<img class="bqa wp yy agc" src="'.base_url('assets/img/'. $follow->last_picture).'" />';
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
		$s = "";
		$s .= '<li class="tu b ahx">';
		$s .= '<a href="'.base_url($post->username).'">';
		$s .= '<img class="bqa wp yy agc" src="'. base_url('assets/img/'.$post->last_picture).'" />';
		$s .= '</a>';
		$s .= '<div class="tv">';
		$s .= '<div class="bqj">';
		$s .= '<small class="aec axr">';
		$s .= date('d/m/Y - H:i:s',  strtotime($post->date)).' - ';
		$s .= $post->dis < 2 ? "Relativamente Perto" :  number_format($post->dis, 2, '.', ''). ' km' ;
		$s .= '</small>';
		$s .= '<h6>'. $post->name .'</h6>';
		$s .= '</div>';
		$s .= '<p>';
		$s .= htmlspecialchars($post->message);
		$s .= '</p>';
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

