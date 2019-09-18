<?php session_start();
 ?>
<div class="centro_login">
    <div class="modal-dialog text-center c">
        <div class="col-sm-11 main-section">
            <div class="modal-content form-input" id="principal">

                <div class="col-12">
                    <div class="col-12 bemVindoprimeiro">
                        <h5 class="text-center titulo">Recuperação de conta</h5>
                        <hr>
                        
                    </div>

                    <form class="col-12" method="POST" action="../../Dao/Processamento/processa_recuperacao.php">
                        <form class="col-12" method="POST">
                     <div class="text-center titulo">
                        <p>Foi enviada uma mensagem com um codigo de validação de 6 digitos para o numero/email.</p>
        
                     </div>
                     <div class="form-group">
                         <input type="number" class="form-control bb" id="codigo" name='codigo' placeholder="Introduza o codigo"> 
                     </div>
                        <button type="submit" class="btn btn-primary botao" name="validarCodigo">Próximo</button> 
                          
                    </form> 
                </div>
                
            </div>
        </div>
    </div>
</div>

