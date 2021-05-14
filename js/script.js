/* Sign Out button color */

var signout = document.getElementById("logout");
signout.addEventListener("mouseover", function() {
    this.getElementsByTagName("h4")[0].style.color = "#08a73a";
  });

  signout.addEventListener("mouseout", function() {
    this.getElementsByTagName("h4")[0].style.color = "#FFFFFF";
  });

/* Alert Box Close button events */

  var close = document.getElementsByClassName("closebtn");
  var i;
  
  for (i = 0; i < close.length; i++) {


    close[i].addEventListener("click",function(){
      var div = this.parentElement;
      div.style.opacity = "0";
      setTimeout(function(){ div.style.display = "none"; }, 600)
    });
  }



