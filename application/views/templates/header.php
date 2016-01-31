<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

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

<script async defer
       src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBu9AE8MvT526Yv37X05wdlT6qAdCXrnUQ&signed_in=true&callback=initMap"></script>

<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo" style="padding-left: 20px;">WTFAMI</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#">Home</a></li>
            <li><a href="about">About</a></li>
        </ul>
    </div>
</nav>