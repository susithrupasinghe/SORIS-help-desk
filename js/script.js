/* Sign Out button color */

var signout = document.getElementById("logout");
signout.addEventListener("mouseover", function() {
    this.getElementsByTagName("h4")[0].style.color = "#08a73a";
  });

  signout.addEventListener("mouseout", function() {
    this.getElementsByTagName("h4")[0].style.color = "#FFFFFF";
  });



