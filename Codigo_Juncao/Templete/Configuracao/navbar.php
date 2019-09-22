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
            <span class="i-color-white i-tamanho">
                <!--icone de bell -->
                <i class="fas fa-bell i-tamanho "></i>
            </span>

            <span class="i-color-white i-tamanho">
                <!--icone de envelope  -->
                <i class="fas fa-envelope i-tamanho"></i>
            </span>
            <span class="i-color-white i-tamanho">
                <?php echo $local;?>
            </span>
        </div>
        <div class="navbar-left form-group">

            <select class="form-control">
                <option><?php echo $usuario; ?></option>
                <option>Sobre nos</option>
                <option>Sair</option>
            </select>

        </div>
    </nav>
</div>