<?php
    
    $relative = '';
    $currentpage = 'Home';
    include($relative.'start.php');
?>




<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Compare Stuff</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    
    <link rel='icon' href='http://t08.deviantart.net/UiU3NnH8V9fdLnEOCwaBK4tJdDA=/300x200/filters:fixed_height(100,100):origin()/pre15/2c72/th/pre/i/2015/177/9/2/skype_call_shenanigans_by_mirplex-d8ysrur.png'>
    
    <link rel="stylesheet" href="style.css">

    <script type="text/javascript">
        window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},s=d.getElementsByTagName('script')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='//rec.getsmartlook.com/bundle.js';s.parentNode.insertBefore(c,s);
        })(document);
        smartlook('init', '0adfe535e3314e5c469ff179fe8579c6c064b494');
    </script>
    
    
  </head>

  <body>
    <select id='sortby'>
        <option id='firstoption'></option>
        <option value='sizeasc'>Sort Small To Large</option>
        <option value='sizedesc'>Sort Large To Small</option>
        <option value='az'>Sort A-Z</option>
        <option value='za'>Sort Z-A</option>
    </select>
    <div id='voteditems'></div>
    
    <script src='https://raw.githubusercontent.com/jackmoore/wheelzoom/master/wheelzoom.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>

    <script src="index.js"></script>
    <script>
        $('#sortby').change(function(){
            window.location.hash = $(this).val();
            window.location.reload();
        });
    </script>
</body>
</html>
