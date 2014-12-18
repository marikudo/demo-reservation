<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--     <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>xhrs - <?=$title?></title>
    <link rel="icon" type="image/png" href="<?=base_url('assets/xhrs/')?>images/logo.png" />
      <?php
      //REQUIRE CSS
      $base_path = base_url('assets/xhrs/');
      echo require_css(array(
              $base_path."bootstrap-3.1.1/css/bootstrap.css",
              $base_path."font-awesome-4.2.0/css/font-awesome.css",
              $base_path."xhrs.css",
/*              $base_path."nanoscroller/nanoscroller.css",*/
              $base_path."datatables/datatables.css",
              $base_path."datatables/jquery.dataTables_themeroller.css",

              $base_path."bootstrap-select/bootstrap-select.min.css",
              $base_path."bootstrap-select/bootstrap-select.min.css",
              $base_path."bootstrap-modal/bootstrap-modal.css",
              $base_path."bootstrap-modal/bootstrap-modal-bs3patch.css",
              $base_path."bootstrap-datepicker-ui/bootstrap-datepicker.min.css",
              $base_path."fullcalendar/fullcalendar.css"


          ));

      echo  require_js(array(
              $base_path."js/jquery-1.11.1.min.js",
              $base_path."js/jquery.form.js",
/*              $base_path."nanoscroller/jquery.nanoscroller.js",*/
              $base_path."bootstrap-3.1.1/bootstrap.js",
              $base_path."slimscoller/jquery.slimscroll.min.js",
              $base_path."ckeditor_4.4.3_2cdcc5dbd4cb/ckeditor.js",
              $base_path."bootstrap-datepicker-ui/bootstrap-datepicker.min.js",
              $base_path."jlayout/jquery.sizes.js",
              $base_path."jlayout/jlayout.grid.js",
              $base_path."jlayout/jlayout.flexgrid.js",
              $base_path."jlayout/jlayout.flow.js",
              $base_path."jlayout/jlayout.border.js",
              $base_path."jlayout/jquery.jlayout.js",
              $base_path."fullcalendar/moment.min.js",
              $base_path."fullcalendar/fullcalendar.min.js",
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

          }

      .north, .south, .west, .east, .center {
        display: inline-block;
      }
      .center{
        overflow-y:scroll;
        overflow-x:hidden;
      }
      .north {
        height: 51px!important;
      }

     .west {
        width: 228px;

      }



      </style>
    <script type="text/javascript" src="<?=base_url()?>assets/xhrs/js/jquery-gridTools.js"></script>
  </head>
  <body data-layout='{"type": "border", "resize": false, "hgap": 6}'>

    <div class="north">
    <div class="navbar navbar-fixed-top navbar-default navbar-cj mynavbar" role="navigation" style="border: none;">
      <div class="container">
         <div class="navbar-brand"><a href="<?=base_url()?>xhrs"><strong>Crackerjack</strong> <small style="font-size: 14px;">Web Services</small></a></div>
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
              <div class="dropdown-menu" style="overflow:hidden;width:400px;padding:10px;padding-top:10px;">
                <h4>Hotel Felicidad Reservation System<br /> <small>Develop by</small></h4>
                <center><img src='<?=base_url('assets/images/logo.png')?>' style="width:50px;"></center>
                <h4>Crackerjack Web Development and Services <br /><small>crackerjackwebdesign.com</small></h4>

              </div>
            </li>
          </ul>

        </div>
       <ul class="nav navbar-nav navbar-right account-settings-toogle" style="margin-right:17px">
            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" style="padding-top:17px;" data-toggle="dropdown"><?=$user['email']?> <i class="fa fa-user"></i> <b class="caret"></b></a>


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
    <div data-layout='{"type": "grid", "columns": 1, "resize": false}' class="west left-side">
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
                                       $isInside = '';
                                       $isInsidex = '';
                                       foreach ($display['sub'] as $subDispaly) {
                                        $xy = explode('/', $subDispaly['_url']);
                                          if (getController()==str_replace("-","_",$xy[0])) {
                                              $isInside = 'collapsed';
                                              $isInsidex = 'in';
                                              break;
                                          }
                                       }
                              echo '<li class="'.$active.' panel dropdown">';
                              echo '<a href="#'.$display['_url'].'_btn_dropdown" id="'.$display['_url'].'_btn" data-toggle="collapse" data-parent="#menu-bar" class="dropdown-toggle '.$isInside.'"><i class="'.$a.'"></i> <span>'.$display['module'].'</span> <b class="caret pull-right" style="margin-top:10px"></b></a>';
                              echo '<ul class="panel-collapse collapse '.$isInsidex.'"  id="'.$display['_url'].'_btn_dropdown">';
                                      foreach ($display['sub'] as $subDispaly) {
                                        $ab = ($subDispaly['_icon']=="") ? 'fa fa-file-text' : $subDispaly['_icon'];
                                        $xy = explode('/', $subDispaly['_url']);
                                        $active = (getController()==str_replace("-","_",$xy[0])) ? 'active' : null;
                                       echo '<li class="'.$active.'"><a href="'.base_url('xhrs/'.$subDispaly['_url']).'"><i class="'.$ab.'"></i> '.$subDispaly['module'].'</a></li>';
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
