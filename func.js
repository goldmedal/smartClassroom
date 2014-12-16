function OnOff(_id){
	$.ajax({

		url: '../cgi-bin/turnOnOff.py',
		data: { id : _id},
		type: "POST",
		datatype: "html",
		success: function(data){

			alert(data);			
			if(data == 0){
				 $('#butten_'+_id).html("On");
			}
			else if(data ==1){ 
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

		url: '../cgi-bin/checkCurrent.py',
		data: { id: _id },
		type: "POST",
		datatype: "html",
		success: function(data){

			alert(data);
			if(data == 0){
				 $('#butten_'+_id).html("On");
			}
			else if(data == 1){ 
				$('#butten_'+_id).html("Off");
			}

		},

		error: function(xhr){
			alert(xhr.status);
		}

	});

}

function irsend(){
	$.ajax({

		url: '../cgi-bin/irsend.py',
		data: {},
		type: "POST",
		datatype: "html",
		success: function(data){
			alert('Send!');
		},
		error: function(xhr){
			alert(xhr.status);
		}

	});
}


