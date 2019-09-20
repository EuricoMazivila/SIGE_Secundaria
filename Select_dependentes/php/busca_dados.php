<?php
//Busca Bairros
if(isset($_POST['iddistrito'])){
    busca_bairro();
}
//Busca Distrito
if(isset($_POST['idProv'])){
    busca_distito();
}
//Busca Provincias
if(isset($_POST['idPais'])){
    busca_provincia();
}
//Busca Pais
if(isset($_POST['iddistritodd'])){
    busca_pais();
}

if(isset($_POST['pesquisarTabela'])){
    busca_pessoaP();
}
    
function busca_distito(){
    include('conexao.php');
    $id_prov=$_POST['idProv'];

    if($id_prov!=''){
        $query= 'SELECT id_Distrito,Nome FROM `distrito`WHERE id_Prov='.$id_prov.' order by Nome';
        $executar= mysqli_query($conexao, $query);
        $num= mysqli_num_rows($executar);
        if($num>0){
            echo ' <option value="" selected>Seleciona o Distito </option>';
            while($linha=mysqli_fetch_assoc($executar)){
                   echo	'<option value="'.$linha['id_Distrito'].'">'.$linha['Nome'].'</option>';
                }
            }else{
             echo ' <option value="">Sem Distritos Para essa Provincia </option>';;
    }
    }else{
        echo 'Vazio';
    }
}
function busca_bairro(){
    include('conexao.php');
    $id_Distrito=$_POST['iddistrito'];
    if($id_Distrito!=''){
        $query= 'SELECT id_Bairro,Nome FROM `bairro` WHERE id_Distrito='.$id_Distrito.' ORDER BY Nome';
        $executar= mysqli_query($conexao, $query);
        $num= mysqli_num_rows($executar);
        if($num>0){
            echo ' <option value=""selected>Seleciona o Bairro </option>';
            while($linha=mysqli_fetch_assoc($executar)){
                   echo	'<option value="'.$linha['id_Bairro'].'">'.$linha['Nome'].'</option>';
                }
            }else{
             echo ' <option value="">Sem Bairros Para esse Distrito </option>';;
    }
    }else{
        echo 'Vazio';
    }
}
function busca_provincia(){
    include('conexao.php');
    $id_pais=$_POST['idPais'];
    if($id_pais!=''){
        $query= 'SELECT id_Prov,Nome FROM `provincia` WHERE id_Pais='.$id_pais.' order by Nome';
        $executar= mysqli_query($conexao, $query);
        $num= mysqli_num_rows($executar);
        echo 'Chegou';
       /* if($num>0){
            echo ' <option value="" selected>Seleciona a Provincia </option>';
            while($linha=mysqli_fetch_assoc($executar)){
                   echo	'<option value="'.$linha['id_Prov'].'">'.$linha['Nome'].'</option>';
                }
            }else{
            echo 'Dados nao encotrados';
    }
    }else{
        echo 'Vazio';
    }  */ 
}
}
function busca_pais(){
    include_once('consultas.php');
	$sql='SELECT * FROM `pais` ORDER by Nome';
	//metodo que faz a busca dos dados
	$resultado=busca($sql);
	if($resultado->num_rows>0){ //verifica o numero de linhas
		while($linha=mysqli_fetch_array($resultado)){
		echo	'<option value="'.$linha['id'].'">'.$linha['Nome'].'</option>';
	}}
}

function busca_pessoa(){
    include_once('consultas.php');
  
    $sql= 'SELECT id_Pessoa, Apelido, Nome, Data_Nascimento FROM `pessoa` order by Nome';
    $resultado=busca($sql);
	if($resultado->num_rows>0){
         //verifica o numero de linhas
         echo '<thead>
         <tr>
             <th>Codigo</th>
             <th>Nome Completo</th>
             <th>Data</th>
         </tr>
     </thead>
     <tbody>';
		while($linha=mysqli_fetch_array($resultado)){
            echo '<tr>
                    <td>'.$linha['id_Pessoa'].'</td>
                    <td>'.$linha['Nome'].' '.$linha['Apelido'].'</td>
                    <td>'.$linha['Data_Nascimento'].'</td>
                </tr>';
        }
        echo "</tbody>";
    }
        
    
}

function busca_pessoaP(){
    include('conexao.php');
    $pesq='%'.$_POST['pesquisarTabela'].'%';
    $sql= "SELECT id_Pessoa, Apelido, Nome, Data_Nascimento FROM `pessoa` WHERE id_Pessoa like '$pesq' or `Apelido` LIKE '$pesq' or Nome LIKE '$pesq' order by Nome";
    $executar= mysqli_query($conexao, $sql);
        $num= mysqli_num_rows($executar);
        if($num>0){
            echo '<thead>
            <tr>
                <th>Codigo</th>
                <th>Nome Completo</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>';
		while($linha=mysqli_fetch_assoc($executar)){
            echo '<tr>
                    <td>'.$linha['id_Pessoa'].'</td>
                    <td>'.$linha['Nome'].' '.$linha['Apelido'].'</td>
                    <td>'.$linha['Data_Nascimento'].'</td>
                </tr>';
        }
        echo "</tbody>";
    }else{
            echo 'Sem resultados Para Pesquisa '.$_POST['pesquisarTabela'];
        }
       
        

    
}
?>