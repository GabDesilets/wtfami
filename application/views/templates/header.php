<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <style>
    #floating-panel {
           position: absolute;
           top: 30px;
           right: 62px;
           width: 293px;
           z-index: 5;
           background-color: #fff;
           padding: 5px;
           border: 2px solid #999;
           text-align: center;
           padding-left: 10px;
       }
    </style>

    <title>Where the Fuck Am I?!</title>
</head>
<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>

<nav>
    <div class="nav-wrapper">
        <a href="<?php echo base_url();?>" class="brand-logo" style="padding-left: 20px;">WTFAMI</a>
        
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>
              <div class="input-field" style="width:500px;margin-right:375px;">
                <form name="frmQuickSearch" action="<?php echo site_url('route/index')?>" method="GET">
                  <input id="search" name="search_string" type="search" placeholder="Recherchez une route...">
                  <label for="search"><i class="material-icons">search</i></label>
                </form>
              </div>
            </li>
            <li><a href="<?php echo base_url();?>">Accueil</a></li>
            <li><a href="<?php echo base_url();?>about">&Agrave; propos</a></li>
        </ul>
    </div>
</nav>