$(function() {
  $('.chosen-select').chosen();
  $('.chosen-select-deselect').chosen({ allow_single_deselect: true });

   $('#signaturepad').signaturePad({drawOnly:true, drawBezierCurves:true, variableStrokeWidth:true, lineTop:200});


});

function signofflesson(client_id,lesson_id){

    var api = $('#signaturepad').signaturePad();
    var error ='';
    var employee_id = $("#empid").val();
    var sign = api.getSignatureImage();

    $(".search-choice-close").trigger("click");

    if(employee_id == '')
    	error += 'Please select employee!\n';

    if($("#signdata").val() == '')
    	error += 'Please sign in!';

    if(error){
    	alert(error);
    	return false;
    }

     $.ajax({

         url: base_url+'signoff/training_record', 
         type: 'POST',
         dataType:'json',
         data: {'client_id': client_id,'lesson_id':lesson_id,'employee_id':employee_id,'sign':sign},         
         success: function(response)
         { 
			
         	if(response.status == 'success'){
         		api.clearCanvas(); 
         		$("#empid").val('');
         		$(".search-choice-close").bind("click");
         		alert(response.message);
         	}else{
         		alert(response.message);
         	}
         }
	});

    //var sig = api.clearCanvas();
}