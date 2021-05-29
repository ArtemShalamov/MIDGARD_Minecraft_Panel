<?php
global $user_status;
function authentication ($user, $pass){
    global $wp, $wp_rewrite, $wp_the_query, $wp_query;
  
    if(empty($user) || empty($pass)){
      return false;
    } else {
      require_once('./wp-blog-header.php');
      $status = false;
      $auth = wp_authenticate($user, $pass );
      if( is_wp_error($auth) ) {      
        $status = [false, null];
      } else {
        $status = [true, $auth];
      }
      $user_status = $status;
      return $status;
    } 
}
if ($_POST["username"] != null && $_POST["password"] != null){
    $resp = authentication($_POST["username"], $_POST["password"]);
    if ($resp[0]) {
        echo '
        <!DOCTYPE html>
        <html lang="ru">
        
        <head>
            <meta charset="utf-8" />
            <link rel="icon" type="image/png" href="../assets/img/logo_alpha.png">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <title>MIDGARD | Изменение профиля</title>
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
            <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
            <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
            <link href="../assets/css/demo.css" rel="stylesheet" />

            <link rel="stylesheet" href="assets/skin_3d/minecraft-skinviewer.css">
        </head>
        
        <body>
            <div class="wrapper">
                <div class="sidebar">
                    <div class="sidebar-wrapper">
                        <div class="logo">
                            <a href="http://www.creative-tim.com" class="simple-text">
                                <img style="width: 50%; margin-bottom: 10px" src="../assets/img/logo.png"> <br> Изменение профиля
                            </a>
                        </div>
                        <ul class="nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="./user.html">
                                    <i class="nc-icon nc-circle-09"></i>
                                    <p>Профиль</p>
                                </a>
                            </li>
                            <li class="nav-item active active-pro">
                                <a class="nav-link active" href="https://midgardrp.ru" target="_blank">
                                    <i class="nc-icon nc-alien-33"></i>
                                    <p>На сайт</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-panel">
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                                <ul class="navbar-nav ml-auto">
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" href="#pablo">
                                            <span class="no-icon">Поделиться профилем</span>
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="/mclogin.html">
                                            <span class="no-icon">Выход</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Профиль</h4>
                                        </div>
                                        <div class="card-body">
                                        
                                            <form>
                                                <div class="row">
                                                    <div class="col pr-1">
                                                        <div class="form-group">
                                                            <label>Электронная почта</label>';
                                                            echo '<input type="text" class="form-control" disabled="" placeholder="Company" value="' . $resp[1]->user_email . '">';
                                                        echo '</div>
                                                    </div>
                                                    <div class="col px-1">
                                                        <div class="form-group">
                                                            <label>Ник</label>';
                                                            echo '<input type="text" class="form-control" disabled="" placeholder="Ваш ник" value="' . $resp[1]->user_login . '">';
                                                        echo '</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 pr-1">
                                                        <div class="form-group">
                                                            <label>Отображаемое имя</label>';
                                                            echo '<input type="text" class="form-control" disabled="" placeholder="Отображаемое имя." value="' . $resp[1]->display_name . '">';
                                                        echo '</div>
                                                    </div>
                                                    <div class="col-md-6 pl-1">
                                                        <div class="form-group">
                                                            <label>Дата регистрации</label>';
                                                            echo '<input type="text" class="form-control" disabled="" placeholder="Last Name" value="' . $resp[1]->user_registered . '">';
                                                        echo '</div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Изменение скина</h4>
                                        </div>
                                        <div class="card-body">';
                                            echo '<form enctype="multipart/form-data" action="/minecraftprofilelogin_handler.php" method="POST">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Загрузка скина</label>
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
					                                        <input type="hidden" name="USERNAME" value="' . $resp[1]->user_login . '">
                                                            <input name="skin" type="file" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Загрузка плаща (пока не доступно)</label>
                                                            <input type="file" class="form-control" disabled="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-info btn-fill pull-right">Сохранить</button>
                                                <div class="clearfix"></div>
                                            </form>';
                                        echo '</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-user">
                                        <div class="card-image"></div>
                                        <div class="card-body">
                                            <div class="author">';
                                                echo '<a target="_blank" href="https://midgardrp.ru/view.php?user=' . $resp[1]->user_login . '&mode=3">';
                                                    echo '<img class="avatar border-gray" src="https://midgardrp.ru/view.php?user=' . $resp[1]->user_login . '&mode=3" alt="...">';
                                                    echo '<h5 style="margin-bottom: 35px;" class="title">' . $resp[1]->user_login . '</h5>';
                                                echo '</a>
                                            </div>

                                            <style>';
                                                echo '#skin-viewer *{ background-image: url(https://midgardrp.ru/minecraft/skins/' . $resp[1]->user_login . '.png); }';
                                            echo '</style>

                                            <!-- ############################################################## -->
                                            <!-- Skin Viewer HTML Elements -->
                                            <!-- ############################################################## -->
                                            <div id="skin-viewer" class="mc-skin-viewer-11x spin">
                                                <div class="player">
                                                    <!-- Head -->
                                                    <div class="head" >
                                                        <div class="top"></div>
                                                        <div class="left"></div>
                                                        <div class="front"></div>
                                                        <div class="right"></div>
                                                        <div class="back"></div>
                                                        <div class="bottom"></div>
                                                        <div class="accessory">
                                                            <div class="top"></div>
                                                            <div class="left"></div>
                                                            <div class="front"></div>
                                                            <div class="right"></div>
                                                            <div class="back"></div>
                                                            <div class="bottom"></div>
                                                        </div>
                                                    </div>
                                                    <!-- Body -->
                                                    <div class="body">
                                                        <div class="top"></div>
                                                        <div class="left"></div>
                                                        <div class="front"></div>
                                                        <div class="right"></div>
                                                        <div class="back"></div>
                                                        <div class="bottom"></div>
                                                        <div class="accessory">
                                                            <div class="top"></div>
                                                            <div class="left"></div>
                                                            <div class="front"></div>
                                                            <div class="right"></div>
                                                            <div class="back"></div>
                                                            <div class="bottom"></div>
                                                        </div>
                                                    </div>
                                                    <!-- Left Arm -->
                                                    <div class="left-arm">
                                                        <div class="top"></div>
                                                        <div class="left"></div>
                                                        <div class="front"></div>
                                                        <div class="right"></div>
                                                        <div class="back"></div>
                                                        <div class="bottom"></div>
                                                        <div class="accessory">
                                                            <div class="top"></div>
                                                            <div class="left"></div>
                                                            <div class="front"></div>
                                                            <div class="right"></div>
                                                            <div class="back"></div>
                                                            <div class="bottom"></div>
                                                        </div>
                                                    </div>
                                                    <!-- Right Arm -->
                                                    <div class="right-arm">
                                                        <div class="top"></div>
                                                        <div class="left"></div>
                                                        <div class="front"></div>
                                                        <div class="right"></div>
                                                        <div class="back"></div>
                                                        <div class="bottom"></div>
                                                        <div class="accessory">
                                                            <div class="top"></div>
                                                            <div class="left"></div>
                                                            <div class="front"></div>
                                                            <div class="right"></div>
                                                            <div class="back"></div>
                                                            <div class="bottom"></div>
                                                        </div>
                                                    </div>
                                                    <!-- Left Leg -->
                                                    <div class="left-leg">
                                                        <div class="top"></div>
                                                        <div class="left"></div>
                                                        <div class="front"></div>
                                                        <div class="right"></div>
                                                        <div class="back"></div>
                                                        <div class="bottom"></div>
                                                        <div class="accessory">
                                                            <div class="top"></div>
                                                            <div class="left"></div>
                                                            <div class="front"></div>
                                                            <div class="right"></div>
                                                            <div class="back"></div>
                                                            <div class="bottom"></div>
                                                        </div>
                                                    </div>
                                                    <!-- Right Leg -->
                                                    <div class="right-leg">
                                                        <div class="top"></div>
                                                        <div class="left"></div>
                                                        <div class="front"></div>
                                                        <div class="right"></div>
                                                        <div class="back"></div>
                                                        <div class="bottom"></div>
                                                        <div class="accessory">
                                                            <div class="top"></div>
                                                            <div class="left"></div>
                                                            <div class="front"></div>
                                                            <div class="right"></div>
                                                            <div class="back"></div>
                                                            <div class="bottom"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="footer">
                        <div class="container-fluid">
                            <nav>
                                <ul class="footer-menu">
                                    <li>
                                        <a href="user.html">
                                            Профиль
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://midgardrp.ru">
                                            На сайт
                                        </a>
                                    </li>
                                </ul>
                                <p class="copyright text-center">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                    <a href="https://midgardrp.ru">MIDGARD</a>
                                </p>
                            </nav>
                        </div>
                    </footer>
                </div>
            </div>
            <div class="fixed-plugin">
        </body>
        <!--   Core JS Files   -->
        <script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
        <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
        <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
        <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
        <script src="../assets/js/plugins/bootstrap-switch.js"></script>
        <!--  Google Maps Plugin    -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!--  Chartist Plugin  -->
        <script src="../assets/js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="../assets/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
        <script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
        </html> ';
    }
    else 
    {
        echo 'Неверный логин или пароль! <a href="/mclogin.html">Повтор.</a> <a href="/">На главную.</a>';
    }
}
if ($_FILES["skin"] != null)
{
    $uploaddir = './minecraft/skins/';
    $uploadfile = $uploaddir . basename($_POST["USERNAME"] . ".png");
    if (move_uploaded_file($_FILES['skin']['tmp_name'], $uploadfile)){
        echo 'Успех! <a href="login.html">Вход</a>. <a href="/">На главную</a>.';
    }
    else echo 'Ошибка. <a href="/">На главную</a>. <a href="login.html>Вход</a>.';
}
?>