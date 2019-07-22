<div class="row">
    <!--header -->

    <header class="fixed-top">
      <nav class="navbar navbar-expand-lg  bg-nav navbar-light col-md-12" role="navigation">

        <div class="navbar-header">
          <a class="navbar-brand h1 mb-0" href="#">SIGA</a>
        </div>

        <span id="bel">
          <!--icone de bell -->
          <i class="fas fa-bell"></i>
        </span>

        <span id="env">
          <!--icone de envelope  -->
          <i class="fas fa-envelope"></i>
        </span>

        <div class="form-group">
          <select class="form-control">
            <option><?php session_start();
            echo $_SESSION['Tipo'];?> </option>
            <option>Sobre nos</option>
            <option>Sair</option>
          </select>
        </div>
      </nav>
    </header>
  </div>