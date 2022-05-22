var workwear = {
    init: function(){
        $('#addmaterialsForm').validate({
            submitHandler: function(form){
              var material = Object.fromEntries((new FormData(form)).entries())
              workwear.add(material);
            }
          });
          workwear.list();
    },

    list: function(){
        $.get('rest/material',function(data){
            $("#material-list").html("");

            var html="";
            for(let i=0;i<data.length;i++){

                html+=`
                <div class="col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">`+data[i].name+`</h4>
                        <h6 class="card-title">`+data[i].color+`</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary material-button" onclick="workwear.get(`+data[i].id+`)">View Info</button>
                            <button type="button" class="btn btn-danger material-button" onclick="workwear.delete(`+data[i].id+`)">Delete</button>
                        </div>
                    </div>
                    </div>
                    </div>`;
            }
            $("#material-list").html(html);
        });
    },

    get: function(id){
        $(".material-button").attr("disabled",true);
        $.get('rest/material/'+id,function(data){
            console.log(data);
            //$("#exampleModal .modal-body").html(id);
            $("#id").val(data.id);
            $("#name").val(data.name);
            $("#color").val(data.color);
            $("#length").val(data.length);
            $("#available").val(data.available);
            $("#exampleModal").modal("show")
            $(".material-button").attr("disabled",false);

        })
    },

    add: function(material){
        $.ajax({
            url:'rest/material',
            type:'POST',
            data:JSON.stringify(material),
            contentType:'application/json',
            dataType:'json',
            success:function(result){
              $('#material-list').html(`<div id="material-list" class="row">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                          <span class="sr-only"></span>
                        </div>
                    </div>
                </div>`);
              $("#addElement").modal("hide");
              workwear.list();
              console.log(result);
            }
          })
    },

    delete: function(id){
     $(".material-button").attr("disabled",true);
    $.ajax({
      url:'rest/material/'+id,
      type:'DELETE',
      success: function(result){
        $('#material-list').html(`<div id="material-list" class="row">
              <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                  </div>
              </div>
          </div>`)
          workwear.list();
      }
    })
    },

    update: function(id){
        $(".material-button").attr("disabled",true);
        var material={};
        material.name=$("#name").val();
        material.color=$("#color").val();
        material.length=$("#length").val();
        material.available=$("#available").val();

        $.ajax({
          url:'rest/material/'+$("#id").val(),
          type:'PUT',
          data:JSON.stringify(material),
          contentType:'application/json',
          dataType:'json',
          success: function(result){
            $("#exampleModal").modal("hide");
            $(".material-button").attr("disabled",false);
            $('#material-list').html(`<div id="material-list" class="row">
                  <div class="d-flex justify-content-center">
                      <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                      </div>
                  </div>
              </div>`)
              workwear.list();
          }
        })
    }
}
