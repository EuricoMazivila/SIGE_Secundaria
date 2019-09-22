<div class="row">
    <ol class="breadcrumb col-12">
        <li><a href="index.php">Home</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="col-md-12">  <!--div para parte central -->

    <div class="row mt-3">

      <div class="col-lg-3 col-md-1 col-sm-1 offset-2">
        <div class="card first card-icon-bg card-icon-bg-primary o-hidden mb-4">
          <div class="card-body text-center">
            <i class="fa fa-user"></i>
            <div class="content">
              <p class="text-muted mt-2 mb-0">Alunos Diurno</p>
              <p class="text-primary text-24 line-height-1 mb-2">205</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-1 col-sm-1">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
          <div class="card-body text-center">
            <i class="fa fa-book-open"></i>
            <div class="content">
              <p class="text-muted mt-2 mb-0">Total Professores</p>
              <p class="text-primary text-24 line-height-1 mb-2">205</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-1 col-sm-1">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
          <div class="card-body text-center">
            <i class="fa fa-users"></i>
            <div class="content">
              <p class="text-muted mt-2 mb-0">Alunos Noturno</p>
              <p class="text-primary text-24 line-height-1 mb-2">205</p>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class = "row">

      <div class="col-md-8 offset-md-1">
        <div id="containerB" style=""></div>
        <script src="../../_js/Grafico_Barras1.js"></script>
      </div>

      <div class="col-md-3">
        <div id="containerP" style=""></div>
        <script src="../../_js/Grafico_Pizza.js"></script>
      </div>


    </div>

    <div class = "row mt-3">

      <div class="col-md-1"></div>
      <div class="col-md-4">
                       <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Recent Notification</h4>
                                <div class="message-box">
                                    <div class="message-widget">
                                        <!-- Message -->
                                        <a href="#" class="my1">
                                            <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online float-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Ricardo Manhice</h5> <span class="mail-desc">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been.</span> <span class="time">9:30 AM</span> </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="my1">
                                            <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy float-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Bubu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="my1">
                                            <div class="user-img"> <span class="round">A</span> <span class="profile-status away float-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Arijit Sinh</h5> <span class="mail-desc">Simply dummy text of the printing and typesetting industry.</span> <span class="time">9:08 AM</span> </div>
                                        </a>
                                        
                                        <!-- Message -->
                                    </div>
                                </div>
                            </div>
                        </div>
      </div>
      <div class="col-md-7">
          
          <div id="containerT" style=""></div>
            <script src="../../_js/Grafico_barras_.js"></script>
          </div>
      </div>
  </div>

  <div class="row">
   
  </div>  
</div>