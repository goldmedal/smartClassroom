function OnOff(_id){

	addSpinner();
	$.ajax({

		url: '../cgi-bin/turnOnOff.py',
		data: { id : _id},
		type: "POST",
		datatype: "html",
		success: function(data){

//			alert(data);			
			if(data == 0){
				 $('#butten_'+_id).css("opacity",0).html("On").animate({opacity:"1"},500);
			}
			else if(data ==1){ 
				$('#butten_'+_id).css("opacity",0).html("Off").animate({opacity:"1"},500);
			}
		},
		error: function(xhr){
			alert(xhr.status);
		},
		complete: function() {
			removeSpinner();
		}

	});
}


function checkCurrent(_id){
	addSpinner();
	$.ajax({

		url: '../cgi-bin/checkCurrent.py',
		data: { id: _id },
		type: "POST",
		datatype: "html",
		success: function(data){

//			alert(data);
			if(data == 0){
				 $('#butten_'+_id).css("opacity",0).html("On").animate({opacity:"1"},500);
			}
			else if(data == 1){ 
				$('#butten_'+_id).css("opacity",0).html("Off").animate({opacity:"1"},500);
			}

		},

		error: function(xhr){
			alert(xhr.status);
		},
		complete: function(){
			removeSpinner();
		}

	});

}

function irsend(_devId){

	addSpinner();
	$.ajax({

		url: '../cgi-bin/irsend.py',
		data: {devId: _devId},
		type: "POST",
		datatype: "html",
		success: function(data){
//			alert('Send!');
		},
		error: function(xhr){
			alert(xhr.status);
		},
		complete: function(){
			removeSpinner();
		}

	});
}

function addSpinner() {

	$('body').append( 
	'<div class="spinner">'+
	'<div class="spinner-container container1">' +
	'	 <div class="circle1"></div>' +
	'     <div class="circle2"></div>' +
	'	<div class="circle3"></div>' +
	'	<div class="circle4"></div>' +
	'	</div>' +
	' <div class="spinner-container container2">'+
		'<div class="circle1"></div>' +
		'<div class="circle2"></div>' +
		'<div class="circle3"></div>' +
		' <div class="circle4"></div>' +
		' </div>' +
		'  <div class="spinner-container container3">' +
		'<div class="circle1"></div>'+
	    ' <div class="circle2"></div>'+
	    '  <div class="circle3"></div>'+
	    '  <div class="circle4"></div>' +
		'   </div>'+
		'</div>');
	$('body').prepend("<div id='amask'></div>");



}

function removeSpinner() {

	$('.spinner').remove();
	$('#amask').remove();

}
