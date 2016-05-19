<?php
    header("Access-Control-Allow-Origin: *");
    
    
    $relative = '';
    $currentpage = 'API';
    include($relative.'start.php');
    
    
    if(isset($_POST['newitems']))
    {
        if($_POST['url1'] == '')
            $_POST['url1'] = 'noimageprovided';
            
        if($_POST['url2'] == '')
            $_POST['url2'] = 'noimageprovided';
            
        if($_POST['name1'] != '' && $_POST['name2'] != '')
            $insertitems = mysql_query("INSERT INTO items (name1, url1, name2, url2, postedby) VALUES ('".mysql_real_escape_string(strip_tags($_POST['name1']))."','".mysql_real_escape_string(strip_tags($_POST['url1']))."','".mysql_real_escape_string(strip_tags($_POST['name2']))."','".mysql_real_escape_string(strip_tags($_POST['url2']))."','".mysql_real_escape_string(session_id())."')") or die(mysql_error());
    }
    
    if(isset($_POST['vote']))
    {
        if($_POST['item'] > 2)
            $_POST['item'] = 1;
        if($_POST['item'] < 1)
            $_POST['item'] = 1;
            
        if(mysql_num_rows(mysql_query("SELECT * FROM votes WHERE voterip='".session_id()."' AND itemid=".$_POST['itemid']."")) < 1 && mysql_num_rows(mysql_query("SELECT * FROM items WHERE id='".$_POST['itemid']."'")) > 0)
        {
            mysql_query("INSERT INTO votes (itemid, item, voterip) VALUES ('".mysql_real_escape_string($_POST['itemid'])."','".mysql_real_escape_string($_POST['item'])."','".mysql_real_escape_string(session_id())."')");
            
            //1 = no votes shown  = testb
            //0 = votes shown  = testa
            
            //if(mysql_num_rows(mysql_query("SELECT * FROM votes WHERE item=1 AND itemid=".$_POST['itemid'])) > mysql_num_rows(mysql_query("SELECT * FROM votes WHERE item=2 AND itemid=".$_POST['itemid'])))
            //    $majorityItem = 1;
            //else
            //    $majorityItem = 2;
            //    
            //if($_POST['item'] == $majorityItem)
            //    $majority = 1;
            //else
            //    $majority = 0;
            //
            //
            //if($_POST['testDecide'] == 0)
            //{
            //    mysql_query("INSERT INTO atest1 (itemid, item, voterip, majority) VALUES ('".mysql_real_escape_string($_POST['itemid'])."','".mysql_real_escape_string($_POST['item'])."','".mysql_real_escape_string(session_id())."', $majority)");
            //}
            //else
            //{
            //    mysql_query("INSERT INTO btest1 (itemid, item, voterip, majority) VALUES ('".mysql_real_escape_string($_POST['itemid'])."','".mysql_real_escape_string($_POST['item'])."','".mysql_real_escape_string(session_id())."', $majority)") or die(mysql_error());
            //}
            
            //mysql_query("UPDATE items SET votenumber=".mysql_num_rows(mysql_query("SELECT * FROM votes WHERE itemid=".$_POST['itemid']))." WHERE id=".$_POST['itemid']);
        }
    }
    
    if(isset($_POST['items']))
    {
        $items = "[[]";
        //$stuff = '[[{"votes": 0,"name": "Apple","src": "https://tctechcrunch2011.files.wordpress.com/2014/06/apple_topic.png?w=220"},{"votes": 0,"name": "Google","src": "https://media.licdn.com/mpr/mpr/shrink_200_200/AAEAAQAAAAAAAALTAAAAJGY1NGY1N2ZhLTNmZmUtNGRmZi1iMDgxLTJjZjdkNjNkYmZlOQ.png"}]]';
        //$items .= $stuff;
            
        $selectitems = mysql_query("SELECT * FROM items WHERE unapproved=0 ORDER BY RAND()") or die(mysql_error());
        while($row = mysql_fetch_array($selectitems))
        {
            if(mysql_num_rows(mysql_query("SELECT * FROM votes WHERE voterip='".session_id()."' AND itemid=".$row{'id'}."")) < 1)
            {
                $selectvotes1 = mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=1");
                $selectvotes2 = mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=2");
                
                if($row{'url1'} == 'noimageprovided')
                    $url1 = $defaultimageurl;
                else
                    $url1 = $row{'url1'};
                    
                    
                if($row{'url2'} == 'noimageprovided')
                    $url2 = $defaultimageurl;
                else
                    $url2 = $row{'url2'};
                
                $stuff = ',[{"votes": '.mysql_num_rows($selectvotes1).',"id": '.$row{'id'}.',"name": "'.$row{'name1'}.'","src": "'.$url1.'"},{"votes": '.mysql_num_rows($selectvotes2).',"id": '.$row{'id'}.',"name": "'.$row{'name2'}.'","src": "'.$url2.'"}]';
                $items .= $stuff;
            }
        }
        $items .= ']';
        if($items != "[[]]")
            echo $items;
        else
            echo false;
    }
    if(isset($_POST['urlset']))
    {
        $items = "[";
        //$stuff = '[[{"votes": 0,"name": "Apple","src": "https://tctechcrunch2011.files.wordpress.com/2014/06/apple_topic.png?w=220"},{"votes": 0,"name": "Google","src": "https://media.licdn.com/mpr/mpr/shrink_200_200/AAEAAQAAAAAAAALTAAAAJGY1NGY1N2ZhLTNmZmUtNGRmZi1iMDgxLTJjZjdkNjNkYmZlOQ.png"}]]';
        //$items .= $stuff;
            
        $selectitems = mysql_query("SELECT * FROM items WHERE id=".$_POST['id']." LIMIT 1") or die(mysql_error());
        while($row = mysql_fetch_array($selectitems))
        {

            $selectvotes1 = mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=1");
            $selectvotes2 = mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=2");
            
            $stuff = '[{"votes": '.mysql_num_rows($selectvotes1).',"id": '.$row{'id'}.',"name": "'.$row{'name1'}.'","src": "'.$row{'url1'}.'"},{"votes": '.mysql_num_rows($selectvotes2).',"id": '.$row{'id'}.',"name": "'.$row{'name2'}.'","src": "'.$row{'url2'}.'"}]';
            $items .= $stuff;
            
        }
        $items .= ']';
        if($items != "[]")
            echo $items;
        else
            echo false;
    }
    if(isset($_POST['voteditems']))
    {
        $items = "[[]";
        //$stuff = '[[{"votes": 0,"name": "Apple","src": "https://tctechcrunch2011.files.wordpress.com/2014/06/apple_topic.png?w=220"},{"votes": 0,"name": "Google","src": "https://media.licdn.com/mpr/mpr/shrink_200_200/AAEAAQAAAAAAAALTAAAAJGY1NGY1N2ZhLTNmZmUtNGRmZi1iMDgxLTJjZjdkNjNkYmZlOQ.png"}]]';
        //$items .= $stuff;
            
        $selectitems = mysql_query("SELECT * FROM items WHERE unapproved=0 ORDER BY id DESC") or die(mysql_error());
        while($row = mysql_fetch_array($selectitems))
        {
            if(mysql_num_rows(mysql_query("SELECT * FROM votes WHERE voterip='".session_id()."' AND itemid=".$row{'id'}."")) > 0)
            {
                $selectvotes1 = mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=1");
                $selectvotes2 = mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=2");
                
                //while($row2 = mysql_fetch_array(mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND voterip='".session_id()."' LIMIT 1")))
                //{
                
                    if($row{'url1'} == 'noimageprovided')
                        $url1 = $defaultimageurl;
                    else
                        $url1 = $row{'url1'};
                        
                        
                    if($row{'url2'} == 'noimageprovided')
                        $url2 = $defaultimageurl;
                    else
                        $url2 = $row{'url2'};
                    
                    $stuff = ',[{"votes": '.mysql_num_rows($selectvotes1).',"id": '.$row{'id'}.',"name": "'.$row{'name1'}.'","src": "'.$url1.'"},{"votes": '.mysql_num_rows($selectvotes2).',"id": '.$row{'id'}.',"name": "'.$row{'name2'}.'","src": "'.$url2.'"}]';
                //}
                
                $items .= $stuff;
            }
        }
        $items .= ']';
        if($items != "[[]]")
            echo $items;
        else
            echo false;
    }
    
    if(isset($_POST['allitems']))
    {
        $items = "[[]";
        //$stuff = '[[{"votes": 0,"name": "Apple","src": "https://tctechcrunch2011.files.wordpress.com/2014/06/apple_topic.png?w=220"},{"votes": 0,"name": "Google","src": "https://media.licdn.com/mpr/mpr/shrink_200_200/AAEAAQAAAAAAAALTAAAAJGY1NGY1N2ZhLTNmZmUtNGRmZi1iMDgxLTJjZjdkNjNkYmZlOQ.png"}]]';
        //$items .= $stuff;
            
        $selectitems = mysql_query("SELECT * FROM items WHERE unapproved=0 ORDER BY RAND()") or die(mysql_error());
        while($row = mysql_fetch_array($selectitems))
        {

            $selectvotes1 = mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=1");
            $selectvotes2 = mysql_query("SELECT * FROM votes WHERE itemid=".$row{'id'}." AND item=2");
            
            if($row{'url1'} == 'noimageprovided')
                $url1 = $defaultimageurl;
            else
                $url1 = $row{'url1'};
                
                
            if($row{'url2'} == 'noimageprovided')
                $url2 = $defaultimageurl;
            else
                $url2 = $row{'url2'};
            
            $stuff = ',[{"votes": '.mysql_num_rows($selectvotes1).',"id": '.$row{'id'}.',"name": "'.$row{'name1'}.'","src": "'.$url1.'"},{"votes": '.mysql_num_rows($selectvotes2).',"id": '.$row{'id'}.',"name": "'.$row{'name2'}.'","src": "'.$url2.'"}]';
            $items .= $stuff;
            
        }
        $items .= ']';
        if($items != "[[]]")
            echo $items;
        else
            echo false;
    }
    if(isset($_POST['acceptcookies']))
    {
        setcookie("acceptcookies", true, time()+60*60*24*360, "/");
    }
    if(isset($_POST['approve']))
    {
        mysql_query("UPDATE items SET unapproved=0 WHERE id=".$_POST['id']);
    }
    if(isset($_POST['delete']))
    {
        mysql_query("DELETE FROM items WHERE id=".$_POST['id']);
    }
    
    mysql_close();
?>