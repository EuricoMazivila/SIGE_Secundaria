<script>
	
 var valor;

$('#classeTurma').change(function() {
   valor = $(this).val();

if (valor=='11' || valor=='12')  {

	$('.escondido').css('display','block'); }

else {
	$('.escondido').css('display','none');
}
}); 

</script>