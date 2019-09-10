<div class="fixed-top bg-nav">
    <div>
        <button class="btn-menu bg-nav menu-sm">
            <i class="fa fa-bars fa-lg"></i></button>
    </div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header navbar-right">
            <a class="navbar-brand h1 mb-0" href="#">SIGE</a>
        </div>

        <div class="navbar-center">
        <select class="form-control" id="controloUser" name="controloUser">
                <option>
                    <?php
                           echo  $_SESSION['nome_usuario'];
                   ?>
                </option>
                <option>Sobre nos</option>
                <option></option>
            </select>
            
            
            
  

            </div>
            <a class="btn" href="LoginGeral.php">
                <span class="i-color-white i-tamanho" id="logout">
                    Sair
            </span>
                </a>

        
    </nav>
</div>