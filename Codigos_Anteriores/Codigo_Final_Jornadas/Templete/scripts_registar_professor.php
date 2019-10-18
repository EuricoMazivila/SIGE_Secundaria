<script>
	
 var valor;

$('#qtdDisciplina').change(function() {
   valor = $(this).val();

   if (valor=='2') {
   		$('.apagado').css('display','block');
   }

   else {
   		$('.apagado').css('display','none');
   }



   /*switch(valor) {

   		case '1':
   			$('.escondido1').css('display','none');
   			break;

   		case '2':
   			$('.escondido1').css('display','block');
   			break;

   }*/

	
}); 

</script>