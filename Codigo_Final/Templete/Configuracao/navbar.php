<div class="fixed-top bg-nav bottom-margin">
    <div>
        <button class="btn-menu bg-nav menu-sm">
            <i class="fa fa-bars fa-lg"></i></button>
    </div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header navbar-right mb-3">
            <a class="navbar-brand h1 mb-0" href="#">SIGE</a>
        </div>
        <div>
            <span class="i-color-white i-tamanho ">
                <!--icone de bell -->
                <i class="fas fa-bell md-2"></i>
            </span>

            <span class="i-color-white i-tamanho ">
                <!--icone de envelope  -->
                <i class="fas fa-envelope"></i>
            </span>
            <span class="i-color-white">
                
            </span>
        </div>
   

            <div class="usermov">      
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown- text-muted" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="../../uploads/call-nerds.png" alt="user" class="profile-pic"></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <ul class="dropdown-user">
                            <li>
                              <div class="dw-user-box">
                                <div class="u-img"><img src="../../uploads/call-nerds.png" alt="user"></div>
                                <div class="u-text">
                                  <h6><?php echo $usuario; ?></h6>
                                    <h3 class="text-muted vee"><?php echo $email;?></h3>

                                </div>
                              </div>
                            </li>
                            <p class="espa" align="center"><?php echo $local;?></p>
                            <li role="separator" class="divider"></li>

                            <li><a href="#"><i class=" fas fa-user-circle ti-user"></i> My Profile</a></li>
                             <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="fas fa-cogs o ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="fas fa-power-off ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="fas fa-power-off"></i> Logout</a></li>
                          </ul>
                      </div>
                </li>  
            </div>
    </nav>
</div>

