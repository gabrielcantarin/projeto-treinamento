<?php 

function email_confirmation($user) {


	$link = base_url('confirmation/'.$user['hash']);

	$s = "";
	$s .= "<h3>Obrigado por se cadastrar no Waving!</h3>";
	$s .= "<p>Para confirmar seu cadastro <a href='".$link."'>clique aqui</a>!</p>";
	$s .= "<p>Caso o link não esteja funcionando copie o link abaixo e cole em seu browser.</p>";
	$s .= "<p><a href='".$link."'>".$link."</a></p>";
	$s .= "<p>--</br>Gabriel Cantarin </br> CEO @ItsWaving</p>";

	return $s;
}