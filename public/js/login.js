function Show() {
    var x = document.getElementById('login-pass');
    if (x.type === 'password') 
    {
      x.type = "text";
      $('#eyeShow').show();
      $('#eyeSlash').hide();
    }
    else 
    {
      x.type = "password";
      $('#eyeShow').hide();
      $('#eyeSlash').show();
    }
  }