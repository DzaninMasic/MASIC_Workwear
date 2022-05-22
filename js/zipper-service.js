var ZipperService = {
  init: function(){
    $('#addMaterialForm').validate({
      submitHandler:function(form){
        var zippers = Object.fromEntries((new FormData(form)).entries());
        ZipperService.add(zippers);
      }
    });//JQUERY VALIDATION
    ZipperService.list();
  },

  list: function(){
    $.get("rest/services/zippers/", function( data ){
      $("#zipper-list").html("");
      var html="";
      for(let i=0;i<data.length;i++){
        html+=`
        <div class="col-lg-3" style="padding:15px">
            <div class="card">
              <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17ff3c8cf14%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17ff3c8cf14%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.19140625%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">`+ data[i].name +`</h5>
                <p class="card-text">`+ data[i].available +`: Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p>
                  <button type="button" class="btn btn-primary material-button" onclick="MaterialService.get(`+data[i].id+`)">
                    Edit material
                  </button>
                  <button type="button" class="btn btn-primary material-button-delete" onclick="showModalDelete(`+data[i].id+`)">
                    Delete material
                  </button>
                </p>
              </div>
            </div>
          </div>`;
      }
      html += `<button style="margin: 15px" type="button" class="btn btn-success" onclick="showModalAdd()">
        Add material
      </button>`;
      $("#zipper-list").html(html);
    });
  },

  get: function(id){
    $('.material-button').attr('disabled', true);
    $('.material-button-delete').attr('disabled', true);
    $.get("rest/services/material/"+id,function(data){
      console.log(data);
      $("#name").val(data.name);
      $("#id").val(data.id);
      //$("#color").val(data.color);
      $("#length").val(data.length);
      $("#available").val(data.available);
      $("#color_id").val(data.color_name);
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
    //material.color=$('#color').val();
    material.color_id=$('#color_id').val();
    material.length=$('#length').val();
    material.available=$('#available').val();

    $.ajax({
      url: 'rest/services/material/'+$('#id').val(),
      type: 'PUT',
      data: JSON.stringify(material),
      contentType: 'application/json',
      dataType: "json",
      success: function(result){
        toastr.success("Material updated!");
        $("#exampleModal").modal("hide");
        $('.save-material-button').attr('disabled', false);
        $("#material-list").html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" style="width : 5rem ; height : 5rem;" role="status"> <span class="sr-only"></span>  </div></div>');
        MaterialService.list();
      }
    });
  },

  add: function(material){
    console.log("Nas log",material);
    let temp=document.getElementById("select-color").value;
    console.log("testbest",temp);

    $.ajax({
      url: 'rest/services/material/'+$('#id').val(),
      type: 'POST',
      data: JSON.stringify({...material,color_id:temp}),
      contentType: 'application/json',
      dataType: "json",
      success: function(result){
        toastr.success("Material added!");
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
        toastr.success("Material deleted!");
        $("#exampleModal2").modal("hide");
        $('.delete-material-button').attr('disabled', false);
        $("#material-list").html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" style="width : 5rem ; height : 5rem;" role="status"> <span class="sr-only"></span>  </div></div>');
        MaterialService.list();
      }
    });
  }
}
