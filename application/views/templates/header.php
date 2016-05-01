<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <title><?php echo $title; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/reset.css">



        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

        <script src="<?php echo base_url();?>assets/js/jquery.menu-aim.js"></script>
        <script src="<?php echo base_url();?>assets/js/main.js"></script> <!-- Resource jQuery -->
    </head>
 
    <body>
    
        <header class="cd-main-header">
            <!-- <h1><img src="logo.jpg" width="100" height="60"/>Gestion des visites</h1> -->
            <div class="cd-main-logo">
                 <a href="#0" class="cd-logo"><img src="<?php echo base_url();?>assets/img/logo-gsb-new2.png" alt="Logo"></a>
                 <a href="#0" class="cd-logo" id="text-logo">Visite médicale</a>
             </div>

             <!-- <div class="cd-titre">GSB : Suivi de la Visite médicale</div> -->

             <a href="#0" class="cd-nav-trigger">Menu<span></span></a>

        <nav class="cd-nav">
            <ul class="cd-top-nav">
                <li class="has-children account">
                    <a href="#0">
                        Visiteur
                        <?php
                        /*
					        foreach($nomV as $data) {
					            echo $data->VIS_NOM.' '.$data->VIS_PRENOM;
					        }
                            */
					    ?>

                    </a>

                    <ul>
                        <li><?php echo anchor('controlleur_principal/deconnexion','Déconnexion'); ?></li>
                    </ul>
                </li>
            </ul>
        </nav>

        </header>

        <main class="cd-main-content">
        <nav class="cd-side-nav">
            <?php $this->view('menuCR'); ?>
        </nav>

        <div class="content-wrapper">