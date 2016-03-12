<?php
session_start();
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>
    Remindy for <?php if($_SESSION["user_name"]) 
    { echo $_SESSION["user_name"]; }?> 
  </title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"/> 

  <!-- This is for the Calendar Display-->
  <link href="templates/css/fullcalendar.css" rel="stylesheet" />

  <!-- This is personalized configuration for  Calendar Display-->
  <link href="templates/css/preferred.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="templates/css/dashboard.css" rel="stylesheet">

  <!-- JQuery UI is for the Calendar to Popup within a text input -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->


    </head>

    <body>

      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">

          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="#">Remindy User : <?php if($_SESSION["user_name"]) 
              { echo $_SESSION["user_name"]; }?> 
            </a>
          </div>

          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

              <li><a href="#">Settings</a></li>
              <li><a href="#">Profile</a></li>

              <li>    
               <a href="logout.php" title="Logout">Logout 
               </a>
             </li>
           </ul>

           <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>

        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

          <ul class="nav nav-sidebar">
            <li class="active" id="calendar_button"><a href="#">Calendar </a></li>
            
            <li id="backup_button"><a href="#">BackUp Tasks</a></li>
            <li id="restore_button"><a href="#" >Restore Tasks </a></li>
            
          </ul>
          <!-- <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul> -->
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- <h1 class="page-header">Tasks</h1> -->

          <div class="container">
            <div id='calendar'>
            </div>
          </div>

          <div class="submit">
            <button type="button" class="btn btn-primary btn-md">Save</button> 
          </div>



<!-- 
          <div class="row placeholders">

            
            
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          
          </div>

          <h2 class="sub-header">Section title</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                </tr>
              </thead>
              
              <tbody>
                
                <tr>
                  <td>1,001</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>dolor</td>
                  <td>sit</td>
                </tr>
                
                <tr>
                  <td>1,002</td>
                  <td>amet</td>
                  <td>consectetur</td>
                  <td>adipiscing</td>
                  <td>elit</td>
                </tr>
               
                <tr>
                  <td>1,015</td>
                  <td>sodales</td>
                  <td>ligula</td>
                  <td>in</td>
                  <td>libero</td>
                </tr>
              </tbody>

            </table>
          </div> -->
        </div>


      </div>
    </div>

    <!-- SCRIPTS -->

    <script class="cssdesk" src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script class="cssdesk" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js" type="text/javascript"></script>

    <script class="cssdesk" src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.0/js/bootstrap.min.js" type="text/javascript"></script>

    <script class="cssdesk" src="templates/js/fullcalendar.min.js" type="text/javascript"></script>

    <script class="cssdesk" src="templates/js/underscore.min.js" type="text/javascript"></script>

    <script class="cssdesk" src="templates/js/moment.min.js" type="text/javascript"></script>

    <script class="cssdesk" src="templates/js/bootbox.min.js" type="text/javascript"></script>

    <script src="templates/js/holder.min.js"></script>

    <script src="templates/js/user_dashboard_control.js"></script>

    <script type="text/javascript">
      var session_user = "<?php echo $_SESSION['user_name']; ?>";
    </script>
    
    <script src="templates/js/control.js" type="text/javascript"></script>

  </body>

  </html>