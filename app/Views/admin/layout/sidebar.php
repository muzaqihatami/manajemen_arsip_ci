<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!--CSS-->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title><?= $title; ?></title>
</head>
<body>
    <div class="sidebar">
        <div class="container">
            <div class="sidebarheader">
                <div class="row">
                    <div class="col-md-2">
                        <img src="/assets/image/logo_dashboard.png" class="sidebar-logo">
                    </div>
                    <div class="col-md-10">
                        <h4>Manajemen Arsip</h4>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu-list">
              <div class="sidebar-content">
                <ul class="sidebarlist">
                    <li class="sidebarrow mb-4">
                        <a class="sidebar-menu-link" href="/dashboard">
                            <div id="menu-home" class="row">
                                <div class="col-md-2">
                                    <img id="logo-home" src="/assets/image/logo_home.png" class="sidebar-icon sidebar-menu-logo">
                                </div>
                                <div class="col-md-10">
                                    <p id="logo-home-text" class="sidebar-menu-text">Dashboard</p>
                                </div>
                            </div>
                        </a>
                    </li> 
                    <li class="sidebarrow mb-4">
                        <a class="sidebar-menu-link" href="/surat/masuk">
                            <div class="row">
                                <div class="col-md-2">
                                    <img id="logo-sm" src="/assets/image/logo_surat.png" class="sidebar-icon sidebar-menu-logo-surat">
                                </div>
                                <div class="col-md-10">
                                    <p id="logo-sm-text" class="sidebar-menu-text">Surat Masuk</p>
                                </div>
                            </div>
                        </a>
                    </li> 
                    <li class="sidebarrow mb-4">
                        <div class="row" data-bs-toggle="collapse" href="#dropskmenu" role="button">
                            <div class="col-md-2">
                                <img id="logo-sk" src="/assets/image/logo_surat.png" class="sidebar-icon sidebar-menu-logo-surat">
                            </div>
                            <div class="col-md-10">
                                <p id="logo-sk-text" class="sidebar-menu-text">Surat Keluar</p>
                            </div>
                        </div>
                    </li> 
                    <li id="dropskmenu" class="collapse sidebarrow mb-5">
                        <div class="sidebar-menu-sk-section">
                            <div class="mb-3">
                                <a href="/surat/keluar/permintaan" class="sidebar-menu-sk">Permintaan</a>
                            </div>
                            <div>
                                <a href="/surat/keluar" class="sidebar-menu-sk">Arsip</a>
                            </div>
                        </div>
                    </li> 
                    <li class="sidebarrow mb-4">
                        <a class="sidebar-menu-link" href="/agenda/surat-masuk">
                            <div class="row">
                                <div class="col-md-2">
                                    <img id="logo-ag-sm" src="/assets/image/logo_agenda.png" class="sidebar-icon sidebar-menu-logo-agenda">
                                </div>
                                <div class="col-md-10">
                                    <p id="logo-ag-sm-text" class="sidebar-menu-text">Agenda Surat Masuk</p>
                                </div>
                            </div>
                        </a>
                    </li> 
                    <li class="sidebarrow mb-4">
                        <a class="sidebar-menu-link" href="/agenda/surat-keluar">
                            <div class="row">
                                <div class="col-md-2">
                                    <img id="logo-ag-sk" src="/assets/image/logo_agenda.png" class="sidebar-icon sidebar-menu-logo-agenda">
                                </div>
                                <div class="col-md-10">
                                    <p id="logo-ag-sk-text" class="sidebar-menu-text">Agenda Surat Keluar</p>
                                </div>
                            </div>
                        </a>
                    </li> 
                    <li class="sidebarrow mb-4">
                        <a class="sidebar-menu-link" href="/kategori">
                            <div class="row">
                                <div class="col-md-2">
                                    <img id="logo-kat" src="/assets/image/logo_kategori.png" class="sidebar-icon sidebar-menu-logo-kat">
                                </div>
                                <div class="col-md-10">
                                    <p id="logo-kat-text" class="sidebar-menu-text">Kategori</p>
                                </div>
                            </div>
                        </a>
                    </li> 
                </ul>
              </div>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2><?= $page_title; ?></h2>
                    <?php 
                    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                    $uri_segments = explode('/', $uri_path);
                    if ($uri_segments[1] == "kategori" && isset($uri_segments[2])) { ?>
                        <h5>Kategori : <?php echo $uri_segments[2] ?></h5>
                    <?php }   ?>
                </div>
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-md-9 header-name-section">
                            <p>Hi,</p>
                            <p class="header-name"><?= $admin_name; ?></p>
                        </div>
                        <div class="col-md-3">
                            <img src="/assets/image/icon_acc.png" class="header-logo-acc">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
