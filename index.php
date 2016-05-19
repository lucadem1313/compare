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
    
    <link rel="stylesheet" href="css/style.css">

    <script type="text/javascript">
        window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},s=d.getElementsByTagName('script')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='//rec.getsmartlook.com/bundle.js';s.parentNode.insertBefore(c,s);
        })(document);
        smartlook('init', '0adfe535e3314e5c469ff179fe8579c6c064b494');

        console.log('<?php echo session_id(); ?>');
    </script>
    
    
  </head>

  <body>
    <?php if(!isset($_COOKIE['acceptcookies'])){echo '<header>By using this site you agree to cookies<i class="material-icons">cancel</i></header>';} ?>
    <h1>Which one is better?</h1><br>
    <div id='container'>
    
    </div>
    <button id='new' title='New Poll'><div id='line1'></div><div id='line2'></div></button>
    <form id='newitem'>
      Add 2 items to compare<br>
      <input name='name1' type='text' placeholder='Name of first item...' autocomplete='off'>
      <input name='url1' type='text' placeholder='URL for image...' autocomplete='off'><br>
      <input name='name2' type='text' placeholder='Name of second item...' autocomplete='off'>
      <input name='url2' type='text' placeholder='URL for image...' autocomplete='off'><br><br>
      <button class='button'><span>Save <i class="material-icons">forward</i></span><div></div></button>
    </form>
    <div id='voteditems'><br><br><br><i class="material-icons">trending_up</i>&nbsp;&nbsp; Poll Results:<br><br><a href='stats'>Click Here</a> to view visitor stats<br><br><a href='plot'>Click Here</a> to view poll infographic<br><br><br><br></div>
    <br><br>
    <footer>
        <h3>Made with <i class="material-icons">favorite</i> in New Hampshire.<br>Designed and Developed By Luca Demian</h3>
    </footer>
<!--    <h1 style='position: fixed;bottom: 20px; right:20px;font-size: 23px;'>There are<br><span id='pollcount' style='font-size: 45px;'><?php //echo mysql_num_rows(mysql_query("SELECT * FROM items WHERE unapproved=0")); ?></span><br>polls right now</h1>
    <h1 style='position: fixed;bottom: 20px; left:20px;font-size: 23px;'>There have been<br><span id='pollcount' style='font-size: 45px;'><?php //echo mysql_num_rows(mysql_query("SELECT * FROM votes"));/*echo mysql_num_rows(mysql_query("SELECT DISTINCT(voterip) AS voterip FROM votes"));*/ ?></span><br>total votes</h1>
-->    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>

    <script src="js/index.js"></script>
</body>
</html>
