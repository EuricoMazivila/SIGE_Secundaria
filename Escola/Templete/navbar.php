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
            <?php
                    echo $_SESSION['nome_Escola'];
                   ?>
                <!--icone de bell -->
                <i class="fas fa-bell i-tamanho "></i>
            </span>

            <span class="i-color-white i-tamanho">
<<<<<<< HEAD
                <!--icone de envelope  -->
                <i class="fas fa-envelope i-tamanho"></i>
=======
            <input type="submit" value="Sair">
>>>>>>> 54c6479eed1f40639d268178fe5ea6b56e6139c5
            </span>
        </div>
        <form action="Dao\sair.php" method="post">
        <div class="navbar-left form-group">
       
            <select class="form-control" id="controloUser" name="controloUser">
                <option>
                    <?php
                    echo $_SESSION['nome_usuario'];
                   ?>
                </option>
                <option>Sobre nos</option>
                <option></option>
            </select>
<<<<<<< HEAD
            <input type="submit" value="Sair">
=======
            
>>>>>>> 54c6479eed1f40639d268178fe5ea6b56e6139c5

        </div>
        </form>
        
    </nav>
</div>
<script>
$('#controloUser').change(function () {
    var idProv = $(this).val();
    alert("DadoAtual"+idProv);
    if(idProv=="Sair")
    alert("Tem a Certeza");
    <?php
    session_abort();
    //header('Location: LoginGeral.php');
    
    ?>
    //   $.post('url', name:post);
   /* $.post('php/busca_dados.php',
        { idProv: idProv }, function (data) {
            //retorna as opcoes da busca no banco de dados
            $('#distrito').html(data);
        });*/
});
</script>
