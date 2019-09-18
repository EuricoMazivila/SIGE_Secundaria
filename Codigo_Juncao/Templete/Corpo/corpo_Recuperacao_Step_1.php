<?php session_start();
 ?>
<div class="centro_login">
    <div class="modal-dialog text-center c">
        <div class="col-sm-11 main-section">
            <div class="modal-content form-input" id="principal">

                <div class="col-12">
                    <div class="col-12 bemVindo">
                       <h5>Recuperação de conta</h5>
                       <hr>
                    </div>

                    <form class="col-12" method="POST" action="../../Dao/Processamento/processa_recuperacao.php">
                        <div class="row">
                            <p>Escolha abaixo como desejas receber a mensagem de recuperação</p>
                        </div>

                        <div class="row mt-2">
                            <i class="fa fa-mobile"></i><input type="radio" id="smsR" name="tell" value="<?php echo $_SESSION['nrTell']?>"><span class="afa">SMS</span>
                            <fieldset disabled>
                                <input type="text" class="offset-2" value="<?php echo $_SESSION['nrTell']?>" name="msg" id="sms">
                            </fieldset>
                        </div>

                        <div class="row mt-4">
                            <i class="fa fa-mail-bulk"></i><input type="radio" id="mailR" name="mailll" value="<?php echo $_SESSION['email']?>"> <span class="af">E-Mail</span>

                           <fieldset disabled>
                                <input type="text" class="offset-1" value="<?php echo $_SESSION['email']?>" name="maill" id="mail">
                           </fieldset>
                        </div>

                       

                      <button type="submit" class="btn btn-primary" name="enviarCodigo">Enviar</button>
                    </form> 
                </div>
                
            </div>
        </div>
    </div>
</div>
