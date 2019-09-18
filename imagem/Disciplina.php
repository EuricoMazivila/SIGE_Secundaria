<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testando o Bootstrap 4</title>
    <link rel="stylesheet" href="bootstrap/_css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <script src="fontawesome/js/all.js"></script>
    <script src="bootstrap/_js/bootstrap.js"></script>
    <script src="jquery/_js/jquery.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/i.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Connect</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container">
    <div class="page-header">
        <a class="btn btn-success offset-6 mt-5" href="img.php">
            <i class="fas fa-plus"></i> &nbsp; Nova
        </a>
        
        <div class="table-responsive">
            <table class="table table-bordered col-sm-10 mt-5">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nome</th>
                        <th>Imagem</th>
                        <th>Acção</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("conexao.php");
                        $upload_dir='uploads/';

                        $sql="SELECT * from candidato";
                        $resultado=mysqli_query($conexao,$sql);

                        if(mysqli_num_rows($resultado)){
                            while($linha = mysqli_fetch_assoc($resultado)){
                    ?>
                    <tr>
                        <td><?php echo $linha['codigo'] ?></td>
                        <td><?php echo $linha['nome'] ?></td>
                        <td><img src="<?php echo $upload_dir.$linha['imagem']?>" height="40"></td>
                        <th>
                            <a class="btn btn-info" href="Disciplina_Editar.php?codigo=<?php echo $linha['codigo']?>"><i class="fas fa-edit"></i>&nbsp; Editar</a>
                            <a class="btn btn-danger" href="#"><i class="fas fa-trash"></i>&nbsp; Deletar</a>
                        </th>
                    </tr>
                    <?php
                            }
                        } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!--footer-->
<div class="conatiner-fluid padding">
    <div class="row text-center">
        <div class="col-12">
            <hr class="light">
            <h1>&copy; Euro</h1>
        </div>
    </div>
</div>

</body>
</html>