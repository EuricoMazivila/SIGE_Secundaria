

<div class="centro_login">
    <div class="modal-dialog text-center c">
        <div class="col-sm-11 main-section">
            <div class="modal-content form-input" id="principal">

                <div class="col-12">
                    <div class="col-12 bemVindoprimeiro">
                        
                        <h5 class="mt-2">Recuperação de conta</h5>
                        <hr>
                        <p>Este processo ajuda a identifica-lo entre os utilizadores do sistema.</p>
                    </div>

                    <form class="col-12" method="POST" action="../../Dao/Processamento/processa_recuperacao.php">
                        <div class="text-center titulo">
                        <p>Introduza o nome do usuario</p>
        
                     </div>
                     <div class="form-group">
                         <input type="text" class="form-control bb" id="name" name='nomeUser' placeholder="Nome de usuário">
                     </div>
                        <button type="submit" id ="next" class="btn btn-primary next" name="recupera">Próximo</button>
                        
                    </form> 
                </div>
                
            </div>
        </div>
    </div>
</div>

