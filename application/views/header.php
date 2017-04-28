<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waving Social Network</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-theme.min.css'); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="<?= base_url('assets/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/beautiful-danger-alert.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Header-Blue.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Header-Dark.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Highlight-Phone.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/nav-sticky-top.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Navigation-with-Button1.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Pretty-Header.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Navigation-with-Search1.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/NS-Navbar.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Registration-Form-with-Photo.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/toolkit.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Footer-Basic.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/croppie.min.css') ?>">

    <link rel="shortcut icon" href="<?= base_url('assets/img/logo-waving2.png') ?>">


</head>

<body>
    <div>
        <nav class="navbar navbar-default navigation-clean-button">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand navbar-link" href="<?= base_url() ?>" style="padding:5px;"> 
                        <img src="<?= base_url('assets/img/logo-waving.png') ?>"/>
                    </a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                <? if(usuarioLogado()){ ?>
                    <p class="navbar-text navbar-right actions">
                        <!-- <a style="margin: 0px" class="btn btn-link " role="button" href="#"> 
                            <i class="icon ion-ios-bell" style="font-size:25px;"></i>
                        </a> -->
                        <a style="margin: 0px" class="btn btn-link navbar-btn" role="button" href="<?= base_url('config') ?>"> 
                            <i class="icon ion-ios-cog" style="font-size:25px;"></i>
                        </a>
                        <a style="margin: 0px" class="btn btn-link navbar-btn" role="button" href="<?= base_url('logout') ?>"> 
                            <i class="icon ion-android-exit" style="font-size:25px;"></i>
                        </a>
                    </p>
                <? } else { ?>
                    <p class="navbar-text navbar-right actions">
                        <a class="navbar-link login" href="<?= base_url('login'); ?>">
                            Entrar 
                        </a> 
                        <a class="btn btn-default action-button" role="button" href="<?= base_url('register'); ?>">
                            Cadastrar 
                        </a>
                        
                    </p>
                <? }  ?>
                </div>
            </div>
        </nav>
    </div>