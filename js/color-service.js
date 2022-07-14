var ColorService={

  init: function(){
    $('#addColorForm').validate({
      submitHandler:function(form){
        var color = Object.fromEntries((new FormData(form)).entries());
        ColorService.add(color);
      }
    });//JQUERY VALIDATION
  },

  add: function(color){
    console.log("Nas log",color);
    $('.add-color-button').attr('disabled', true);
    $.ajax({
      url: 'rest/colors',
      type: 'POST',
      data: JSON.stringify(color),
      contentType: 'application/json',
      dataType: "json",
      beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
      success: function(result){
        toastr.success("Color added!");
        $('.add-color-button').attr('disabled', false);
        $("#exampleModal4").modal("hide");
        $("#material-list").html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" style="width : 5rem ; height : 5rem;" role="status"> <span class="sr-only"></span>  </div></div>');
        //console.log(data);
        MaterialService.list();
        console.log(result);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
      }
    });
  }

}
