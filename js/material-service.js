var MaterialService = {
  init: function(){
    $('#addMaterialForm').validate({
      submitHandler:function(form){
        var material = Object.fromEntries((new FormData(form)).entries());
        MaterialService.add(material);
      }
    });//JQUERY VALIDATION
    MaterialService.list();
  },

  list: function(){
    $.get("rest/services/material/", function( data ){
      $("#material-list").html("");
      var html="";
      for(let i=0;i<data.length;i++){
        html+=`<div class="col-lg-4">
          <h2>`+ data[i].name +`</h2>
          <p>`+ data[i].color +`</p>
          <p>
            <button type="button" class="btn btn-primary material-button" onclick="MaterialService.get(`+data[i].id+`)">
              Edit material
            </button>
            <button type="button" class="btn btn-primary material-button-delete" onclick="showModalDelete(`+data[i].id+`)">
              Delete material
            </button>
          </p>
        </div>`;
      }
      html += `<button type="button" class="btn btn-success" onclick="showModalAdd()">
        Add material
      </button>`;
      $("#material-list").html(html);
    });
  },

  get: function(id){
    $('.material-button').attr('disabled', true);
    $('.material-button-delete').attr('disabled', true);
    $.get("rest/services/material/"+id,function(data){
      console.log(data);
      $("#name").val(data.name);
      $("#id").val(data.id);
      $("#color").val(data.color);
      $("#length").val(data.length);
      $("#available").val(data.available);
      $("#exampleModal").modal("show");
      $('.material-button').attr('disabled', false);
      $('.material-button-delete').attr('disabled', false);
    });
  },

  update: function(){
    $('.save-material-button').attr('disabled', true);
    var material={};
    //material.id=$('#id').val();
    material.name=$('#name').val();
    material.color=$('#color').val();
    material.length=$('#length').val();
    material.available=$('#available').val();

    $.ajax({
      url: 'rest/services/material/'+$('#id').val(),
      type: 'PUT',
      data: JSON.stringify(material),
      contentType: 'application/json',
      dataType: "json",
      success: function(result){
        $("#exampleModal").modal("hide");
        $('.save-material-button').attr('disabled', false);
        $("#material-list").html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" style="width : 5rem ; height : 5rem;" role="status"> <span class="sr-only"></span>  </div></div>');
        MaterialService.list();
      }
    });
  },

  add: function(material){
    $.ajax({
      url: 'rest/services/material/'+$('#id').val(),
      type: 'POST',
      data: JSON.stringify(material),
      contentType: 'application/json',
      dataType: "json",
      success: function(result){
        $("#exampleModal3").modal("hide");
        $("#material-list").html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" style="width : 5rem ; height : 5rem;" role="status"> <span class="sr-only"></span>  </div></div>');
        //console.log(data);
        MaterialService.list();
      }
    });
  },
  delete: function(id){
    $('.delete-material-button').attr('disabled', true);

    $.ajax({
      url: 'rest/services/material/'+$('#id-delete-modal').val(),
      type: 'DELETE',
      contentType: 'application/json',
      dataType: "json",
      success: function(result){
        $("#exampleModal2").modal("hide");
        $('.delete-material-button').attr('disabled', false);
        $("#material-list").html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" style="width : 5rem ; height : 5rem;" role="status"> <span class="sr-only"></span>  </div></div>');
        MaterialService.list();
      }
    });
  }
}
