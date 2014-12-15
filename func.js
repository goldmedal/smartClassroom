function OnOff(_id){
	$.ajax({

		url: '../cgi-bin/'+_path,
		data: { id : _id},
		type: "POST",
		datatype: "html",
		success: function(data){
			
			if(state == 1){
				 $('#butten_'+_id).html("On");
			}
			else { 
				$('#butten_'+_id).html("Off");
			}
		},
		error: function(xhr){
			alert(xhr.status);
		}

	});
}


function checkCurrent(_id){

	$.ajax({

		url: '../cgi-bin/rev.py',
		data: { id: _id },
		type: "POST",
		datatype: "html",
		success: function(data){

			alert("check success!");
			if(state == 1){
				 $('#butten_'+_id).html("On");
			}
			else { 
				$('#butten_'+_id).html("Off");
			}

		},

		error: function(xhr){
			alert(xhr.status);
		}

	});

}
