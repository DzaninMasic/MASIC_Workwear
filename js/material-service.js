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
    $.ajax({
      url: "rest/material",
      type: "GET",
      beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
      success: function(data){
        $("#material-list").html("");
        var html="";
        for(let i=0;i<data.length;i++){
          html+=`
          <div class="col-lg-3" style="padding:15px">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title" style="padding:50px; background-color:`+data[i].color_name+`;color:white;text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; text-align:center">`+ data[i].type_name +`</h5>
                  <p>
                    <p style="margin-bottom:0px">Brand: `+ data[i].brand_name +`</p>
                    <p style="margin-bottom:0px">Length: `+ data[i].length +`</p>
                    <p>Available: `+ data[i].available +`</p>
                    <button type="button" class="btn btn-primary material-button" onclick="MaterialService.get(`+data[i].id+`)">
                      Edit material
                    </button>
                    <button type="button" class="btn btn-danger material-button-delete" onclick="showModalDelete(`+data[i].id+`)">
                      Delete material
                    </button>
                  </p>
                </div>
              </div>
            </div>`;
        }
        html += `<button style="margin: 15px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal3"">
          Add material
        </button>`;
        $("#material-list").html(html);
      },
    });
  },

  get: function(id){
    $('.material-button').attr('disabled', true);
    $('.material-button-delete').attr('disabled', true);
    let options="";
    let options2="";
    let options3="";
    $.ajax({
      url: 'rest/colors/',
      type: "GET",
      beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
      success: function(data){
        for(let i=0;i<data.length;i++){
          options+=`<option value="${data[i].id}">${data[i].name}</option>`
        }
        document.getElementById("color_id").innerHTML=options;
        $.ajax({
          url: 'rest/types/',
          type: "GET",
          beforeSend: function(xhr){
            xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
          },
          success: function(data){
            for(let i=0;i<data.length;i++){
              options2+=`<option value="${data[i].id}">${data[i].name}</option>`
            }
            document.getElementById("type_id").innerHTML=options2;
            $.ajax({
              url: 'rest/brands/',
              type: "GET",
              beforeSend: function(xhr){
                xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
              },
              success: function(data){
                for(let i=0;i<data.length;i++){
                  options3+=`<option value="${data[i].id}">${data[i].name}</option>`
                }
                document.getElementById("brand_id").innerHTML=options3;
                $.ajax({
                  url: 'rest/material/'+id,
                  type: "GET",
                  beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
                  },
                  success: function(data){
                    console.log(data);
                    $('#brand_id option[value="'+data.brand_id+'"]').prop('selected', true);
                    $('#type_id option[value="'+data.type_id+'"]').prop('selected', true);
                    $("#id").val(data.id);
                    $("#length").val(data.length);
                    $("#available").val(data.available);
                    $('#color_id option[value="'+data.color_id+'"]').prop('selected', true);
                    $("#exampleModal").modal("show");
                    $('.material-button').attr('disabled', false);
                    $('.material-button-delete').attr('disabled', false);
                  },
                });
              },
            });
          },
        });
      },
    });
  },

  update: function(){
    $('.save-material-button').attr('disabled', true);
    var material={};
    material.brand_id=$('#brand_id').val();
    material.type_id=$('#type_id').val();
    material.color_id=$('#color_id').val();
    material.length=$('#length').val();
    material.available=$('#available').val();

    $.ajax({
      url: 'rest/material/'+$('#id').val(),
      type: 'PUT',
      data: JSON.stringify(material),
      contentType: 'application/json',
      dataType: "json",
      beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
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
    let temp2=document.getElementById("select-type").value;
    let temp3=document.getElementById("select-brand").value;
    console.log("testbest",temp);
    console.log("testbest2",temp2);
    console.log("testbest3",temp3);

    $.ajax({
      url: 'rest/material',
      type: 'POST',
      data: JSON.stringify({...material,color_id:temp,type_id:temp2,brand_id:temp3}),
      contentType: 'application/json',
      dataType: "json",
      beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
      success: function(result){
        toastr.success("Material added!");
        $("#exampleModal3").modal("hide");
        $("#material-list").html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" style="width : 5rem ; height : 5rem;" role="status"> <span class="sr-only"></span>  </div></div>');
        //console.log(data);
        MaterialService.list();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
      }
    });
  },
  delete: function(id){
    $('.delete-material-button').attr('disabled', true);

    $.ajax({
      url: 'rest/material/'+$('#id-delete-modal').val(),
      type: 'DELETE',
      contentType: 'application/json',
      dataType: "json",
      beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
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
