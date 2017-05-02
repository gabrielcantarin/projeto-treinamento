<?php 

function email_confirmation($user) {
	imprimir($user);
	$s = "";
	$s .= "<h1>Seja bem vindo ao Waving!</h1>";
	$s .= "<p>Obrigado por se cadastrar, Clique aqui para confirmar seu cadastro!</p>";
	$s .= "<p>Caso o link não esteja funcionando copie o link abaixo e cole em seu brownser.</p>";

	return $s;
}