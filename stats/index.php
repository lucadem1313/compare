<?php

    $relative = '../';
    $currentpage = 'Graphs';
    include($relative.'start.php');

?>







<!DOCTYPE html>

<html>
<head>
    <link rel='stylesheet' href='css/style.css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
   <script src="http://cdn.zingchart.com/zingchart.min.js"></script>
   <title>Charts of Usage</title>
</head>

<body>

<?php include($relative."includes/header.php"); ?>

<div id='container'>

        <h1 style='font-size:40px;'><i class="material-icons" style='font-size:70px;vertical-align:middle;'>timeline</i>&nbsp;&nbsp; Visitor Stats</h1>
        <?php
                echo "<br><br><br><h1><u>".mysql_num_rows(mysql_query("SELECT DISTINCT(voterip) AS voterip FROM votes"))."</u> Total Unique Visitors</h1><h1><u>".mysql_num_rows(mysql_query('SELECT * FROM votes'))."</u> Total Votes</h1><h1><u>".mysql_num_rows(mysql_query('SELECT * FROM items WHERE unapproved=0'))."</u> Total Polls</h1><h1><u>".round(mysql_num_rows(mysql_query('SELECT * FROM votes'))/mysql_num_rows(mysql_query("SELECT DISTINCT(voterip) AS voterip FROM votes")))."</u> Avg. Polls Answered Per User</h1><br><br><br><br><br><br>";
                $datecounts1 = array();
                $dates1 = array();
                $selectticketssolved = mysql_query("SELECT * FROM votes ORDER BY date ASC");
                while($row2 = mysql_fetch_array($selectticketssolved))
                {
                    $datetocheck = date('Y-m-d', strtotime($row2{'date'}));
                    
                    $dateformatted = date('n/j/Y', strtotime($row2{'date'}));
                    
                    if(!in_array($dateformatted, $dates1))
                    {
                        $datatemp = mysql_num_rows(mysql_query("SELECT * FROM votes WHERE date BETWEEN '".$datetocheck." 00:00:00' AND '".$datetocheck." 23:59:59'"));
                        array_push( $datecounts1, $datatemp);
                        array_push($dates1, $dateformatted);
                    }
                }
                
                echo "<div class='card three'><div id='chartDiv1'></div></div>
                <script>
                
                var labels1 = ".json_encode($dates1).";
                var data1 = ".json_encode($datecounts1).";
                  var chartData1={
                    'type':'line',
                    'plot':{'aspect':'spline',},
                    'plot':{
                        'animation':{
                            'effect':'1',
                            'sequence':'1',
                            'speed':'2'
                        }
                    },
                    'labels':[
                      { 
                        'text':'<u>".mysql_num_rows(mysql_query('SELECT * FROM votes'))."</u> total votes',
                        'font-family':'sans-serif',
                        'font-size':'20',
                        'x':'30%',
                        'y':'60%'
                      }],
                    'title':{
                        'text':'Votes Over Time'
                    },
                    'scale-x':{
                        'labels':labels1
                    },
                    'series':[
                        {
                            'values': data1
                        }
                    ]
                  };
                  zingchart.render({
                    id:'chartDiv1',
                    data:chartData1,
                    height:400,
                    width:600
                  });
                </script>";
                
                
                
                
                
                
                $datecounts2 = array();
                $dates2 = array();
                $selectticketssolved = mysql_query("SELECT * FROM items WHERE unapproved=0 ORDER BY date ASC");
                while($row2 = mysql_fetch_array($selectticketssolved))
                {
                    $datetocheck = date('Y-m-d', strtotime($row2{'date'}));
                    
                    $dateformatted = date('n/j/Y', strtotime($row2{'date'}));
                    
                    if(!in_array($dateformatted, $dates2))
                    {
                        $datatemp = mysql_num_rows(mysql_query("SELECT * FROM items WHERE unapproved=0 AND date BETWEEN '".$datetocheck." 00:00:00' AND '".$datetocheck." 23:59:59'"));
                        array_push( $datecounts2, $datatemp);
                        array_push($dates2, $dateformatted);
                    }
                }
                
                echo "<div class='card three'><div id='chartDiv2'></div></div>
                <script>
                
                var labels2 = ".json_encode($dates2).";
                var data2 = ".json_encode($datecounts2).";
                  var chartData2={
                    'type':'line',
                    'plot':{
                        'animation':{
                            'effect':'1',
                            'sequence':'1',
                            'speed':'2'
                        }
                    },
                    'labels':[
                      { 
                        'text':'<u>".mysql_num_rows(mysql_query('SELECT * FROM items WHERE unapproved=0'))."</u> total polls',
                        'font-family':'sans-serif',
                        'font-size':'20',
                        'x':'45%',
                        'y':'50%'
                      }],
                    'title':{
                        'text':'Polls Created Over Time'
                    },
                    'scale-x':{
                        'labels':labels2
                    },
                    'series':[
                        {
                            'values': data2
                        }
                    ]
                  };
                  zingchart.render({
                    id:'chartDiv2',
                    data:chartData2,
                    height:400,
                    width:600
                  });
                </script>";
                
                
                
                
                
                
                //$datecounts3 = array();
                //$dates3 = array();
                //$alldates = array();
                //$selectticketssolved = mysql_query("SELECT DISTINCT(voterip) AS voterip FROM votes");
                //while($row2 = mysql_fetch_array($selectticketssolved))
                //{
                //    
                //    while($row3 = mysql_fetch_array(mysql_query('SELECT * FROM votes WHERE voterip="'.$row2{'voterip'}.'" ORDER BY id ASC LIMIT 1')))
                //    {
                //        $datetocheck = date('Y-m-d', strtotime($row3{'date'}));
                //        
                //        $dateformatted = date('n/j/Y', strtotime($row3{'date'}));
                //        
                //        $datatemp = array_count_values($alldates)[$dateformatted];
                //        
                //        array_push($datecounts3, $datatemp);
                //        array_push($dates3, $dateformatted);
                //        array_push($alldates, $dateformatted);
                //    }
                //}
                //
                //echo "<div class='card three'><div id='chartDiv3'></div></div>
                //<script>
                //
                //var labels3 = ".json_encode($dates3).";
                //var data3 = ".json_encode($datecounts3).";
                //  var chartData3={
                //    'type':'line',
                //    'plot':{
                //        'animation':{
                //            'effect':'1',
                //            'sequence':'1',
                //            'speed':'2'
                //        }
                //    },
                //    'labels':[
                //      { 
                //        'text':'<u>".mysql_num_rows(mysql_query('SELECT DISTINCT(voterip) AS voterip FROM votes'))."</u> total unique users',
                //        'font-family':'sans-serif',
                //        'font-size':'20',
                //        'x':'60%',
                //        'y':'20%'
                //      }],
                //    'title':{
                //        'text':'Total Unique Users Over Time'
                //    },
                //    'scale-x':{
                //        'labels':labels3
                //    },
                //    'series':[
                //        {
                //            'values': data3
                //        }
                //    ]
                //  };
                //  zingchart.render({
                //    id:'chartDiv3',
                //    data:chartData3,
                //    height:400,
                //    width:600
                //  });
                //</script>";
                
                
                
                
                //$datecounts2 = array();
                //$dates2 = array();
                //$selectticketssolved = mysql_query("SELECT * FROM items WHERE unapproved=0 ORDER BY date ASC");
                //while($row2 = mysql_fetch_array($selectticketssolved))
                //{
                //    $datetocheck = date('Y-m-d', strtotime($row2{'date'}));
                //    
                //    $dateformatted = date('n/j/Y', strtotime($row2{'date'}));
                //    
                //    if(!in_array($dateformatted, $dates2))
                //    {
                //        $datatemp = mysql_num_rows(mysql_query("SELECT * FROM items WHERE unapproved=0 AND date BETWEEN '".$datetocheck." 00:00:00' AND '".$datetocheck." 23:59:59'"));
                //        array_push( $datecounts2, $datatemp);
                //        array_push($dates2, $dateformatted);
                //    }
                //}
                //
                //echo '<div class="card three"><div id="chartDiv3"></div></div>
                //<script>
                //
                //var labels3 = '.json_encode($dates3).';
                //var data3 = '.json_encode($datecounts3).';
                //  var chartData2 =  {"graphset":[
                //    {
                //      "type": "bar", /* Specify your chart type. */
                //      "height":"100%",
                //      "width":"33.33%",
                //      "x":"0%",
                //      "y":"0%",
                //      "series":[{"values":[20,40,25,50,15,45,33,34]}]
                //    },
                //    {
                //      "type": "bar",
                //      "height":"100%",
                //      "width":"33.33%",
                //      "x":"33.33%",
                //      "y":"0%",
                //      "series":[{"values":[5,30,21,18,59,50,28,33]}]
                //    },  
                //    {
                //      "type": "bar",
                //      "height":"100%",
                //      "width":"33.33%",
                //      "x":"66.66%",
                //      "y":"0%",
                //      "series":[{"values":[30,5,18,21,33,41,29,15]}]
                //    }
                //  ]
                //};
                //  zingchart.render({
                //    id:"chartDiv3",
                //    data:chartData3,
                //    height:400,
                //    width:600
                //  });
                //</script>';
                
                
                
                echo "<br><br><br><h1>A/B Testing (completed) - ".(mysql_num_rows(mysql_query("SELECT * FROM atest1")) + mysql_num_rows(mysql_query("SELECT * FROM btest1")))." participants</h1>";
                
                $majoritycount = mysql_num_rows(mysql_query("SELECT * FROM atest1 WHERE majority=1"));
                $minoritycount = mysql_num_rows(mysql_query("SELECT * FROM atest1 WHERE majority=0"));
                
                
                echo "<div class='card three'><div id='chartDiv6'></div>&nbsp;&nbsp;&nbsp;&nbsp;<div id='chartDiv4'></div></div>
                <script>
                
                var data4 = [".$majoritycount.", ".$minoritycount."];
                  var chartData4={
                    'type':'bar',
                    'plot':{
                        'animation':{
                            'effect':'1',
                            'sequence':'1',
                            'speed':'2'
                        }
                    },

                    'scale-x':{
                        'labels':['Voted for Majority', 'Voted for Minority']
                    },
                    'series':[
                        {
                            'values': data4
                        }
                    ]
                  };
                  zingchart.render({
                    id:'chartDiv4',
                    data:chartData4,
                    height:400,
                    width:300
                  });
                </script>";
                
                
                
                    //
                    //'labels':[
                    //  { 
                    //    'text':'".(round(mysql_num_rows(mysql_query('SELECT * FROM atest1 WHERE majority=1'))/mysql_num_rows(mysql_query('SELECT * FROM atest1'))*100, 0))."% majority<br>".(round(mysql_num_rows(mysql_query('SELECT * FROM atest1 WHERE majority=0'))/mysql_num_rows(mysql_query('SELECT * FROM atest1'))*100, 0))."% minority',
                    //    'font-family':'sans-serif',
                    //    'font-size':'20',
                    //    'x':'60%',
                    //    'y':'20%'
                    //  }],
                    //
                
                
                
                
                
                $majoritycount2 = mysql_num_rows(mysql_query("SELECT * FROM btest1 WHERE majority=1"));
                $minoritycount2 = mysql_num_rows(mysql_query("SELECT * FROM btest1 WHERE majority=0"));
                
                
                echo "<br><br><br><br><div class='card three'><div id='chartDiv7'></div>&nbsp;&nbsp;&nbsp;&nbsp;<div id='chartDiv5'></div></div>
                <script>
                
                var data5 = [".$majoritycount2.", ".$minoritycount2."];
                  var chartData5={
                    'type':'bar',
                    'plot':{
                        'animation':{
                            'effect':'1',
                            'sequence':'1',
                            'speed':'2'
                        }
                    },


                    'scale-x':{
                        'labels':['Voted for Majority', 'Voted for Minority']
                    },
                    'series':[
                        {
                            'values': data5
                        }
                    ]
                  };
                  zingchart.render({
                    id:'chartDiv5',
                    data:chartData5,
                    height:400,
                    width:300
                  });
                </script>";
                
                
                $majoritycount2 = mysql_num_rows(mysql_query("SELECT * FROM atest1 WHERE majority=1"));
                $minoritycount2 = mysql_num_rows(mysql_query("SELECT * FROM atest1 WHERE majority=0"));
                
                
                echo "
                <script>
                
                var data5 = [".$majoritycount2.", ".$minoritycount2."];
                  var chartData5={
                    'type':'pie3d',
                    'plot':{
                        'animation':{
                            'effect':'1',
                            'sequence':'1',
                            'speed':'2'
                        }
                    },

                    'title':{
                        'text':'Users Who Saw Results - ".mysql_num_rows(mysql_query('SELECT * FROM atest1'))." total votes'
                    },
                    'series':[
                        {'values': [".$majoritycount2."], 'text':'Voted for Majority - ".(round(mysql_num_rows(mysql_query('SELECT * FROM atest1 WHERE majority=1'))/mysql_num_rows(mysql_query('SELECT * FROM atest1'))*100, 0))."%'},
                        {'values': [".$minoritycount2."], 'text':'Voted for Minority - ".(round(mysql_num_rows(mysql_query('SELECT * FROM atest1 WHERE majority=0'))/mysql_num_rows(mysql_query('SELECT * FROM atest1'))*100, 0))."%'}
                    ]
                  };
                  zingchart.render({
                    id:'chartDiv6',
                    data:chartData5,
                    height:500,
                    width:700
                  });
                </script>";
                
                
                $majoritycount2 = mysql_num_rows(mysql_query("SELECT * FROM btest1 WHERE majority=1"));
                $minoritycount2 = mysql_num_rows(mysql_query("SELECT * FROM btest1 WHERE majority=0"));
                
                
                echo "
                <script>
                
                var data5 = [".$majoritycount2.", ".$minoritycount2."];
                  var chartData5={
                    'type':'pie3d',
                    'plot':{
                        'animation':{
                            'effect':'1',
                            'sequence':'1',
                            'speed':'2'
                        }
                    },

                    'title':{
                        'text':'Users Who Didn\'t See Results - ".mysql_num_rows(mysql_query('SELECT * FROM btest1'))." total votes'
                    },
                    'series':[
                        {'values': [".$majoritycount2."], 'text':'Voted for Majority - ".(round(mysql_num_rows(mysql_query('SELECT * FROM btest1 WHERE majority=1'))/mysql_num_rows(mysql_query('SELECT * FROM btest1'))*100, 0))."%'},
                        {'values': [".$minoritycount2."], 'text':'Voted for Minority - ".(round(mysql_num_rows(mysql_query('SELECT * FROM btest1 WHERE majority=0'))/mysql_num_rows(mysql_query('SELECT * FROM btest1'))*100, 0))."%'}
                    ]
                  };
                  zingchart.render({
                    id:'chartDiv7',
                    data:chartData5,
                    height:500,
                    width:700
                  });
                </script>";


        ?>
    
    
    
    
    
 
    
    
    
</div>
    <footer>
        <h3>Made with <i class="material-icons">favorite</i> in New Hampshire.<br>Designed and Developed By Luca Demian</h3>
    </footer>
</body>
</html>
<?php

    mysql_close();
?>