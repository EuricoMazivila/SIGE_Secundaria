<?php
    if(isset($_POST[''])){

    }

    //Validacao dos dados Preenchidos em Campos de formulario 
    function filtraEntrada($conexao,$dado){
        //remove espacoes no inicio e
        //no final da string
        $dado=trim($dado);

        //remove contra barras:
        // "cobra d\'agua" vira "cobra d'agua"
        $dado= stripslashes($dado);
        $dado=htmlspecialchars($dado);
        
        //Remove caracteres que um hacker possa ter 
        //inserido para invadir ou alterar o banco de dados
        $dado=$conexao->real_escape_string($dado);

        return $dado;
    }     

    //Upload de Imagem
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

   //Funcao Matricular Novo Aluno
  //  function matricular_aluno(){
        require_once("conexao.php");
        
        //Estágio 1: Preparação
        $query="Call addAluno_matriculado(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";               
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        //Pessoa        
        $apelido=filtraEntrada($conexao,$_POST['apelido']);
        $nomes=filtraEntrada($conexao,$_POST['nome']);
        $pais_nas=filtraEntrada($conexao,$_POST['pais_nas']);
        $provincia_nas=filtraEntrada($conexao,$_POST['provincia_nas']);
        $distrito_nas=filtraEntrada($conexao,$_POST['distrito_nas']);
        $data_nascimento=filtraEntrada($conexao,$_POST['data_nas']);
        $bi=filtraEntrada($conexao,$_POST['nrBI']);
        $local_emissao=filtraEntrada($conexao,$_POST['local_em']);
        $data_em=filtraEntrada($conexao,$_POST['dataEmissao']);
        $sexo=filtraEntrada($conexao,$_POST['sexo']);
        $estado_civil=filtraEntrada($conexao,$_POST['estado_Civil']);
        
        $provincia_res=filtraEntrada($conexao,$_POST['provincia_res']);
        $distrito_res=filtraEntrada($conexao,$_POST['distrito_res']);
        $av_ou_rua=filtraEntrada($conexao,$_POST['avenida']);
        $bairro=filtraEntrada($conexao,$_POST['bairro_res']);
        $quarteirao=filtraEntrada($conexao,$_POST['quarteirao_res']);
        $nr_casa=filtraEntrada($conexao,$_POST['nrCasa_res']);
        $numero_tf=filtraEntrada($conexao,$_POST['nr_Tell']);
        $email=filtraEntrada($conexao,$_POST['email']);
        $foto=upload_imagem();

        $nome_pai=filtraEntrada($conexao,$_POST['nomePai']);
        $telefone_pai=filtraEntrada($conexao,$_POST['telefonePai']);
        $local_trabalho_pai=filtraEntrada($conexao,$_POST['localTrabPai']);
        $profissao_pai=filtraEntrada($conexao,$_POST['profissaoPai']);
        $nome_mae=filtraEntrada($conexao,$_POST['nomeMae']);
        $telefone_mae=filtraEntrada($conexao,$_POST['telefoneMae']);
        $local_trabalho_mae=filtraEntrada($conexao,$_POST['localTrabMae']);
        $profissao_mae=filtraEntrada($conexao,$_POST['profissaoMae']);
       
        $nome_enc=filtraEntrada($conexao,$_POST['nomeEnc']);
        $numero_tf_enc=filtraEntrada($conexao,$_POST['telefoneEnc']);
        $provincia_enc=filtraEntrada($conexao,$_POST['provinciaEnc']);
        $distrito_enc=filtraEntrada($conexao,$_POST['distritoEnc']);
        $bairro_enc=filtraEntrada($conexao,$_POST['moradaEnc']);
        $av_ou_rua_enc=filtraEntrada($conexao,$_POST['av_rua_enc']);
        $local_trab_enc=filtraEntrada($conexao,$_POST['localTrabEnc']);
        $profissao_enc=filtraEntrada($conexao,$_POST['profissaoEnc']);
        
        $classe_matr=filtraEntrada($conexao,$_POST['classe_m']);

        $ensino=filtraEntrada($conexao,$_POST['ensino']);
        $nome_escola=filtraEntrada($conexao,$_POST['escolaAnte']);
        $classe_anter=filtraEntrada($conexao,$_POST['classeAnte']);
        $turma_anter=filtraEntrada($conexao,$_POST['turmaAnte']);
        $numero_anter=filtraEntrada($conexao,$_POST['numeroAnte']);
        $ano=filtraEntrada($conexao,$_POST['ano']);

       // $foto=filtraEntrada($conexao,$_POST['']);
        
        //Aluno
        
        echo " Apelido ".$apelido. "<br/><br/>";
        echo " Nomes ".$nomes. "<br/><br/>";
        echo "Data de Nascimento ".$data_nascimento. "<br/><br/>";
        echo "Pais de Nascimento ".$pais_nas. "<br/><br/>";
        echo "Provincia de Nascimento ".$provincia_nas. "<br/><br/>";
        echo "Distrito de Nascimento ".$distrito_nas. "<br/><br/>";
        echo "BI ".$bi. "<br/><br/>";
        echo "Local de Emissao ".$local_emissao. "<br/><br/>";
        echo "Data de emissao ".$data_em. "<br/><br/>";
        echo "Sexo ".$sexo. "<br/><br/>";
        echo " Estado civil ".$estado_civil. "<br/><br/>";
        echo "Numero de telefone ".$numero_tf. "<br/><br/>";
        echo "Email ".$email. "<br/><br/>";
        echo "Provincia de Residencia ".$provincia_res. "<br/><br/>";
        echo "Distrito de Residencia ".$distrito_res. "<br/><br/>";
        echo "Bairro de Residencia ".$bairro. "<br/><br/>";
        echo "Av ou Rua ".$av_ou_rua. "<br/><br/>";
        echo "Quarteirao ".$quarteirao. "<br/><br/>";
        echo "Nr de Casa ".$nr_casa. "<br/><br/>";
       // $foto=filtraEntrada($conexao,$_POST['']);
       $foto=2323232;
       echo "Foto ".$foto. "<br/><br/>";
        //Aluno
        echo "Provincia de Encarregado ".$provincia_enc. "<br/><br/>";
        echo "Distrito de Encarregado ".$distrito_enc. "<br/><br/>";
        echo "Bairro de Encarregado ".$bairro_enc. "<br/><br/>";
        echo "Av ou rua de Encarregado ".$av_ou_rua_enc. "<br/><br/>";
        echo "Nome do Encarregado ".$nome_enc. "<br/><br/>";
        echo "Numero de Telefone Encarregado ".$numero_tf_enc. "<br/><br/>";
        echo "Local de Trabalho Encarregado ".$local_trab_enc. "<br/><br/>";
        echo "Profissao de Encarregado ".$profissao_enc. "<br/><br/>";
        echo "Nome do Pai ".$nome_pai. "<br/><br/>";
        echo "Nome da mae ".$nome_mae. "<br/><br/>";
        echo "Telefone do pai ".$telefone_pai. "<br/><br/>";
        echo "Telefone da Mae ".$telefone_mae. "<br/><br/>";
        echo "Profissao do pai ".$profissao_pai. "<br/><br/>";
        echo "Profissao da Mae ".$profissao_mae. "<br/><br/>";
        echo "Local de Trabalho do Pai ".$local_trabalho_pai. "<br/><br/>";
        echo "Local de Trabalho da Mae ".$local_trabalho_mae. "<br/><br/>";
        echo "Classe a matricular ".$classe_matr. "<br/><br/>";
        echo "Ensino ".$ensino. "<br/><br/>";
        echo "Nome da escola ".$nome_escola. "<br/><br/>";
        echo "Escola Anterior ".$classe_anter. "<br/><br/>";
        echo "Turma Anterior ".$turma_anter. "<br/><br/>";
        echo "Numero Anterior ".$numero_anter. "<br/><br/>";
        echo "Ano ".$ano. "<br/><br/>";


        // Estágio 2: Associação dos parâmetros (bind)
        $bind=$stmt->bind_param("ssssssssssssssssiisisisssisssisssssssssssii", 
        $apelido,$nomes,$pais_nas,$provincia_nas,$distrito_nas, 
        $data_nascimento,$bi,$local_emissao,$data_em,$sexo,$estado_civil,
        $provincia_res,$distrito_res,$bairro,$av_ou_rua,$quarteirao,$nr_casa,
        $numero_tf,$email,$foto,$nome_pai,$telefone_pai,$local_trabalho_pai,
        $profissao_pai,$nome_mae,$telefone_mae,$local_trabalho_mae,$profissao_mae,
        $nome_enc,$numero_tf_enc,$provincia_enc,$distrito_enc,$bairro_enc,
        $av_ou_rua_enc,$local_trab_enc,$profissao_enc,$classe_matr,
        $ensino,$nome_escola,$classe_anter,$turma_anter,$numero_anter,$ano);

        if(!$bind){
            echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
        }

        // Estágio 3: execução
        if(!$stmt->execute()){
            echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
        }else{
            echo "Registado Com Sucesso";   
            header("Location: ../Login_Pre_Matricula.php");
        }   

        $stmt->close();
        $conexao->close();
  // }
?>