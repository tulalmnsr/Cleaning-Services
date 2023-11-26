//TODO : Its a Completed Code
function formvalid() {
    var vaildpass = document.getElementById("pass").value;
    if (vaildpass.length <= 8 || vaildpass.length >= 20) {
      document.getElementById("vaild-pass").innerHTML = "Minimum 8 characters";
      return false;
    } else {
      document.getElementById("vaild-pass").innerHTML = "";
    }
  }
function show() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
      x.type = "text";
      document.getElementById("showimg").src =
        "https://static.thenounproject.com/png/777494-200.png";
    } else {
      x.type = "password";
      document.getElementById("showimg").src =
        "https://cdn2.iconfinder.com/data/icons/basic-ui-interface-v-2/32/hide-512.png";
    }
  }
  function validate() {
    const email = document.getElementById("email").value;
     password=document.getElementById("password");
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(email==""){
        document.getElementById('email-errormsg').innerHTML="Email field must be filled out";
        return false;
    }else{
        if (emailRegex.test(email)) {
            document.getElementById('email-errormsg').innerHTML="";
            return true;
        }else{
            document.getElementById('email-errormsg').innerHTML="** Username is Invalid";
            return false;
        }
    }
}