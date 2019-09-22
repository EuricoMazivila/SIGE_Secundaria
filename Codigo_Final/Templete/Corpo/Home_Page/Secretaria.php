<div class="row">
    <ol class="breadcrumb col-12">
        <li><a href="index.php">Home</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="row mt-3">

      <div class="col-lg-3 col-md-1 col-sm-1 offset-2">
        <div class="card first card-icon-bg card-icon-bg-primary o-hidden mb-4">
          <div class="card-body text-center">
            <i class="fa fa-user"></i>
            <div class="content">
              <p class="text-muted mt-2 mb-0">Alunos Matriculados</p>
              <p class="text-primary text-24 line-height-1 mb-2">3005</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-1 col-sm-1">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
          <div class="card-body text-center">
            <i class="fa fa-book-open"></i>
            <div class="content">
              <p class="text-muted mt-2 mb-0">Total Turmas</p>
              <p class="text-primary text-24 line-height-1 mb-2">45</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-1 col-sm-1">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
          <div class="card-body text-center">
            <i class="fa fa-users"></i>
            <div class="content">
              <p class="text-muted mt-2 mb-0">Total Professores</p>
              <p class="text-primary text-24 line-height-1 mb-2">205</p>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class = "row mt-2">
      <div class="col-md-10 offset-md-1">
          <div id="containerCol" style=""></div>
            <script src="../../_js/Grafico_colorido.js"></script>
      </div>
  </div>

  <div class = "row mt-4">
      <div class="col-md-4 offset-md-1">
          <div>
            <div class="card ">
        <div class="card-body card">
            <h4 class="card-title">Recent Messages</h4>
            <div class="message-box card">
                <div class="message-widget">
                    <!-- Message -->
                    <a href="#">
                        <div class="user-img"> <img src="../assets/images/users/1.jpg img-circle"> <span class="profile-status online float-right"></span> </div>
                        <div class="mail-contnet">
                            <h5>Pavan kumar</h5> <span class="mail-desc">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been.</span> <span class="time">9:30 AM</span> </div>
                    </a>
                                        <!-- Message -->
                    <a href="#">
                        <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy float-right"></span> </div>
                        <div class="mail-contnet">
                            <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                    </a>
                                        <!-- Message -->
                    <a href="#">
                        <div class="user-img"> <span class="round">A</span> <span class="float-right"></span> </div>
                        <div class="mail-contnet">
                            <h5>Arijit Sinh</h5> <span class="mail-desc">Simply dummy text of the printing and typesetting industry.</span> <span class="time">9:08 AM</span> </div>
                    </a>
                                        <!-- Message -->
                </div>
            </div>
        </div>
    </div>
          </div>
            
      </div>
      <div class="col-md-6">
          <div id="containerG" style=""></div>
            <script src="../../_js/Grafico_BarrasSec.js"></script>
      </div>
       
  </div>
</div>
