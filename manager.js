function hide_panel(){

	$('#mask').css('display','none');
	$('#editPanel').css('display','none');
	$('#editPanel').empty();
	
}

function open_edit( bid, btNum, sockNum, equipName, open ) {

	$('#mask').css('display','inline');
	$('#editPanel').css('display','inline');

	if( open == 0 ) {

		openHtml = 	"Yes<input type='radio' name='openValue' id='openValue' value='1'> \
				No<input type='radio' name='openValue' id='openValue' value='0' checked>";

	} else {

		openHtml = 	"Yes<input type='radio' name='openValue' value='1' checked> \
					No<input type='radio' name='openValue' value='0'>";

	}

	$('#editPanel').html("\
		<div id='btNum'> \
			<span class='title'>Bluetooth Number :</span>\
			<span class='value'>" + btNum + "</span>\
		</div>\
		<div id='sockNum'> \
			<span class='title'>Socket Numberr :</span>\
			<span class='value'>" + sockNum + "</span> \
		</div> \
		<div id='name'> \
			<span class='title'>Equip Name :</span> \
			<span class='value'> \
				<input type='text' id='nameValue' value='"+equipName+"'> \
			</span>	 \
		</div>	\
		<div id='open'> \
			<span class='title'>Open :</span> \
			<span class='value'>"+ openHtml +"</span>			\
		</div> \
		<div id='submit' onclick='edit_submit("+bid+")'>Submit</div> \
		");

}

function edit_submit(_bid) {

	var _equipName = $("#nameValue").val();
	var _openValue = $("input[name=openValue]:checked").val();

	$.ajax ({
		type: 'POST',
		url: 'edit_submit.php',
		data: { bid : _bid, equipName : _equipName, openValue : _openValue },
		success: function (data) {
			hide_panel();
			location.reload();
		},
		error: function (xhr) {
			alert(xhr.status);
		}

	});

}