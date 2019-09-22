<?php
    if(isset($_POST['concluir'])){
        require_once("conexao.php");
       echo 'Apelido: '.$apelido=filtraEntrada($conexao,$_POST['apelido']).'<br><br>';
       echo 'Nomes: '.$nomes=filtraEntrada($conexao,$_POST['nome']).'<br><br>';
       echo 'Pais Nascimento: '.$pais_nas=filtraEntrada($conexao,$_POST['pais_nas']).'<br><br>';
       echo 'Provincia Nascimento: '.$provincia_nas=filtraEntrada($conexao,$_POST['provincia_nas']).'<br><br>';
       echo 'Destrito Nascimento: '.$distrito_nas=filtraEntrada($conexao,$_POST['distrito_nas']).'<br><br>';
       echo 'Data Nascimento: '.$data_nascimento=filtraEntrada($conexao,$_POST['data_nas']).'<br><br>';
       echo 'BI: '.$bi=filtraEntrada($conexao,$_POST['nrBI']).'<br><br>';
       echo 'Local de Emissao: '.$local_emissao=filtraEntrada($conexao,$_POST['local_em']).'<br><br>';
       echo 'Data de Emissao: '.$data_em=filtraEntrada($conexao,$_POST['dataEmissao']).'<br><br>';
       echo 'Sexo: '.$sexo=filtraEntrada($conexao,$_POST['sexo']).'<br><br>';
       echo 'Estado Civil: '.$estado_civil=filtraEntrada($conexao,$_POST['estado_Civil']).'<br><br>';
        
       echo 'Provincia de Residencia: '.$provincia_res=filtraEntrada($conexao,$_POST['provincia_res']).'<br><br>';
       echo 'Distrito de Residencia: '.$distrito_res=filtraEntrada($conexao,$_POST['distrito_res']).'<br><br>';
       echo 'Bairro de Residencia: '.$bairro=filtraEntrada($conexao,$_POST['bairro_res']).'<br><br>';
       echo 'Av_ou_rua: '.$av_ou_rua=filtraEntrada($conexao,$_POST['avenida']).'<br><br>';
       echo 'Quarteirao: '.$quarteirao=filtraEntrada($conexao,$_POST['quarteirao_res']).'<br><br>';
       echo 'Nr_Casa: '.$nr_casa=filtraEntrada($conexao,$_POST['nrCasa_res']).'<br><br>';
       echo 'Numero_Telefone: '.$numero_tf=filtraEntrada($conexao,$_POST['nr_Tell']).'<br><br>';
       echo 'Email: '.$email=filtraEntrada($conexao,$_POST['email']).'<br><br>';

       echo 'Nome Pai: '.$nome_pai=filtraEntrada($conexao,$_POST['nomePai']).'<br><br>';
       echo 'Telefone do Pai: '.$telefone_pai=filtraEntrada($conexao,$_POST['telefonePai']).'<br><br>';
       echo 'Local de Trabalho do Pai: '.$local_trabalho_pai=filtraEntrada($conexao,$_POST['localTrabPai']).'<br><br>';
       echo 'Profissao do Pai: '.$profissao_pai=filtraEntrada($conexao,$_POST['profissaoPai']).'<br><br>';
       echo 'Nome Mae: '.$nome_mae=filtraEntrada($conexao,$_POST['nomeMae']).'<br><br>';
       echo 'Telefne Mae: '.$telefone_mae=filtraEntrada($conexao,$_POST['telefoneMae']).'<br><br>';
       echo 'Local de Trabalho Mae: '.$local_trabalho_mae=filtraEntrada($conexao,$_POST['localTrabMae']).'<br><br>';
       echo 'Profissao Mae: '.$profissao_mae=filtraEntrada($conexao,$_POST['profissaoMae']).'<br><br>';
       
        echo 'Nome encarregado: '.$nome_enc=filtraEntrada($conexao,$_POST['nomeEnc']).'<br><br>';
        echo 'Numero Telefone encarregado: '.$numero_tf_enc=filtraEntrada($conexao,$_POST['telefoneEnc']).'<br><br>';
        echo 'Provincia de Encarregado: '.$provincia_enc=filtraEntrada($conexao,$_POST['provinciaEnc']).'<br><br>';
        echo 'Distrito Encarregado: '.$distrito_enc=filtraEntrada($conexao,$_POST['distritoEnc']).'<br><br>';
        echo 'Bairro encarregado: '.$bairro_enc=filtraEntrada($conexao,$_POST['moradaEnc']).'<br><br>';
        echo 'Av ou rua de encarregado: '.$av_ou_rua_enc=filtraEntrada($conexao,$_POST['av_rua_enc']).'<br><br>';
        echo 'Local de Trabalho Encarregado: '.$local_trab_enc=filtraEntrada($conexao,$_POST['localTrabEnc']).'<br><br>';
        echo 'Profissao Encarregado '.$profissao_enc=filtraEntrada($conexao,$_POST['profissaoEnc']).'<br><br>';
        
       // echo 'Foto: '.$foto=upload_imagem();
        matricular_aluno();
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
        $upload_dir='../uploads/';

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
    function matricular_aluno(){
        include("conexao.php");
        
        //Estágio 1: Preparação
        //`;
//$query="Call addAluno_matriculado(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $query=" SELECT `Regista_Candidato_Matricula_Escola`(?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) AS `Regista_Candidato_Matricula_Escola";               
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        //Pessoa  
        $id_candidato=filtraEntrada($conexao,$_POST['id_candidado']);
        $id_escola=filtraEntrada($conexao,$_POST['id_escola']);      
        $apelido=filtraEntrada($conexao,$_POST['apelido']);
        $nomes=filtraEntrada($conexao,$_POST['nome']);
        $pais_nas=filtraEntrada($conexao,$_POST['pais_nas']);
        $provincia_nas=filtraEntrada($conexao,$_POST['provincia_nas']);
        $distrito_nas=filtraEntrada($conexao,$_POST['distrito_nas']);
        $data_nascimento=filtraEntrada($conexao,$_POST['data_nas']);
        $_tipoBi=filtraEntrada($conexao,$_POST['_tipoBi']);
        $bi=filtraEntrada($conexao,$_POST['nrBI']);
        $local_emissao=filtraEntrada($conexao,$_POST['local_em']);
        $data_em=filtraEntrada($conexao,$_POST['dataEmissao']);
        $sexo=filtraEntrada($conexao,$_POST['sexo']);
        $estado_civil=filtraEntrada($conexao,$_POST['estado_Civil']);
        
        $provincia_res=filtraEntrada($conexao,$_POST['provincia_res']);
        $distrito_res=filtraEntrada($conexao,$_POST['distrito_res']);
        $bairro=filtraEntrada($conexao,$_POST['bairro_res']);
        $av_ou_rua=filtraEntrada($conexao,$_POST['avenida']);
        $quarteirao=filtraEntrada($conexao,$_POST['quarteirao_res']);
        $nr_casa=filtraEntrada($conexao,$_POST['nrCasa_res']);
        $numero_tf=filtraEntrada($conexao,$_POST['nr_Tell']);
        $email=filtraEntrada($conexao,$_POST['email']);

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
        
        $foto=upload_imagem();
        $bind=$stmt->bind_param('issssssssssisiisisisssissssssisi',$id_escola,$id_candidato,$nomes,$apelido,$sexo,$estado_civil,$data_nascimento,$_tipoBi,$bi,
        $data_em,$local_emissao,$bairro,$av_ou_rua,$quarteirao,$nr_casa,$email,$numero_tf,$nome_pai,$telefone_pai,$local_trabalho_pai,
        $profissao_pai,$nome_mae,$telefone_mae,$local_trabalho_mae,$profissao_mae,$nome_enc,$numero_tf_enc,$local_trab_enc,$profissao_enc,$bairro_enc,$av_ou_rua_enc,$distrito_nas);

       // $foto=filtraEntrada($conexao,$_POST['']);
        
        //Aluno
        /*
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
        */
        if(!$bind){
            echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
        }
        
        // Estágio 3: execução
        if(!$stmt->execute()){
            echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
        }else{
            $res=$stmt->get_result();
        if(!$res){
            echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
        }

        $linhas=$res->num_rows;
            if($linhas>0){
            for($j=0; $j<$linhas; ++$j){
                $res->data_seek($j);
                $linha=$res->fetch_assoc();
            
            echo $linha['Regista_Candidato_Matricula_Escola'];
           }
            
        }
            echo "Registado Com Sucesso";   
          //  header("Location: ../Templete/corpo/corpoReverDados.php");
        }   

        $stmt->close();
        $conexao->close();
   }
?>