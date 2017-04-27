<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waving</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/Footer-Basic.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Header-Blue.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Header-Dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/nav-sticky-top.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Navigation-with-Button1.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/NS-Navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Pretty-Header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Registration-Form-with-Photo.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <div></div>
    <div></div>
    <div>
        <div class="header-blue">
            <nav class="navbar navbar-default navigation-clean-search">
                <div class="container">
                    <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">WAVING Social Network</a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    </div>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav"></ul>
                        <p class="navbar-text navbar-right"><a class="navbar-link login" href="#">Log In</a> <a class="btn btn-default action-button" role="button" href="#">Sign Up</a></p>
                    </div>
                </div>
            </nav>
            <div class="container hero">
                <div class="row">
                    <div class="col-lg-5 col-lg-offset-1 col-md-6 col-md-offset-0">
                        <h1>What goes around?</h1>
                        <p>Mauris egestas tellus non ex condimentum, ac ullamcorper sapien dictum. Nam consequat neque quis sapien viverra convallis. In non tempus lorem. </p>
                    </div>
                    <div class="col-lg-5 col-lg-offset-1 col-md-6 col-md-offset-0 phone-holder">
                        <form method="post" id="register" action="<?= base_url("Welcome/index") ?>">
                            <h2 class="text-center" style="color:white;"><strong>Criar</strong> uma conta</h2>
                            <? if(validation_errors()){ ?>
					        	<div role="alert" class="alert alert-danger beautiful">
								    <div><?= validation_errors(); ?></div>
								</div>
					      	<? } ?>
                            <div class="form-group">
                                <input class="form-control" type="text" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="pass" placeholder="Password">
                            </div>
                            <div class="form-group"></div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label class="control-label" style="color:white;">
                                        <input type="checkbox">Eu concordo com os termos de uso.
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-block" type="submit">Cadastrar </button>
                            </div>

                            <a href="#" class="already" style="color:white!important;">
                            	Já possui uma conta? Clique aqui para Entrar
                            </a>
                        </form>
                    	<form method="post" id="login" style="display: none" action="<?= base_url("Welcome/login") ?>">
                            <h2 class="text-center" style="color:white;"><strong>Entrar</strong> agora mesmo</h2>
                            <? if(validation_errors()){ ?>
					        	<div role="alert" class="alert alert-danger beautiful">
								    <div><?= validation_errors(); ?></div>
								</div>
					      	<? } ?>
                            <div class="form-group">
                                <input class="form-control" type="email" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="pass" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-block" type="submit">Entrar </button>
                            </div>
                            <a href="#" class="already" style="color:white!important;">
                            	Esqueci minha senha
                        	</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-basic">
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Waving Social Network© 2016</p>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

<script>
	$(".already").click(function(){
		$("#login").show();
		$("#register").hide();
	});

</script>