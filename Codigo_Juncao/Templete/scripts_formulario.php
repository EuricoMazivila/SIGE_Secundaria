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

<script >
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
        defaultPreviewContent: '<img src="uploads/default-Avatar.jpg" alt="Your Avatar"><h6 class="text-muted">Click to select</h6>',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpeg","jpg", "png", "gif"]
    });
</script>