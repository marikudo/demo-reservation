<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--     <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>xhrs - <?=$title?></title>
      <?php
      //REQUIRE CSS
      $base_path = base_url('assets/xhrs/');
      echo require_css(array(
              $base_path."bootstrap-3.1.1/css/bootstrap.css",
              $base_path."font-awesome-4.2.0/css/font-awesome.css",
              $base_path."xhrs.css",
/*              $base_path."nanoscroller/nanoscroller.css",*/
              $base_path."datatables/datatables.css",

              $base_path."bootstrap-select/bootstrap-select.min.css",
              $base_path."bootstrap-select/bootstrap-select.min.css",
              $base_path."bootstrap-modal/bootstrap-modal.css",
              $base_path."bootstrap-modal/bootstrap-modal-bs3patch.css",
              $base_path."bootstrap-datepicker/eternicode/css/datepicker3.css",


          ));

      echo  require_js(array(
              $base_path."js/jquery-1.11.1.min.js",
              $base_path."js/jquery.form.js",
/*              $base_path."nanoscroller/jquery.nanoscroller.js",*/
              $base_path."bootstrap-3.1.1/bootstrap.js",
              $base_path."slimscoller/jquery.slimscroll.min.js",
              $base_path."ckeditor_4.4.3_2cdcc5dbd4cb/ckeditor.js",
              $base_path."bootstrap-datepicker/eternicode/js/bootstrap-datepicker.js",
              $base_path."jlayout/jquery.sizes.js",
              $base_path."jlayout/jlayout.grid.js",
              $base_path."jlayout/jlayout.flexgrid.js",
              $base_path."jlayout/jlayout.flow.js",
              $base_path."jlayout/jlayout.border.js",
              $base_path."jlayout/jquery.jlayout.js",
              ));

              //$base_path."bootstrap-live/scripts/innovaeditor.js",
              //$base_path."bootstrap-live/scripts/innovamanager.js",
              //$base_path."bootstrap-live/scripts/common/webfont.js",
      ?>

      <style type="text/css">
        html, body {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        overflow: hidden;
        font-size: 0.9em;
        font-family: Verdana, Arial, sans-serif;
      }

      .north, .south, .west, .east, .center {
        display: inline-block;
        background-color: #F8F8F8;
      }

      .north {
        height: 52px!important;
        background-color: #3F3F3F;
        border-bottom: 1px solid black;
      }

      .south {
        height: 2em;
        background-color: #3F3F3F;
        border-top: 1px solid black;
        font-size: 0.65em;
        color: rgb(200, 200, 200);
        padding: 0.5em 2em;
      }

      .east {
        width: 25em;
        height: 100%;
        font-size: 0.78em;
      }

      .west {
        width: 228px;
        font-size: 0.78em;
      }

       .west .panel {
        width: 15em;
        display: inline-block;
        overflow: auto;
      }



      </style>
    <script type="text/javascript" src="<?=base_url()?>assets/xhrs/js/jquery-gridTools.js"></script>
  </head>
  <body data-layout='{"type": "border", "resize": false, "hgap": 6}'>

    <div class="north">
    <div class="navbar navbar-fixed-top navbar-default navbar-cj mynavbar" role="navigation">
      <div class="container">
         <div class="navbar-brand"></div>
        <div class="navbar-left navbar-cj-product"><h4>Hotel Reservations System</h4></div>
        <div class="navbar-header navbar-left developer-toggle">

          <ul class="nav navbar-nav ">
            <li class="dropdown">
              <button type="button" class="dropdown-toggle navbar-toggle" data-toggle="dropdown" style="display:block">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar xconBar"></span>
                <span class="icon-bar xconBar"></span>
                <span class="icon-bar xconBar"></span>
              </button>
              <div class="dropdown-menu" style="overflow:hidden;width:250px;padding:10px;padding-top:10px;">
                <h4>Hotel Felicidad Reservation System <small>Develop by</small></h4>
                <center><img src='<?=base_url('assets/images/logo.png')?>' style="width:50px;"></center>
                <h4>Crackerjack Web Development and Services <br /><small>crackerjackwebdesign.com</small></h4>

              </div>
            </li>
          </ul>

        </div>
       <ul class="nav navbar-nav navbar-right account-settings-toogle">
            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$user['email']?> <i class="fa fa-user"></i> <b class="caret"></b></a>


             <ul class="dropdown-menu" role="menu" aria-labelledby="user-dropdown">
                        <li><a href="<?=base_url('xhrs/account')?>">&nbsp;<i class="fa fa-info"></i>&nbsp; My Account Information</a></li>
                        <li><a href="<?=base_url('xhrs/account/settings')?>"><i class="fa fa-gear"></i> Account Settings</a></li>

                        <li class="divider"></li>
                        <li><a href="<?=base_url('xhrs/home/logout')?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                      </ul>
            </li>
          </ul>

      </div>
    </div>
    </div>
    <div data-layout='{"type": "grid", "columns": 1, "resize": false}' class="west">
         <div class="slim" id="nano_scroll">

                <ul class="nav nav-list" id="menu-bar">
                <?php
                  //print_pre($user['navigation']);

                    foreach ($user['navigation'] as $show) {

                        if(count($show)>=2){
                          echo '<li class="nav-header">'.$show['label'].'</li>';
                            unset($show['label']);
                            foreach ($show as $display) {
                              $a = ($display['_icon']=="") ? 'fa fa-file-text' : $display['_icon'];
                                 $x = explode('/', $display['_url']);
                                // echo getController();
                              $active = (getController()==str_replace("-","_",$x[0])) ? 'active' : null;
                              if ($display['parent_id']==0) {

                                    if (isset($display['sub'])) {
                              echo '<li class="'.$active.' panel dropdown">';
                              echo '<a href="#'.$display['_url'].'_btn_dropdown" id="'.$display['_url'].'_btn" data-toggle="collapse" data-parent="#menu-bar" class="dropdown-toggle"><i class="'.$a.'"></i> <span>'.$display['module'].'</span> <b class="caret pull-right" style="margin-top:10px"></b></a>';
                              echo '<ul class="panel-collapse collapse"  id="'.$display['_url'].'_btn_dropdown">';
                                      foreach ($display['sub'] as $subDispaly) {
                                        $ab = ($subDispaly['_icon']=="") ? 'fa fa-file-text' : $subDispaly['_icon'];
                                       echo '<li><a href="'.base_url('xhrs/'.$subDispaly['_url']).'"><i class="'.$ab.'"></i> '.$subDispaly['module'].'</a></li>';
                                      }
                               echo '</ul>';

                                      }else{
                              echo '<li class="'.$active.'">';
                              echo '<a href="'.base_url('xhrs/'.$display['_url']).'" ><i class="'.$a.'"></i> <span>'.$display['module'].'</span> </a>';

                                      }


                              echo '</li>';

                              }

                            }
                        }

                    }
                ?>
              </ul>

        </div>
    </div>
    <div class="center">

    </div>

    <script type="text/javascript">
        jQuery(function($) {
        var container = $('body'),
          west = $('body > .west'),
          east = $('body > .east'),
          center = $('body > .center');


        function layout() {
          container.layout();
        }

        // Lay out the west panel first
        west.layout();

        // Then do the main layout.
        layout();

        // Hook up the re-layout to the window resize event.
        $(window).resize(layout);
      });
    </script>

      <?php
      $base_path = base_url('assets/xhrs/');
        echo require_js(array(
              /*JQUERY VALIDATE*/
              $base_path."jquery.validate/jquery.validate.js",
              //$base_path."jquery.validate/jquery.maskedinput.min.js",
              $base_path."jquery.validate/jquery.form.js",
              $base_path."jquery.validate/jquery.alphanumeric.js",

              /*DATATABLES*/
              $base_path."datatables/js/datatables.js",
              $base_path."datatables/js/dataTables.bootstrap.js",
              $base_path."datatables/js/dataTables.xhrs.js",
              $base_path."datatables/js/dataTables.fixedColumns.js",
              $base_path."datatables/js/TableTools.js",
              $base_path."datatables/js/jquery.dataTables.columnFilter.js",
              $base_path."datatables/js/ZeroClipboard.js",
              $base_path."bootstrap-select/bootstrap-select.min.js",

             $base_path."js/tooltip.js",
              $base_path."js/jquery.functions.js",

          ));

    ?>
      </body>
</html>