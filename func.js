function turnOnOff(_classId, _blueId)
{
	$.ajax({

		url: 'cgi-bin/turnOnOff.py',
		data: { classId : _classId, blueId : _blueId },
		type: "POST",
		datatype: "json",
		success: function(data){
			alert("success!");
		},
		error: function(xhr){
			alert("xhr.status");
		}

	});

}

function checkSet(_id)
{
	var _state = 0;
	function checkCurrent(){

		$.ajax({

			url: 'cgi-bin/checkCurrent.py',
			data: { id: _id },
			type: "POST",
			datatype: "json",
			success: function(data){

				if( (data.state ^ _state) != _state ){
					if(_state == 0) $('#butten_'+_id).html("Off");
					else $('#butten_'+_id).html("On");
				}

			},

			error: function(xhr){
				alert("xhr.status");
			}

		});

	}

	return checkCurrent;
}