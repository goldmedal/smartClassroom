var _path;
function turnOnOff(_classID, _blueID)
{

//	var _path = 'turnOn.py';
	var _state = 0;
	function OnOff(){
		$.ajax({

			url: '../cgi-bin/'+_path,
			data: { classID : _classID, blueID : _blueID },
			type: "POST",
			datatype: "html",
			success: function(data){
				
				if($('#butten_'+_classID).html() == "On") {
					$('#butten_'+_classID).html('Off');
					_path = 'turnOn.py';
					_state = 1;
				}else{
					_state = 0;
					$('#butten_'+_classID).html('On');
					_path = 'turnOff.py';
				}
			},
			error: function(xhr){
				alert(xhr.status);
			}

		});
	}
	return OnOff;

}

function checkSet(_id)
{
	var _state = 0;
	function checkCurrent(){

		$.ajax({

			url: '../cgi-bin/rev.py',
			data: { id: _id },
			type: "POST",
			datatype: "html",
			success: function(data){
				alert("check success!");
				if(data > 20){
					 $('#butten_'+_id).html("On");
					_path = "turnOff.py";
				}
				else { 
					$('#butten_'+_id).html("Off");
					_path = "turnOn.py";
				}

<<<<<<< HEAD
				if((data.state ^ _state)){
=======
/*				if( (data.state ^ _state) != _state ){
>>>>>>> 08d57e300fe093a067a8bd920b8aef227385e4e9
					if(_state == 0) $('#butten_'+_id).html("Off");
					else $('#butten_'+_id).html("On");
				}
*/
			},

			error: function(xhr){
				alert(xhr.status);
			}

		});

	}

	return checkCurrent;
}

