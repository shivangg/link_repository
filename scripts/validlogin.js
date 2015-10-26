window.onload=initPage;

function initPage () {
	 document.getElementById("user_login_entry").onkeyup = checkUsername;
  //document.getElementById("user_login_entry").onkeyup = checkEmail;
  //document.getElementById("user_login_entry").onkeyup  = checkMobile;
  document.getElementById("loginPicture").src = "Users/nonepic.jpg";
}


function checkUsername() {
  document.getElementById("user_login_entry").className = "field form-control thinking";
  request = createRequest();
  if (request == null)
    alert("Unable to create request");
  else {
    var theName = document.getElementById("user_login_entry").value;
    var user_login_entry = escape(theName);
    var url= "checkLoginName.php?user_login_entry=" + user_login_entry;
    request.onreadystatechange = showImage;
    request.open("GET", url, true);
    request.send(null);
  }
}
function showImage() {
  
  if (request.readyState == 4) {
   if (request.status == 200) {
     // alert("inside showImage()");
     // alert(request.responseText);
      var ok="okay";
      var den="denied";
      var text=request.responseText.trim();
      if (text.indexOf("denied") > -1)     //check if denied is echoed
      {
        // alert("denied echoed");
        document.getElementById("user_login_entry").className = "field form-control denied";
        document.getElementById("user_login_entry").focus();
        document.getElementById("user_login_entry").select();
        document.getElementById("loginPicture").src = "Users/nonepic.jpg";
     
      }

      else 
      {
        //  alert("okay echoed");
        document.getElementById("user_login_entry").className = "field form-control approved";
        document.getElementById("loginPicture").src = "Users/"+text+".jpg";
      }
      //alert(text);
    }
  }
}
function checkMobile() {
  document.getElementById("user_login_entry").className = "field form-control thinking";
  request = createRequest();
  if (request == null)
    alert("Unable to create request");
  else {
    var theName = document.getElementById("user_login_entry").value;
    var user_login_entry = escape(theName);
    var url= "checkMobile.php?user_login_entry=" + user_login_entry;
    request.onreadystatechange = showMobileStatus;
    request.open("GET", url, true);
    request.send(null);
  }
}
function showMobileStatus() {
  
  if (request.readyState == 4) {
   if (request.status == 200) {
     // alert("inside showUsernameStatus()");
     // alert(request.responseText);
      var ok="okay";
      var den="denied";
      var text=request.responseText;
      if (text.indexOf("denied") > -1)     //check if denied is echoed
      {
     //   alert("okay echoed");
        document.getElementById("user_login_entry").className = "field form-control approved";
        document.getElementById("submit").disabled = false;
      }

      else 
      {
     //   alert("denied echoed");
        document.getElementById("user_login_entry").className = "field form-control denied";
        document.getElementById("user_login_entry").focus();
        document.getElementById("user_login_entry").select();
        document.getElementById("submit").disabled = true;
      }
    //  alert(text);
    }
  }
}
function checkEmail() {
  document.getElementById("user_login_entry").className = "field form-control thinking";
  request = createRequest();
  if (request == null)
   alert("Unable to create request");
  else {
    var theName = document.getElementById("user_login_entry").value;
    var user_login_entry = escape(theName);
    var url= "checkEmail.php?user_login_entry=" + user_login_entry;
    request.onreadystatechange = showEmailStatus;
    request.open("GET", url, true);
    request.send(null);
  }
}
function showEmailStatus() {
  
  if (request.readyState == 4) {
   if (request.status == 200) {
      var ok="okay";
      var den="denied";
      var text=request.responseText;
      if (text.indexOf("denied") > -1)     //check if denied is echoed
      {
   //     alert("okay echoed");
        document.getElementById("user_login_entry").className = "field form-control approved";
        document.getElementById("submit").disabled = false;
      }

      else 
      {
    //    alert("denied echoed");
        document.getElementById("user_login_entry").className = "field form-control denied";
        document.getElementById("user_login_entry").focus();
        document.getElementById("user_login_entry").select();
        document.getElementById("submit").disabled = true;
      }
    //  alert(text);
    }
  }
}
