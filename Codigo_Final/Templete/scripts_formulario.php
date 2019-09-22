<script>
     $('#inputInd').prop("disabled",true);

    $('#inputSofd').change(function(){

        if($(this).val()=='Sim')  {
           $('#inputInd').prop("disabled",false);
           $('#lab').css('color', '#000');
        }

        else if($(this).val()=='Não')  {
            $('#inputInd').prop("disabled",true);
            $('#lab').css('color', 'gray');
        }
    });
	
	
    function closed() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>

<script type="text/javascript">
	$(function(){
		$('#inputNacionalidade').change(function(){
			if( $(this).val() ) {
				$.post('../../Dao/processa_formulario.php', { buscaprovincia:  $(this).val() }, function (data) {
				//retorna as opcoes da busca no banco de dados
				$('#inputProvincia').html(data);
                $('#inputDistrito').html('<option value="">Seleciona o distrito</option>');
                });
                
			} else {
				$('#inputProvincia').html('<option value="">Seleciona a provincia</option>');
                $('#inputDistrito').html('<option value="">Seleciona o distrito</option>');
            }
		});
	});
</script>

<script type="text/javascript">
	$(function(){
		$('#inputProvincia').change(function(){
			if( $(this).val() ) {
				$.post('../../Dao/processa_formulario.php', { buscadistrito:  $(this).val() }, function (data) {
				//retorna as opcoes da busca no banco de dados
				$('#inputDistrito').html(data);});
			} else {
				$('#inputDistrito').html('<option value="">Seleciona o distrito</option>');
			}
		});
	});
</script>

<script type="text/javascript">
	$(function(){
		$('#inputProvincia_res').change(function(){
			if( $(this).val() ) {
				$.post('../../Dao/processa_formulario.php', { buscadistrito:  $(this).val() }, function (data) {
				//retorna as opcoes da busca no banco de dados
				$('#inputDistrito_res').html(data);});
				$('#inputBairro_res').html('<option value="">Seleciona o Bairro</option>');
			} else {
				$('#inputDistrito_res').html('<option value="">Seleciona o distrito</option>');
				$('#inputBairro_res').html('<option value="">Seleciona o Bairro</option>');
			}
		});
	});
</script>

<script type="text/javascript">
	$(function(){
		$('#inputDistrito_res').change(function(){
			if( $(this).val() ) {
				$.post('../../Dao/processa_formulario.php', { buscabairro:  $(this).val() }, function (data) {
				//retorna as opcoes da busca no banco de dados
				$('#inputBairro_res').html(data);});
			} else {
				$('#inputBairro_res').html('<option value="">Seleciona o Bairro</option>');
			}
		});
	});
</script>

<script type="text/javascript">
	$(function(){
		$('#inputprovincEnc').change(function(){
			if( $(this).val() ) {
				$.post('../../Dao/processa_formulario.php', { buscadistrito:  $(this).val() }, function (data) {
				//retorna as opcoes da busca no banco de dados
				$('#inputDistritoEnc').html(data);});
				$('#inputBairroenc').html('<option value="">Seleciona o Bairro</option>');
			} else {
				$('#inputDistritoEnc').html('<option value="">Seleciona o distrito</option>');
				$('#inputBairroenc').html('<option value="">Seleciona o Bairro</option>');
			}
		});
	});
</script>

<script type="text/javascript">
	$(function(){
		$('#inputDistritoEnc').change(function(){
			if( $(this).val() ) {
				$.post('../../Dao/processa_formulario.php', { buscabairro:  $(this).val() }, function (data) {
				//retorna as opcoes da busca no banco de dados
				$('#inputBairroenc').html(data);});
			} else {
				$('#inputBairroenc').html('<option value="">Seleciona o Bairro</option>');
			}
		});
	});
</script>


<script>
	var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
            'onclick="alert(\'Call your custom code here.\')">' +
            '<i class="fas fa-tag"></i>' +
            '</button>'; 
            
	$("#avatar-2").fileinput({
		overwriteInitial: true,
		maxFileSize: 1500,
		showClose: false,
		showCaption: false,
		showBrowse: false,
		browseOnZoneClick: true,
		removeLabel: '',
		removeIcon: '<i class="fas fa-trash"></i>',
		removeTitle: 'Cancel or reset changes',
		elErrorContainer: '#kv-avatar-errors-2',
		msgErrorClass: 'alert alert-block alert-danger',
		defaultPreviewContent: '<img src="../../uploads/default-avatar.jpg" alt="Your Avatar"><h6 class="text-muted">Click to select</h6>',
		layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		allowedFileExtensions: ["jpeg","jpg", "png", "gif"]
	});
</script>