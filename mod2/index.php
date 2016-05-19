<?php
    
    $relative = '../';
    $currentpage = 'Mod';
    include($relative.'start.php');
    
    if(!in_array(session_id(), $moderators))
        header("Location: ".$relative);
?>




<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Compare Stuff Mod Page</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    
    <link rel='icon' href='http://t08.deviantart.net/UiU3NnH8V9fdLnEOCwaBK4tJdDA=/300x200/filters:fixed_height(100,100):origin()/pre15/2c72/th/pre/i/2015/177/9/2/skype_call_shenanigans_by_mirplex-d8ysrur.png'>
    
    <link rel="stylesheet" href="style.css">

    
    <style>
/*        .pair{
            transition:all 0.4s;
        }
        .pair:hover{
            background:rgba(0,0,0,0.4);
        }*/
    </style>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script>
        $(document).ready(function(){
            
            
            var timeoutId = 0;

            $('.pair').mousedown(function() {
                
                
                
                element = $(this);
                
                element.children('.loadbar').animate({'width': '100%'}, 3000);
                
                timeoutId = setTimeout(function(){
                    $.ajax({
                        type: "POST",
                        url: "http://lucademian.com/compare/api.php",
                        data: {
                          "delete": true,
                          "id": element.data('id')
                        },
                        success: function(response){
                          element.remove();
                        }
                    });
                }, 3000);
                
            }).bind('mouseleave mouseup', function(){
                clearTimeout(timeoutId);
                element.children('.loadbar').stop().css({'width': '0%'});
            });
        });
    </script>
  </head>

  <body>

<div id='container'>
    <?php
        $selectunapproved1 = mysql_query("SELECT * FROM items WHERE unapproved=0 AND (url1='noimageprovided' OR url2='noimageprovided') ORDER BY id DESC");
        while($row = mysql_fetch_array($selectunapproved1))
        {
            $selectvotes1 = mysql_num_rows(mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=1"));
            $selectvotes2 = mysql_num_rows(mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=2"));
            
            if($row{'url1'} == 'noimageprovided')
                $url1 = $defaultimageurl;
            else
                $url1 = $row{'url1'};
                
                
            if($row{'url2'} == 'noimageprovided')
                $url2 = $defaultimageurl;
            else
                $url2 = $row{'url2'};
            
            echo "<div class='pair' title='Approve' style='cursor:pointer' data-id='".$row{'id'}."'><div class='loadbar'></div>
                <div class='staticproduct'><img draggable='false' src='".$url1."' alt='".$row{'name1'}."'><h1><span class='votenumber'>".$selectvotes1."</span><i class=\"material-icons\">thumb_up</i><br><span class='votecount1'>".$row{'name1'}."</span></h1></div>
                <div class='staticproduct'><img draggable='false' src='".$url2."' alt='".$row{'name2'}."'><h1><span class='votenumber'>".$selectvotes2."</span><i class=\"material-icons\">thumb_up</i><br><span class='votecount1'>".$row{'name2'}."</span></h1></div>
                <br><br><span id='productnames'></span><br></div>";
        }
        $selectunapproved2 = mysql_query("SELECT * FROM items WHERE unapproved=0 AND (url1!='noimageprovided' AND url2!='noimageprovided') ORDER BY id DESC");
        while($row = mysql_fetch_array($selectunapproved2))
        {
            $selectvotes1 = mysql_num_rows(mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=1"));
            $selectvotes2 = mysql_num_rows(mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=2"));
            
            if($row{'url1'} == 'noimageprovided')
                $url1 = $defaultimageurl;
            else
                $url1 = $row{'url1'};
                
                
            if($row{'url2'} == 'noimageprovided')
                $url2 = $defaultimageurl;
            else
                $url2 = $row{'url2'};
            
            echo "<div class='pair' title='Approve' style='cursor:pointer' data-id='".$row{'id'}."'><div class='loadbar'></div>
                <div class='staticproduct'><img draggable='false' src='".$url1."' alt='".$row{'name1'}."'><h1><span class='votenumber'>".$selectvotes1."</span><i class=\"material-icons\">thumb_up</i><br><span class='votecount1'>".$row{'name1'}."</span></h1></div>
                <div class='staticproduct'><img draggable='false' src='".$url2."' alt='".$row{'name2'}."'><h1><span class='votenumber'>".$selectvotes2."</span><i class=\"material-icons\">thumb_up</i><br><span class='votecount1'>".$row{'name2'}."</span></h1></div>
                <br><br><span id='productnames'></span><br></div>";
        }
        if(mysql_num_rows($selectunapproved1) < 1 && mysql_num_rows($selectunapproved2) < 1)
        {
            echo "<h1>There is nothing to show.</h1>";
        }
    ?>
</div>


    
    
    
  </body>
</html>
