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
