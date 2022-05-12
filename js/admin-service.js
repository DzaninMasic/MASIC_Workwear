var AdminService = {
  init: function(){
    var token=localStorage.getItem("token");

    if(token){
      window.location.replace("index.html");
    }

    $('#login-form').validate({
      submitHandler:function(form){
        var login = Object.fromEntries((new FormData(form)).entries());
        AdminService.login(login);
      }
    });
  },

  login: function(login){
    $.ajax({
      url: 'rest/services/login',
      type: 'POST',
      data: JSON.stringify(login),
      contentType: 'application/json',
      dataType: "json",
      success: function(result){
        console.log(result);
        localStorage.setItem("token", result.token);
        window.location.replace("index.html");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
      }
    });
  },

  logout: function(){
    localStorage.clear();
    window.location.replace("login.html");
  }
}
