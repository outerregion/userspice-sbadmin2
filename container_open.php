
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once($abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/assets/functions/themenav.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            <a id="page-top"></a>
<?PHP if(Input::get('dashboard')!="true") { ?>            
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
<?PHP if(isset($user) && $user->isLoggedIn()) { ?>

                    <!-- Topbar Search 
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>-->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                       <?php /* <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
*/ ?>
                        <!-- Nav Item - Messages -->
                        
                        <?php 
                        /*Check if messages plugin is installed*/
                            if($settings->messaging == 1){
                                $id = $user->data()->id;
                                $unread = Input::get('unread');
                            /* Count the Unread messages*/
                            $findUnreadtop = $db->query("SELECT * FROM messages WHERE msg_to = '$id' AND msg_read != 1 AND deleted = 0");
                            $myUnreadcount = $findUnreadtop->count();

                            /* Get the last 5 messages, with unread first.*/
                                $top5messages = $db->query("SELECT messages.*, message_threads.* FROM messages INNER JOIN message_threads ON messages.id = message_threads.id WHERE messages.msg_to = '$id' AND messages.deleted = 0 AND message_threads.hidden_to != '$id' ORDER BY messages.msg_read ASC, message_threads.last_update DESC LIMIT 5");
?>
                          <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <?php echo "<span class=\"badge badge-danger badge-counter\">$myUnreadcount</span>";?>     
                            </a>
                              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                  Messages Quick View
                                </h6>
                                   <?php $weirdcount = 0;
                                foreach ($top5messages->results() as $messagetop) {
                                    $msubject = $messagetop->msg_subject; $mbody = substr($messagetop->msg_body,9,-10); $mfromid = $messagetop->msg_from; /*$mfromuser = ;*/ $messageid = $messagetop->id;
                                    if ($messagetop->msg_read != 1) {$munreads = "<b>"; $munreade = "</b>"; } else {$munreads = ""; $munreade = "";}
                                    
                                   
?>

                                  <a class="dropdown-item d-flex align-items-center" href="<?=$us_url_root?>users/message.php?id=<?php echo $messageid;?>">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/img/undraw_profile_1.svg"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate"><?php echo"$munreads $msubject $munreade"; ?> <br><?php echo"$munreads $mbody $munreade"; ?></div>
                                        <div class="small text-gray-500"><?php echouser($mfromid);?></div>
                                    </div>
                                </a>
                             <?php } ?>
                                <a class="dropdown-item text-center small text-gray-500" href="<?=$us_url_root?>users/messages.php">Read More Messages</a>
                            </div>
                        </li>
                            <?php } /*Closes the messages check*/?>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$user->data()->fname . " " . $user->data()->lname;?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="users/user_settings.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                 
                                <?php if (checkMenu(2,$user->data()->id)){  //Links for permission level 2 (default admin) ?>
                                <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?=$us_url_root?>users/admin.php"><i class="fa fa-fw fa-cogs"></i> Admin Dashboard</a>
        <a class="dropdown-item" href="<?=$us_url_root?>users/admin.php?view=users"><i class="fa fa-fw fa-user"></i> User Management</a>
        <a class="dropdown-item" href="<?=$us_url_root?>users/admin.php?view=permissions"><i class="fa fa-fw fa-lock"></i> Page Permissions</a>
        <a class="dropdown-item" href="<?=$us_url_root?>users/admin.php?view=pages"><i class="fa fa-fw fa-wrench"></i> Page Management</a>
        <?php if($settings->messaging == 1){?><a class="dropdown-item" href="<?=$us_url_root?>users/admin.php?view=messages"><i class="fa fa-fw fa-envelope"></i> Message System</a><?php } ?>
        <a class="dropdown-item" href="<?=$us_url_root?>users/admin.php?view=logs"><i class="fa fa-fw fa-search"></i> System Logs</a>
          <?php } // is user an admin ?>
                                
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
<?PHP } ?>
                </nav>
<?PHP } // End of dashboard disabled nav ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class='container-fluid'>
