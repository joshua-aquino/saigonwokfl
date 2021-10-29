var timer;

function delayShowUser(str) {
  clearTimeout(timer);
  timer=setTimeout(function validate(){
    showUser(str);
  },250);
}

function showUser(str) {
  if (str == "") {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("menuList").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","themenu.php?q=_",true);
    xmlhttp.send();
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("menuList").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","themenu.php?q="+str,true);
    xmlhttp.send();
  }
}