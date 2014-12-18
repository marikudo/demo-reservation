<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>xhrs - <?=$title?></title>
    <link rel="icon" type="image/png" href="<?=base_url('assets/xhrs/')?>images/logo.png" /> 
    <?php
    $base_path = base_url('assets/xhrs/');
      echo require_css(array(
              $base_path."bootstrap-3.1.1/css/bootstrap.css"
          ));

    ?>
    <style type="text/css">

    html {
      position: relative;
      min-height: 100%;
      padding: 0px;
    }
    body {
      /* Margin bottom by footer height */
      margin-bottom: 60px;
      background-image: url(<?=base_url('assets/xhrs/images/login-background.png')?>);
    }
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here */
      height: 60px;
      background-color: #f5f5f5;
    }


    /* Custom page CSS
    -------------------------------------------------- */
    /* Not required for template or sticky footer method. */

    .container {
      width: auto;
      max-width: 100%;
      padding: 0 15px;
    }

  
    .sidebar {
      display: none;

    }
    @media (min-width: 768px) {
      .sidebar {
        position: fixed;
        bottom: 0;
        left: 0;
        z-index: 1000;
        display: block;
        padding: 20px;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        /*background-color: #f5f5f5;*/
        border-right: 1px solid #eee;
        background: #fff;
        height: 100%
      }
    }

    .main {
      padding: 20px;
    }
    .btn-getstarted {
       display: none;
      }
    @media (max-width: 763px) {
      .btn-getstarted {
       display: block;
      }
    }

     @media (min-width: 768px) {
      .main {
        padding-right: 40px;
        padding-left: 40px;
      }
    }
    .main h1{color: #fff;font-size: 60px}
    .main p{color: #cdbfe3;;font-size: 24px}
    .float-label-control { position: relative; margin-bottom: 1.5em; }
      .float-label-control ::-webkit-input-placeholder { color: transparent; }
      .float-label-control :-moz-placeholder { color: transparent; }
      .float-label-control ::-moz-placeholder { color: transparent; }
      .float-label-control :-ms-input-placeholder { color: transparent; }
      .float-label-control input:-webkit-autofill,
      .float-label-control textarea:-webkit-autofill { background-color: transparent !important; -webkit-box-shadow: 0 0 0 1000px white inset !important; -moz-box-shadow: 0 0 0 1000px white inset !important; box-shadow: 0 0 0 1000px white inset !important; }
      .float-label-control input, .float-label-control textarea, .float-label-control label { font-size: 1.3em; box-shadow: none; -webkit-box-shadow: none; }
          .float-label-control input:focus,
          .float-label-control textarea:focus { box-shadow: none; -webkit-box-shadow: none; border-bottom-width: 2px; padding-bottom: 0; }
          .float-label-control textarea:focus { padding-bottom: 4px; }
      .float-label-control input, .float-label-control textarea { display: block; width: 100%; padding: 0.1em 0em 1px 0em; border: none; border-radius: 0px; border-bottom: 1px solid #aaa; outline: none; margin: 0px; background: none; }
      .float-label-control textarea { padding: 0.1em 0em 5px 0em; }
      .float-label-control label { position: absolute; font-weight: normal; top: -1.0em; left: 0.08em; color: #aaaaaa; z-index: -1; font-size: 0.85em; -moz-animation: float-labels 300ms none ease-out; -webkit-animation: float-labels 300ms none ease-out; -o-animation: float-labels 300ms none ease-out; -ms-animation: float-labels 300ms none ease-out; -khtml-animation: float-labels 300ms none ease-out; animation: float-labels 300ms none ease-out; /* There is a bug sometimes pausing the animation. This avoids that.*/ animation-play-state: running !important; -webkit-animation-play-state: running !important; }
      .float-label-control input.empty + label,
      .float-label-control textarea.empty + label { top: 0.1em; font-size: 1.5em; animation: none; -webkit-animation: none; }
      .float-label-control input:not(.empty) + label,
      .float-label-control textarea:not(.empty) + label { z-index: 1; }
      .float-label-control input:not(.empty):focus + label,
      .float-label-control textarea:not(.empty):focus + label { color: #aaaaaa; }
      .float-label-control.label-bottom label { -moz-animation: float-labels-bottom 300ms none ease-out; -webkit-animation: float-labels-bottom 300ms none ease-out; -o-animation: float-labels-bottom 300ms none ease-out; -ms-animation: float-labels-bottom 300ms none ease-out; -khtml-animation: float-labels-bottom 300ms none ease-out; animation: float-labels-bottom 300ms none ease-out; }
      .float-label-control.label-bottom input:not(.empty) + label,
      .float-label-control.label-bottom textarea:not(.empty) + label { top: 3em; }
      .modified-txtbox{border-bottom: 1px solid #eee!important}
      .login{padding-top: 20px}
      .forgot-pass-content{text-align: right}
    </style>
  </head>
  <body>
    
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3 col-md-3 sidebar">
           <?php
            require $notlogin.EXT;
           ?>
           
          </div>

          <div class="col-sm-7 col-sm-offset-4 col-md-9 col-md-offset-3 main">
            <h1 class="page-header">Hotel Reservation System<br />Hotel Felicidad</h1>
            <p>Manage easily your rates for your property.</p>
            <input type="button" class="btn btn-lg btn-getstarted" value="Get started now">
         
          </div>
        </div>
        </div>
    </div>
  
 
  </body>
</html>