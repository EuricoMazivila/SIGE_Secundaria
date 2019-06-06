<?php
    include_once("../Model/Aluno.php");
    include_once("conexao.php");

    //Introduzindo dados no objecto aluno
    $aluno=new Aluno();
    $aluno->setApelido();//Recebe o Apelido
    $aluno->setNomes();
    $aluno->setPaisnascimento();
    $aluno->setProvincianascimento();
    $aluno->setDistritonascimento();
    $aluno->setDatanascimento();
    $aluno->setSexo();
    $aluno->setSofreDoenca();
    $aluno->setQual();
    $aluno->setTelefone();

    
    


    


?>