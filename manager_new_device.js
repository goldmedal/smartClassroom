  $(function() {  //新增equipment function

    var dialog, form,
      equip_name = $( "#equip_name" ),
      socket_num = $( "#socket_num" ),
      bluetooth_num = $( "#bluetooth_num" ),
      allFields = $( [] ).add( equip_name ).add( equip_type ).add( bluetooth_num ).add( socket_num ).add( show ),
      tips = $( ".validatetips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }

 
    function addUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      var equip_type = $( "input[name='equip_type']:checked" );
      var show = $( "input[name='show']:checked" );
      valid = valid && checkLength( equip_name, "equip_name", 1, 18 );
      valid = valid && checkLength( bluetooth_num, "bluetooth_num", 1, 5 );
      valid = valid && checkLength( socket_num, "socket_num", 1, 5 );
	  if(valid){
		  addSpinner();
		  $.ajax({
			url: "../cgi-bin/addDev.py",
			data: { name: equip_name.val(), type: equip_type.val(), group: bluetooth_num.val(), g_num: socket_num.val(), open: show.val() },
			type: "POST",
			datatype: "json",
			success: function(data) {
			
			  if(data.result == "1"){
				  var e_type;
				  if(equip_type.val() == 1) e_type = "電器";
				  else if(equip_type.val() == 2) e_type = "開關";
				  else if(equip_type.val() == 3) e_type = "紅外線";
				  var open;
				  if(show.val()==1) open = "Yes";
				  else open = "No";
				  var _name = equip_name.val(),
				  _type = e_type,
				  _group = bluetooth_num.val(),
				  _g_num = socket_num.val(),
				  _open = open;

					$( "#users tbody" ).append( "<tr class='row' id='row'>" +
					  "<td>" + equip_name.val() + "</td>" +
					  "<td>" + e_type + "</td>" +
					  "<td>" + bluetooth_num.val() + "</td>" +
					  "<td>" + socket_num.val() + "</td>" +
					  "<td>" + open + "</td>" +
					  "<td><button class='dele_dev' id='dev_dele_"+data.last_id+"'>delete</button></td>" +
		"<td><button class='edit_dev' id='dev_edit_"+data.last_id+"'>Edit</button></td>" +
					"</tr>" );
					$('#dev_dele_'+data.last_id).click(function() {
						delete_dev(data.last_id);
					});
					dialog.dialog( "close" );
					$('#dev_edit_'+data.last_id).click(function() {
						edit_dialog(data.last_id, _group, _g_num,_name, _open);	
					});
				}else {
					alert("Please check and try again");
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

      return valid;
    }
  dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 600,
      width: 400,
      modal: true,
      buttons: {
        "Create an equipment": addUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
   
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
 
    $( "#create-user" ).button().on( "click", function() {
	  dialog = $( "#dialog-form" ).dialog({
		  autoOpen: false,
		  height: 600,
		  width: 400,
		  modal: true,
		  buttons: {
			"Create an equipment": addUser,
			Cancel: function() {
			  dialog.dialog( "close" );
			}
		  },
		  close: function() {
			form[ 0 ].reset();
			allFields.removeClass( "ui-state-error" );
		  }
		});
      dialog.dialog( "open" );
    });

    $("#add_blue").button().on( "click", function(){
	  addSpinner();
      var _mac = $("#bluetext").val();
      $.ajax({

        url: "../cgi-bin/bluez-pair",
        data: { mac : _mac, pin : "1234"},
        type: "POST",
        datatype: "json",
        success: function(data) {
		  var btId = data.last_id;
		  var result = data.result;
          if(result == "1") {
             $("ul").append("<div class='bt_item'>"+btId+". "+ _mac + "<button class='dele_blue' id='dele_"+btId+"'>delete</button>" + "</div>");
			 $('#dele_'+btId).click(function() {
				delete_bluetooth(btId, _mac);
			 });
          }else {
            alert("Add Fail!please try again and check your bluetooth device");
          }
        },
        error: function(xhr) {
            alert(xhr.status);
        },
		complete: function() {
			removeSpinner();
		}

      });
    
     
    });

  });

function delete_bluetooth(_btId, _mac){
	addSpinner();
	$.ajax({
		url: "../cgi-bin/bluez-remove",
		data: { mac : _mac },
		type: "POST",
		datatype: "json",
		success: function(data) {
			if(data.result == '1'){
				$('#dele_'+_btId).closest("div").remove();
			}
		},
		error: function(xhr) {
			alert(xhr.status);
		},
		complete: function(){
			removeSpinner();
		}


	});



}

function delete_dev(_devId){
	addSpinner();
	$.ajax({
		url: "../cgi-bin/removeDev.py",
		data: { devId : _devId },
		type: "POST",
		datatype: "json",
		success: function(data) {
			if(data.result == '1'){
				$('#dev_dele_'+_devId).closest("tr").remove();
			}
		},
		error: function(xhr) {
			alert(xhr.status);
		},
		complete: function() {
			removeSpinner();
		}


	});


}

function edit_dialog(_devId, _group, _gNum, _name, _open, _type){
 
    var dialog, form,
      equip_name = $( "#equip_name" ),
      socket_num = $( "#socket_num" ),
      bluetooth_num = $( "#bluetooth_num" ),
      allFields = $( [] ).add( equip_name ).add( equip_type ).add( bluetooth_num ).add( socket_num ).add( show ),
      tips = $( ".validatetips" );
	  equip_name.val(_name);
	  $("input[name='equip_type'][value="+_type+"]").attr("checked","checked"); 
	  socket_num.val(_gNum);
	  $("input[name='show'][value="+_open+"]").attr("checked","checked");
	  bluetooth_num.val(_group);

     function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }

 
    function editUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      var equip_type = $( "input[name='equip_type']:checked" );
      var show = $( "input[name='show']:checked" );
      valid = valid && checkLength( equip_name, "equip_name", 1, 18 );
      valid = valid && checkLength( bluetooth_num, "bluetooth_num", 1, 5 );
      valid = valid && checkLength( socket_num, "socket_num", 1, 5 );
	  if(valid){
		  addSpinner();
		  $.ajax({
			url: "../cgi-bin/editDev.py",
			data: { devId: _devId, name: equip_name.val(), type: equip_type.val(), group: bluetooth_num.val(), g_num: socket_num.val(), open: show.val() },
			type: "POST",
			datatype: "json",
			success: function(data) {
				
			  var tr = $('#dev_dele_'+_devId).closest("tr");
			  	
			  if(data.result == "1"){
				  var e_type;
				  if(equip_type.val() == 1) e_type = "電器";
				  else if(equip_type.val() == 2) e_type = "開關";
				  else if(equip_type.val() == 3) e_type = "紅外線";
				  var open;
				  if(show.val()==1) open = "Yes";
				  else open = "No";
				  var _name = equip_name.val(),
							  _type = e_type,
							  _group = bluetooth_num.val(),
							  _g_num = socket_num.val(),
							  _open = open;

					  tr.html( 
					  "<td>" + equip_name.val() + "</td>" +
					  "<td>" + e_type + "</td>" +
					  "<td>" + bluetooth_num.val() + "</td>" +
					  "<td>" + socket_num.val() + "</td>" +
					  "<td>" + open + "</td>" +
					  "<td><button class='dele_dev' id='dev_dele_"+_devId+"'>delete</button></td>" +
			"<td><button class='edit_dev' id='dev_edit_"+_devId+"'>Edit</button></td>" +
					"</tr>" );
					dialog.dialog( "close" );
					$('#dev_dele_'+_devId).click(function() {
						delete_dev(_devId);
					});
					$('#dev_edit_'+_devId).click(function() {
						edit_dialog(_devId, _group, _g_num,_name, _open);	
					});
				}else {
					alert("Please check and try again");
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

      return valid;
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 600,
      width: 400,
      modal: true,
      buttons: {
        "Edit this equipment": editUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      editUser();
    });

    dialog.dialog( "open" );

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
