<?php
    if(isset($_POST['submeter'])){
        registar();
    }

    function filtraEntrada($dado){
        //remove espacoes no inicio e
        //no final da string
        $dado=trim($dado);

        //remove contra barras:
        // "cobra d\'agua" vira "cobra d'agua"
        $dado= stripslashes($dado);
        $dado=htmlspecialchars($dado);
        return $dado;
    }
    
    function upload_imagem(){
        $upload_dir='uploads/';

        //Upload de Imagem
        $imgName=$_FILES['userImage']['name'];
        $imgTmp=$_FILES['userImage']['tmp_name'];
        $imgSize=$_FILES['userImage']['size'];

        if(!empty($imgName)){
            //Pegando a Extensao da imagem
            $imgExt=strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
            //Todas extensoes
            $allowExt=array('jpeg','jpg','png', 'gif');
            //Gerando um nome aleatorio para a imagem
            $userPic = time().'_'.rand(1000,9999).'.'.$imgExt;
            //Verificando a validade da imagem
            if(in_array($imgExt,$allowExt)){
                //Verificando o tamanho da imagem
                if($imgSize < 5000000){
                    move_uploaded_file($imgTmp ,$upload_dir.$userPic); 
                }
            }
        }
        return $userPic;
    }

    function registar(){
        require_once("conexao.php");
        $img=upload_imagem();

        $codigo=filtraEntrada($_POST['codigo']);
        $nome=filtraEntrada($_POST['nome']);
        

        //Query para Insercao
        $sql="INSERT INTO candidato(nome,imagem) values(?,?)";

        //Preparando a Consulta
        $stmt=$conexao->prepare($sql);

    
        //Associacao dos parametros (bind)
        if(!$stmt->bind_param('ss',$nome,$img)){
            echo "Erro de parametros: (" .$stmt->errno . ")" . $stmt->error; 
        }
       
        //Execucao
        if(!$stmt->execute()){
            echo "Erro de execucao: (" . $stmt->errno . ") " . $stmt->error;
        }

        $conexao->close();
        
    }
?>