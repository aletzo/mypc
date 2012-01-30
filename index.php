<?php 

require_once 'lib/BrowserHelper.php';

$browser = BrowserHelper::getInstance()->getBrowser();

$cookie = setcookie('mypc', 'test');

?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>my pc setup</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="css/style.css">
  <!-- end CSS-->

  <script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

  <div id="container">
    <header>
        <h1>my pc <small>setup</small></h1>
    </header>
    <div id="main" role="main">
        <div class="box">
            <h2>browser size</h2>
            <span id="browser_size">not available [please turn javascript on]</span>
        </div>
        <div class="box">
            <h2>cookies</h2>
            <span><?php echo $cookie === true ? 'allowed' : 'not allowed' ?></span>
        </div>
        <div class="box">
            <h2>ip address</h2>
            <span><?php echo $_SERVER['REMOTE_ADDR'] ?></span>
        </div>
        <div class="box">
            <h2>javascript</h2>
            <span id="javascript">disabled</span>
        </div>
        <div class="box">
            <h2>operating system</h2>
            <span><?php echo $browser['platform'] ?></span>
        </div>
        <div class="box">
            <h2>screen resolution</h2>
            <span id="screen_resolution">not available [please turn javascript on]</span>
        </div>
        <!--div class="box">
            <h2>flash version</h2>
        </div-->
        <div class="box">
            <h2>user agent</h2>
            <span><?php echo $_SERVER['HTTP_USER_AGENT'] ?></span>
        </div>
        <div class="box">
            <h2>web browser</h2>
            <span><?php echo $browser['browser'] ?></span>
        </div>
    </div>
    <footer>

    </footer>
  </div> <!--! end of #container -->


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <script defer src="js/app.js"></script>


  <script>
    window._gaq = [['_setAccount','UA-6990380-2'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>


  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>


