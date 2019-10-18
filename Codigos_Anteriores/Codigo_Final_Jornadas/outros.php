<?php
    include("conexao.php");
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
    <!--Tabela Disciplina-->
    <tbody>
        <?php
            require_once("conexao.php");

            $sql="SELECT * from disciplina";
            $resultado=mysqli_query($conexao,$sql);

            if(mysqli_num_rows($resultado)){
                while($linha = mysqli_fetch_assoc($resultado)){
        ?>
        <tr>
            <td><?php echo $linha['id_disciplina'] ?></td>        
            <td><?php echo $linha['descricao'] ?></td>
            <td><?php echo $linha['tipo'] ?></td>
            <th>
                <a class="btn btn-info" href="Disciplina_Editar.php?codigo=<?php echo $linha['id_disciplina']?>"><i class="fas fa-edit"></i>&nbsp; Editar</a>
                <a class="btn btn-danger" href="#"><i class="fas fa-trash"></i>&nbsp; Deletar</a>
            </th>
        </tr>
        <?php
                }
            } 
        ?>
    </tbody>