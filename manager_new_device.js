  $(function() {  //新增equipment function

    var dialog, form,
      equip_name = $( "#equip_name" ),
      equip_type = $( "#equip_type" ),
      socket_num = $( "#socket_num" ),
      show = $( "#show" ),
      bluetooth_num = $( "#bluetooth_num" ),
      allFields = $( [] ).add( equip_name ).add( equip_type ).add( bluetooth_num ).add( socket_num ).add( show ),
      tips = $( ".validateTips" );
 
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
 
      valid = valid && checkLength( equip_name, "equip_name", 1, 18 );
      valid = valid && checkLength( equip_type, "equip_type", 1, 13 );
      valid = valid && checkLength( bluetooth_num, "bluetooth_num", 1, 5 );
      valid = valid && checkLength( socket_num, "socket_num", 1, 5 );

      if ( valid ) {
        $( "#users tbody" ).append( "<tr class='row' id='row'>" +
          "<td>" + equip_name.val() + "</td>" +
          "<td>" + equip_type.val() + "</td>" +
          "<td>" + bluetooth_num.val() + "</td>" +
          "<td>" + socket_num.val() + "</td>" +
          "<td>" + $('input[name=show]:checked').val() + "</td>" +
          "<td>" + "<input type='checkbox' name='del' />" + "</td>" +
        "</tr>" );
        dialog.dialog( "close" );
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
      dialog.dialog( "open" );
    });
    $( "#dele" ).button().on( "click", function(){
      var t=$("input:checked").closest("tr").remove();
    });

    $("#add_blue").button().on( "click", function(){
      var msg=$("#bluetext").val();
      $("ol").append("<li>"+ msg + "<input type='checkbox' name='del' />" + "</li>");
    });

    $( "#dele_blue" ).button().on( "click", function(){
      var tb=$("input:checked").closest("li").remove();
    });

  });
