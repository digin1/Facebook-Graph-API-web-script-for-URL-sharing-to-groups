<?php
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
               
        $_SESSION['token'] = $_POST['field1'];
        $_SESSION['link'] = $_POST['field2'];
        $_SESSION['message'] = $_POST['field3'];
   
        if($_SESSION['token'] == '' || $_SESSION['link'] == ''){ 
            echo '<p style="color:red">Missing values for either token or link</p>';
        }
   }
   
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tool for Sharing links to Groups/Profiles/Pages</title>
        <link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/dist/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link href="css/theme.css" rel="stylesheet"> 
        <script src="https://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>
        
    </head>
    <body>
        <div class="container theme-showcase" role="main">
        <h1>Facebook Link Sharing Tool</h1>
        
        
        <form name="frm" method="post">
            <fieldset class="form-group">
    		    <label for="useraccesstoken">Enter your User Access Token from Graph API</label></br>
    		    <input required type="text" style="width:100%" class="form-control" id="useraccesstoken" name="field1" placeholder="Enter Access Token">
                <div id="diverror" class="text-danger"></div>
                
                <label for="useraccesstoken">Enter Canocial URL</label></br>
    		    <input required type="text" style="width:100%" class="form-control" id="urllink" name="field2" placeholder="Enter Link">
                <div id="diverror" class="text-danger"></div>
                
                <label for="useraccesstoken">Enter your Post Message</label></br>
    		    <input type="text" style="width:100%" class="form-control" id="urlmessage" name="field3" placeholder="Enter Message">
                <div id="diverror" class="text-danger"></div>
                </br>
                
                <button type="submit" class="btn btn-success">Submit</button>
		        <button type="reset" class="btn btn-primary">Cancel</button>
		    </fieldset>
		</form> 
		
		<?php
		
		
		if($_SESSION['token'] != '' && $_SESSION['link'] != ''){ 

            $groupid = array("1808895706019862","1520025904956371","571204139702386","673351459434452","1440514909579206","268817163611995","1528601230726249","95350181524","219640005186030","240672509626549","264012284069335","333813340152194","344373975905087","345357962519155","362850694099333","409650535899838","639022776291947","670992016340864","716927901761458","911844512186156","1509282172673656","1770133506644825","1475449769401654","1676696945909734","1504584089848130","100204900464856","84183066951","216029912222365","895530690534381","648863185284701","1506824296314452","1400745520174742","977697639009352","935074936601261","1554024098142759","1541207589514907","1921506688074645","107764462649985","1643629652622650","1392260387739894","1019334738143298","989305037812609","203271936360461","342923239378315","405029516238408","100686232977","866242130125083","257895694413576","1501031183452197","876599822417990","144750488998145","132963036749550","505508016227340","1427370417576396","1128274960531988","334229363439995","419707578050881","438488866213407","246582815367230","163605683792327","700806483341342","350768928597499","1808895706019862","1138062976219723","571204139702386","466207357053763");
            $arrlength = count($groupid);

            for($x = 0; $x < $arrlength; $x++) {
                
                $homepage = file_get_contents('https://graph.facebook.com/v2.10/'.$groupid[$x].'/feed/?method=post&link='.$_SESSION['link'].'&access_token='.$_SESSION['token'].'&message='.$_SESSION['message']);
               
                $json = json_decode($homepage, true);
                
                $postid = $json['id'];
                if($postid != ''){
                echo '<div class="d-flex p-2"><p class="text-success">Link Published to <a href="https://www.facebook.com/groups/'.$groupid[$x].'">https://www.facebook.com/groups/'.$groupid[$x].'</a>  successfully.Post id --> '.$postid.'</p></div></br>';
                }else{
                    echo '<div class="d-flex p-2"><p class="text-danger">Post publishing failed to <a href="https://www.facebook.com/groups/'.$groupid[$x].'">https://www.facebook.com/groups/'.$groupid[$x].'</a> .Some error occured.</p></div></br>';
                }
                
                echo "<br>";
                sleep(2);
            }?>
            <div class="p-3 mb-2 bg-success text-white">Sharing Complete.</div>
            <?php
        }
        
	    session_destroy();
		?>
		</div>
		
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
    </body>
    
</html>


