    <div class="container">
        <form method="POST" id="myForm" action="../../Dao/processa_matricular_aluno.php" role="form" data-toggle="validator">
            <br />
            <!-- SmartWizard html -->
            <div id="smartwizard" class="mt-3 offset-1">
                <ul>
                    <li id="stp1"><a class="step" href="#step-1">Dados Pessoais<br><small>Passo 1</small></a></li>
                    <li id="stp2"><a class="step" href="#step-2">Morada<br><small>Passo 2</small></a></li>
                    <li id="stp3"><a class="step" href="#step-3">Filiação<br><small>Passo 3</small></a></li>
                    <li id="stp4"><a class="step" href="#step-4">Encarregado<br><small>Passo 4</small></a></li> 
                    <li id="stp5"><a class="step" href="#step-5">Outros Dados<br><small>Passo 5</small></a></li>  
                </ul>
                <div>
                    <div id="step-1" class="mt-4">
                        <div class="container-fluid padding">
                            <legend class="oculto">Dados Pessoais</legend>
                            <hr class="oculto">
                            <div id="form-step-0" role="form" data-toggle="validator">

                                <!--Primeira Linha-->
                                <div class="row">
                                    <div class="form-group has-feedback col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputSobrenome">Apelido</label>
                                        <?php
                                            include("../../Dao/conexao.php");

                                            $id_user=$_SESSION['id_User'];

                                            //Estágio 1: Preparação
                                            $query="SELECT Apelido from pessoa where id_Pessoa=?";
                                            $stmt=$conexao->prepare($query);
                                            if(!$stmt){
                                                echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
                                            }
                                    
                                            // Estágio 2: Associação dos parâmetros (bind)
                                            $bind=$stmt->bind_param("s",$id_user);
                                            if(!$bind){
                                                echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
                                            }
                                    
                                            // Estágio 3: execução
                                            if(!$stmt->execute()){
                                                echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
                                            }
                                    
                                            // Estágio 4: Obtenção de dados
                                            $res=$stmt->get_result();
                                            if(!$res){
                                                echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
                                            }
                                    
                                            if($res->num_rows){
                                                $linha=$res->fetch_assoc();
                                                echo '<input type="text" name="apelido" id="inputSobrenome" class="form-control" required 
                                                placeholder="Introduza o Apelido" value="'.$linha['Apelido'].'" data-error="Por favor, introduza texto" 
                                                data-pattern-error="Texto invalido. Introduza letras de (3-20) caracteres" 
                                                required pattern="^[a-zA-Z][a-zA-Z-_\.]{2,}$">';
                                            }
                                            $stmt->close();
                                            $conexao->close();
                                        ?>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12  col-sm-12 col-md-4 offset-1">
                                        <label for="inputNome">Outros Nomes</label>
                                        <?php
                                            include("../../Dao/conexao.php");

                                            $id_user=$_SESSION['id_User'];

                                            //Estágio 1: Preparação
                                            $query="SELECT Nome from pessoa where id_Pessoa=?";
                                            $stmt=$conexao->prepare($query);
                                            if(!$stmt){
                                                echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
                                            }
                                    
                                            // Estágio 2: Associação dos parâmetros (bind)
                                            
                                            
                                            $bind=$stmt->bind_param("s",$id_user);
                                            if(!$bind){
                                                echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
                                            }
                                    
                                            // Estágio 3: execução
                                            if(!$stmt->execute()){
                                                echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
                                            }
                                    
                                            // Estágio 4: Obtenção de dados
                                            $res=$stmt->get_result();
                                            if(!$res){
                                                echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
                                            }
                                    
                                            if($res->num_rows){
                                                $linha=$res->fetch_assoc();
                                                echo '<input type="text" name="nome" id="inputNome" class="form-control" 
                                                required data-error="Por favor, introduza texto" 
                                                data-pattern-error="Texto invalido. Introduza letras de a-z (3-20) caracteres" 
                                                required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{3,}$" value="'.$linha['Nome'].'" placeholder="Introduza o Nome">';        
                                            }
                                
                                            $stmt->close();
                                            $conexao->close();
                                        ?>             
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Segunda Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputNacionalidade">Nacionalidade</label>
                                        <select class="form-control" name="pais_nas" id="inputNacionalidade" required placeholder="Seleciona a Nacionalidade">
                                            <option value="">Seleciona a Nacionalidade</option>
                                            <?php 
                                                //require_once("../../Dao/conexao.php"); 
                                                include("../../Dao/conexao.php");
                                                $query="SELECT id_Pais,Nome from pais";
                                                $resultado=$conexao->query($query);
                                                if(!$resultado){
                                                    echo "Erro";
                                                }

                                                $linhas=$resultado->num_rows;   

                                                for($j=0; $j<$linhas; ++$j){
                                                    $resultado->data_seek($j);
                                                    $linha=$resultado->fetch_array(MYSQLI_ASSOC);
                                                    echo '<option value="'.$linha['id_Pais'].'">'.$linha['Nome'].'</option>';
                                                }
                                                
                                                //Fecha a conexao
                                                $resultado->close();
                                                $conexao->close();
                                            ?>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputProvincia">Província de Nascimento</label>
                                        <select class="form-control" name="provincia_nas" id="inputProvincia" required>
                                            <option value="">Seleciona a provincia</option>    
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Terceira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputDistrito">Distrito de Nascimento</label>
                                        <select class="form-control" name="distrito_nas" id="inputDistrito" required placeholder="Seleciona o Distrito">
                                            <option value="">Seleciona o distrito</option> 
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputDataNascimnto"> Data de Nascimento</label>
                                        <input type="date" max="<?php echo (date('Y')-9).'-12-31';?>" data-error="Por favor, introduza data valida" data-pattern-error="Por favor, introduza uma data valida" name="data_nas" id="inputDataNascimnto" name="data_nas"
                                            class="form-control" required maxlength="10">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Quarta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputBI">Tipo de Documento de Identificação</label>
                                        <select class="form-control" name="_tipoBi" id="inputBI" required>
                                            <option value="">Seleciona o Documento de Identificação</option>
                                            <option>BI</option>
                                            <option>Cedula</option>
                                            <option>Carta de conducao</option>
                                            <option>Passaporte</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputBinr">Documento de Identificação Nr</label>
                                        <input type="text" class="form-control" name="nrBI" id="inputBinr" required placeholder="Introduza o nr do documento de identificacao"  data-pattern-error="Por favor, introduza o texto requerido" data-error="Por favor, introduza texto">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Quinta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputArquivo">Arquivo de Identificação</label>
                                        <select class="form-control" name="local_em" id="inputArquivo" required>
                                            <option value="1">Selecione o Arquivo de identificacao</option>
                                            <?php 
                                                include("../../Dao/conexao.php");
                                                $query="SELECT id_Prov,Nome from provincia";
                                                $resultado=$conexao->query($query);
                                                if(!$resultado){
                                                    echo "Erro";
                                                }

                                                $linhas=$resultado->num_rows;   

                                                for($j=0; $j<$linhas; ++$j){
                                                    $resultado->data_seek($j);
                                                    $linha=$resultado->fetch_array(MYSQLI_ASSOC);
                                                    echo '<option value="'.$linha['id_Prov'].'">'.$linha['Nome'].'</option>';
                                                }
                                                
                                                //Fecha a conexao
                                                $resultado->close();
                                                $conexao->close();
                                            ?>   
                                        </select>    
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputDataEm">Data de Emissão</label>
                                        <input type="date" min="<?php echo (date('Y')-9).'-12-31';?>" max="<?php echo (date('Y')).'-12-31';?>" data-error="Por favor, introduza data valida" name="dataEmissao" id="inputDataEm" class="form-control"
                                            required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Sexta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputSexo">Sexo</label>
                                        <select class="form-control" name="sexo" id="inputSexo" required>
                                            <option value="">Seleciona o Sexo</option>
                                            <?php
                                                include("../../Dao/conexao.php");
                                                $id_user=$_SESSION['id_User'];
                                                
                                                //Estágio 1: Preparação
                                                $query="SELECT Nome from pessoa where id_Pessoa=?";
                                                $stmt=$conexao->prepare($query);
                                                if(!$stmt){
                                                    echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
                                                }
                                        
                                                // Estágio 2: Associação dos parâmetros (bind)    
                                                $bind=$stmt->bind_param("s",$id_user);
                                                if(!$bind){
                                                    echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
                                                }
                                        
                                                // Estágio 3: execução
                                                if(!$stmt->execute()){
                                                    echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
                                                }
                                        
                                                // Estágio 4: Obtenção de dados
                                                $res=$stmt->get_result();
                                                if(!$res){
                                                    echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
                                                }
                                        
                                                if($res->num_rows){
                                                    $linha=$res->fetch_assoc();
                                                    if($linha['Sexo']=='M'){
                                                        echo '<option selected value="M">Masculino</option>';
                                                        echo '<option value="F">Femenino</option>';
        
                                                    }else{
                                                        echo '<option value="M">Masculino</option>';
                                                        echo '<option selected value="F">Femenino</option>';       
                                                    }           
                                                }
                                                $stmt->close();
                                                $conexao->close();
                                            ?>                                        
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputEstado">Estado Civil</label>
                                        <select class="form-control" name="estado_Civil" id="inputEstado" required>
                                            <option value="">Selecione Estado civil</option>
                                            <option value="C">Casado(a)</option>
                                            <option value="S">Solteiro(a)</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--<div class="row">
                                    <div id="myModal" class="modal">

                                        <div class="modal-content">
                                            <div class="container">
                                                <div class="page-header">
                                                    <h3 class="offset-1">Introduzir secção</h3>
                                                    <hr>
                                                </div>

                                                <form method="POST" role="form">
                                                    <div class="row">
                                                        <div class="form col-sm-10 col-md-4 offset-1">
                                                            <label for="sec">Secção</label>
                                                            <select class="form-control" id="sec">
                                                                <option>A</option>
                                                                <option>B</option>
                                                                <option>C</option>
                                                            </select>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-5">
                                                        <div class="form-group col-6 col-sm-5 col-md-4 offset-md-1">
                                                            <a class="btn btn-danger text-left" onclick="closed()">
                                                                <span class="i-color-white"> <i class="fa fa-window-close fa-2x"></i>&nbsp;Cancelar
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                                                            <button class="btn btn-success text-left" id="submete_seccao" type="submit">
                                                                <span class="i-color-white"><i class="fa fa-save fa-2x"></i>&nbsp;Salvar</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <!--Passo 2-->
                    <div id="step-2">
                        <div class="container-fluid padding">
                            <div id="form-step-1" role="form" data-toggle="validator">
                                <fieldset>
                                    <legend>Morada</legend>
                                    <hr class="light">
                                    <!--Primeira Linha-->
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputProvincia_res">Província</label>
                                            <select class="form-control" name="provincia_res" id="inputProvincia_res" required placeholder="Seleciona a Província">
                                                <option value="">Seleciona a Provincia</option>
                                                <?php 
                                                    include("../../Dao/conexao.php");
                                                    //include_once("../../Dao/conexao.php");
                                                    $query="SELECT id_Prov,Nome from provincia";
                                                    $resultado=$conexao->query($query);
                                                    if(!$resultado){
                                                        echo "Erro";
                                                    }

                                                    $linhas=$resultado->num_rows;   

                                                    for($j=0; $j<$linhas; ++$j){
                                                        $resultado->data_seek($j);
                                                        $linha=$resultado->fetch_array(MYSQLI_ASSOC);
                                                        echo '<option value="'.$linha['id_Prov'].'">'.$linha['Nome'].'</option>';
                                                    }
                                                    
                                                    //Fecha a conexao
                                                    $resultado->close();
                                                    $conexao->close();    
                                                ?>
                                            </select>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputDistrito_res">Distrito</label>
                                            <select class="form-control" name="distrito_res" id="inputDistrito_res" required placeholder="Seleciona o Distrito">
                                                <option value="">Seleciona o distrito</option>
                                            </select>    
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>

                                    <!--Segunda Linha-->
                                    <div class="row">
                                        <!--Tirar-->
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputBairro_res">Bairro</label>
                                            <select class="form-control" name="bairro_res" id="inputBairro_res" required placeholder="Seleciona o Bairro">
                                                <option value="">Seleciona o Bairro</option>
                                            </select>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputAvenida">AV/Rua</label>
                                            <input type="text" data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (10-20) caracteres" required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{10,}$" class="form-control" name="avenida" id="inputAvenida" required
                                            placeholder="Introduza A Av/Rua">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                    <!--Terceira Linha-->
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputQuarterao">Quarteirão</label>
                                            <input type="number" class="form-control" data-error="Por favor, introduza valor" required name="quarteirao_res"
                                                id="inputQuarterao" required
                                                placeholder="Introduza Numero de Quarteirão">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputCasa">Casa Nr</label>
                                            <input type="number" data-error="Por favor, introduza valor" class="form-control" name="nrCasa_res" id="inputCasa"
                                                required placeholder="Introduza Numero da casa">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--Quarta Linha-->
                                <fieldset class="mt-4">
                                    <legend>Contacto</legend>
                                    <hr class="light">
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputTel">Número de Telefone</label>
                                            <input type="number" data-error="Por favor, introduza valor" class="form-control" name="nr_Tell" id="inputTel"
                                                required placeholder="Introduza Numero de Telefone">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputEmail">Email</label>
                                            <input type="email" class="form-control" data-error="Por favor, introduza valor" name="email" id="inputEmail"
                                                required placeholder="Introduza o email">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <!--Passo 3-->
                    <div id="step-3" class="mt-4">
                        <legend class="oculto">Filiação</legend>
                        <hr class="oculto">
                        <div class="container-fluid padding">
                            <div id="form-step-2" role="form" data-toggle="validator">
                                <!--Primeira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputNomep">Nome do Pai</label>
                                        <input type="text" data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (3-20) caracteres" required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{3,}$" class="form-control" name="nomePai" id="inputNomep" required
                                            placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputTelP">Telefone</label>
                                        <input type="number" data-error="Por favor, introduza valor" required class="form-control" name="telefonePai" id="inputTelp"
                                            required placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Segunda Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputLocp">Local de Trabalho</label>
                                        <select class="form-control" name="localTrabPai" id="inputLocp" required placeholder="Introduza">
                                            <option value="">Selecione o local de trabalho</option>
                                            <?php 
                                                include("../../Dao/conexao.php");
                                                //include_once("../../Dao/conexao.php");
                                                $query="SELECT id_Prov,Nome from provincia";
                                                $resultado=$conexao->query($query);
                                                if(!$resultado){
                                                    echo "Erro";
                                                }

                                                $linhas=$resultado->num_rows;   

                                                for($j=0; $j<$linhas; ++$j){
                                                    $resultado->data_seek($j);
                                                    $linha=$resultado->fetch_array(MYSQLI_ASSOC);
                                                    echo '<option value="'.$linha['id_Prov'].'">'.$linha['Nome'].'</option>';
                                                }
                                                
                                                //Fecha a conexao
                                                $resultado->close();
                                                $conexao->close();
                                            ?>
                                        <select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputProfp">Profissão</label>
                                        <input type="text" data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (3-20) caracteres" required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{3,}$" class="form-control" name="profissaoPai" id="inputProfp"
                                            required placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Terceira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputNomem">Nome da Mãe</label>
                                        <input type="text" data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (3-20) caracteres" required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{3,}$" class="form-control" name="nomeMae" id="inputNomem" required
                                            placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputTelm">Telefone</label>
                                        <input type="number" data-error="Por favor, introduza valor"  class="form-control" name="telefoneMae" id="inputTelm"
                                            required placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!-- Quarta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputLocm">Local de Trabalho</label>
                                        <select class="form-control" name="localTrabMae" id="inputLocm" required placeholder="Introduza">
                                            <option value="">Selecione o local de trabalho</option>
                                            <?php 
                                                include("../../Dao/conexao.php");
                                                //include_once("../../Dao/conexao.php");
                                                $query="SELECT id_Prov,Nome from provincia";
                                                $resultado=$conexao->query($query);
                                                if(!$resultado){
                                                    echo "Erro";
                                                }

                                                $linhas=$resultado->num_rows;   

                                                for($j=0; $j<$linhas; ++$j){
                                                    $resultado->data_seek($j);
                                                    $linha=$resultado->fetch_array(MYSQLI_ASSOC);
                                                    echo '<option value="'.$linha['id_Prov'].'">'.$linha['Nome'].'</option>';
                                                }
                                                //Fecha a conexao
                                                $resultado->close();
                                                $conexao->close();  
                                            ?>
                                        <select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputProfm">Profissão</label>
                                        <input type="text"  data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (3-20) caracteres" required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{3,}$" class="form-control" name="profissaoMae" id="inputProfm"
                                            required placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Quinta Linha
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="enc">O Encarregado é</label>
                                        <select id="enc" class="form-control" required aria-placeholder="Selecione uma opcao">
                                            <option>Pai</option>
                                            <option>Mãe</option>
                                            <option>Outro</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>

                    <!--Passo 4-->
                    <div id="step-4" class="mt-4">
                        <legend class="oculto">Encarregado</legend>
                        <hr class="oculto">
                        <div class="container-fluid padding">
                            <div id="form-step-3" role="form" data-toggle="validator">
                                <!--Primeira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputNomeenc">Nome do Encarregado</label>
                                        <input type="text" data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (3-20) caracteres" required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{3,}$" class="form-control" name="nomeEnc" required
                                            id="inputNomeenc" placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputTelEnc">Telefone</label>
                                        <input type="number" data-error="Por favor, introduza valor" class="form-control" name="telefoneEnc" required
                                            id="inputTelEnc" placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Segunda Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputprovincEnc">Provincia de Residencia</label>
                                        <select class="form-control" name="provinciaEnc" id="inputprovincEnc" required placeholder="Selecione uma opcao">
                                            <option value="">Selecione a provincia</option>
                                            <?php 
                                                include("../../Dao/conexao.php");
                                                //include_once("../../Dao/conexao.php");
                                                $query="SELECT id_Prov,Nome from provincia";
                                                $resultado=$conexao->query($query);
                                                if(!$resultado){
                                                    echo "Erro";
                                                }
                                                $linhas=$resultado->num_rows;   
                                                for($j=0; $j<$linhas; ++$j){
                                                    $resultado->data_seek($j);
                                                    $linha=$resultado->fetch_array(MYSQLI_ASSOC);
                                                    echo '<option value="'.$linha['id_Prov'].'">'.$linha['Nome'].'</option>';
                                                }
                                                //Fecha a conexao
                                                $resultado->close();
                                                $conexao->close();  
                                            ?>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <!--Tirar-->
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputDistritoEnc">Distrito de Residencia</label>
                                        <select class="form-control" required id="inputDistritoEnc" name="distritoEnc">
                                            <option value="">Seleciona o distrito</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Terceira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputBairroenc">Bairro</label>
                                        <select class="form-control" name="moradaEnc" id="inputBairroenc" required placeholder="Selecione uma opcao">
                                            <option value="">Seleciona o Bairro</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <!--Tirar-->
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputAv">Av/Rua</label>
                                        <input type="text" data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (10-20) caracteres" required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{10,}$" class="form-control" name="av_rua_enc" id="inputAv" required
                                            placeholder="Introduza A Av/Rua">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Quarta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputLocenc">Local de Trabalho</label>
                                        <select class="form-control" name="localTrabEnc" required id="inputLocenc" placeholder="Introduza ">
                                            <option value="">Selecione o local de trabalho</option>
                                            <?php 
                                                include("../../Dao/conexao.php");
                                                //include_once("../../Dao/conexao.php");
                                                $query="SELECT id_Prov,Nome from provincia";
                                                $resultado=$conexao->query($query);
                                                if(!$resultado){
                                                    echo "Erro";
                                                }

                                                $linhas=$resultado->num_rows;   

                                                for($j=0; $j<$linhas; ++$j){
                                                    $resultado->data_seek($j);
                                                    $linha=$resultado->fetch_array(MYSQLI_ASSOC);
                                                    echo '<option value="'.$linha['id_Prov'].'">'.$linha['Nome'].'</option>';
                                                }
                                                //Fecha a conexao
                                                $resultado->close();
                                                $conexao->close();  
                                            ?>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputProfenc">Profissão</label>
                                        <input type="text" data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (3-20) caracteres" required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]{3,}$" class="form-control" name="profissaoEnc" required
                                            id="inputProfenc" placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---->
                    <!--Passo 5-->
                    <div id="step-5">
                        <div class="container-fluid padding">
                            <div id="form-step-5" role="form" data-toggle="validator">
                                <fieldset>
                                    <legend>Submissões</legend>
                                    <hr class="light">
                                    <!--Primeira Linha-->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <div class="form-group offset-1">
                                                <label for="inputImagem"></label>
                                                <div id="kv-avatar-errors-2" class="center-block" style="width:500px;display:none"></div>
                                                <div class="text-center">
                                                    <div class="kv-avatar">
                                                        <div class="file-loading">
                                                            <input id="avatar-2" name="userImage" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-5">
                                    <legend>Dados Adicionais</legend>
                                    <hr class="light">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <label for="inputSofd">Sofre de Alguma doença</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                                        <select class="form-control" name="_sofre_doenca" id="inputSofd"
                                                            aria-placeholder="Selecione uma opcao">
                                                            <option>Não</option>
                                                            <option>Sim</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <div class="form-group offset-1">
                                                <label for="inputInd" id="lab">Em caso afirmativo indique-a</label>
                                                <textarea class="form-control" rows="5" name="_se_sim" cols="10"
                                                    id="inputInd"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <!---->
                </div>
                <!---->
            </div>
            <input type="submit" name="concluir">

            <!-- <a id="matriculate" href="ReverDados.php" class="btn btn-success">Concluir</a>-->
                <!--<button class="btn btn-success" id="matriculate">Submeter</button>-->
        </form>
    </div>
