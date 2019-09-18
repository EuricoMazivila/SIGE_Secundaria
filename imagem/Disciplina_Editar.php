<?php
    include("conexao.php");
    $upload_dir='uploads/';
    if(isset($_GET['codigo'])){
        $codigo=$_GET['codigo'];
        $sql="SELECT * FROM candidato where codigo=".$codigo;
        $resultado=mysqli_query($conexao,$sql);
        if(mysqli_num_rows($resultado)>0){
            $linha=mysqli_fetch_assoc($resultado);
            print_r($linha);
        }else{
            echo "Erro";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Css de Bootstrap-->
    <link rel="stylesheet" href="bootstrap/_css/bootstrap.css" >
    
    <!--Css de Fileinput-->
    <link rel="stylesheet" href="fileinput/css/fileinput.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <script src="fontawesome/js/all.js"></script>
    <title>Upload de Imagens usando Jquery e Ajax</title>
</head>
<body>
    
    <div class="col-md-5 col-sm-5 col-md-offset-4 col-sm-offset-4">
        <div class="page-header">
            <h3>Upload Image</h3>
        </div> 
        <form method="POST" action="processa.php" enctype="multipart/form-data" id="uploadImageForma">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 mt-5">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <label for="inputCodigo">Codigo</label>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <input type="text" class="form-control" name="codigo" value="<?php echo $linha['codigo']; ?>" id="inputCodigo">
                    </div>
                </div>
            </div>

            <div class="form-group col-xs-12 col-sm-6 col-md-6 mt-6">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <label for="inputNivel">Nome da Disciplina</label>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <input type="text" class="form-control" name="nome" value="<?php echo $linha['nome']; ?>" id="inputNivel">        
                    </div>
                </div> 
            </div>
            
            <div class="form-group">
                <label for="input">File Input</label>
                <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
                <div class="col-sm-4 text-center">
                    <div class="kv-avatar">
                        <div class="file-loading">
                            <input id="avatar-2" name="userImage" value="<?php echo $linha['imagem'];?>" type="file" required>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success" name="update"> <i class="fas fa-save"></i> &nbsp; Submeter</button>

        </form>

    </div>        
<!--Javascript de Jquery-->
<script src="jquery/jquery.js"></script>

<!--Javascript de Bootstrap-->
<script src="bootstrap/_js/bootstrap.js"></script>

<!--Javascript de FileInput-->
<script src="fileinput/js/fileinput.js"></script>

<!-- the fileinput plugin initialization -->
<script >
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="fas fa-tag"></i>' +
        '</button>'; 
        
    $("#avatar-2").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        browseOnZoneClick: true,
        removeLabel: '',
        removeIcon: '<i class="fas fa-trash"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-2',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="uploads/default-Avatar.jpg" alt="Your Avatar"><h6 class="text-muted">Click to select</h6>',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpeg","jpg", "png", "gif"]
    });
</script>

<script src="fileinput/js/plugins/piexif.min.js"><script>
<script src="fileinput/js/plugins/purify.min.js"><script>
<script src="fileinput/js/plugins/sortable.min.js"><script>

</body>
</html>