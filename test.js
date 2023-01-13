jQuery(function($){
  $("#test-submit").click(function(e){
    e.preventDefault();
    var data_1 = $("#exampleFormControlInput1").val();
    var data_2 = $("#exampleFormControlSelect2").val();
    var data_3 = $("#exampleFormControlTextarea1").val();
    var ck_editor = tinymce.get('e_id').getContent();

    $.ajax({
      url: TEST_AJAX.ajaxurl,
      data: { 'action': 'test_ajax','nonce' : TEST_AJAX._wpnonce, 'email' : data_1, 'select': data_2, 'text': data_3, 'editor': ck_editor },
      type: 'POST',
      dataType: 'JSON',
      success: function(resp){
        console.log( resp );
        // Display an info toast with no title
        Command: toastr["success"]("Data Updated");
      }     
    });

    console.log( ck_editor );

 });

    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  
});