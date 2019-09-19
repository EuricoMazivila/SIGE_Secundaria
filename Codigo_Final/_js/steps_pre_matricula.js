$(document).ready(function(){
    // Toolbar extra buttons
    var btnSubmeter = $('<button></button>').text('Submeter')
                                     .addClass('btn btn-success')
                                     .on('click', function(){
                                            if( !$(this).hasClass('disabled')){
                                                var elmForm = $("#myForm");
                                                if(elmForm){
                                                    elmForm.validator('validate');
                                                    var elmErr = elmForm.find('.has-error');
                                                    if(elmErr && elmErr.length > 0){
                                                        alert('Oops existem campos que nao foram preenchidos');
                                                        return false;
                                                    }else{
                                                        alert('Bom! Cadastro Feito com Sucesso');
                                                        elmForm.submit();
                                                        return false;
                                                    }
                                                }
                                            }
                                        });
    var btnCancelar = $('<button></button>').text('Cancelar')
                                     .addClass('btn btn-danger')
                                     .on('click', function(){
                                            $('#smartwizard').smartWizard("reset");
                                            $('#myForm').find("input, textarea").val("");
                                        });

                    
                    
    // Smart Wizard
    $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            transitionEffect:'slide',
            anchorSettings: {
                        markDoneStep: true, // add done css
                        markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                        removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                        enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
            toolbarSettings: {toolbarPosition: 'bottom',
                            toolbarExtraButtons: [btnSubmeter, btnCancelar]
            }                
        });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
        var elmForm = $("#form-step-" + stepNumber);
        // stepDirection === 'forward' :- this condition allows to do the form validation
        // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
        if(stepDirection === 'forward' && elmForm){
            elmForm.validator('validate');
            var elmErr = elmForm.find('.has-error');
            if(elmErr && elmErr.length > 0){
                // Form validation failed
                return false;
            }
        }
        return true;
        });

        
    $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
        // Enable finish button only on last step
        if(stepNumber == 6){
            $('.btn-finish').removeClass('disabled');
        }else{
            $('.btn-finish').addClass('disabled');
        }
    });
});