// get overview
if (document.querySelector(".totals")) {
  overview();
}
function overview() {
  var totals = document.querySelectorAll(".totals");
  var xhr2 = new XMLHttpRequest();
  xhr2.open("POST", "ToDB/SRdata.php", true);
  xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr2.onload = function () {
    if (xhr2.readyState == 4 && xhr2.status == 200 && this.responseText != 2) {
      data = Array.from(JSON.parse(this.responseText));
      data.forEach((e, index) => {
        totals[index].innerHTML = e;
      });
    }
  };

  xhr2.send(JSON.stringify({ status: "overview" }));
}
if (document.querySelector(".lastest")) {
  lastestFUC();
}

function lastestFUC() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ToDB/SRdata.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  ulList = document.querySelector(".lastest-member-group");
  ulList.innerHTML = "";
  xhr.onload = function () {
    if (xhr.readyState == 4 && xhr.status == 200 && this.responseText != 2) {
      data = Array.from(JSON.parse(this.responseText));
      data.forEach((e) => {
        if (e.Regstatus == 1) {
          ulList.innerHTML =
            ulList.innerHTML +
            '<li class="list-group-item"><span>' +
            e.Username +
            '</span>  <a href="./member.php?do=edit&id=' +
            e.UserID +
            '" type="button" class="btn btn-success tb-btn"><i class="fas fa-edit"></i> Edit</a></li>';
        } else {
          ulList.innerHTML =
            ulList.innerHTML +
            '<li class="list-group-item"><span>' +
            e.Username +
            '</span>  <a href="./member.php?do=edit&id=' +
            e.UserID +
            '" type="button" class="btn btn-success tb-btn"><i class="fas fa-edit"></i> Edit</a> <a type="button" class="' +
            e.UserID +
            ' btn btn-primary tb-btn active-BB" onclick="Dele_actv_mem(this, 2)"><i class="fas fa-lock-open"></i> Active</a></li>';
        }
      });
    }
  };

  xhr.send(JSON.stringify({ status: "LastestMmember" }));
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (document.querySelector(".loginAdmin")) {
  document.querySelector(".loginAdmin").addEventListener("click", checkAdmin);
}

// to remove placeholder when foucs it
$(function () {
  $("[placeholder]")
    .focus(function () {
      $(this).attr("data-text", $(this).attr("placeholder"));
      $(this).attr("placeholder", "");
    })
    .blur(function () {
      $(this).attr("placeholder", $(this).attr("data-text"));
    });
});

// function alert to update
function alertToUpdate(err, stat) {
  var typ = "";
  if (stat === 1) typ = "success";
  else typ = "danger";

  var d = new Date();
  var time = d.getTime().toString();
  alert_update =
    '<div id="' +
    time +
    '" class="alert alert-' +
    typ +
    ' alert-dismissible fade show col-sm-12 alertt" role="alert"><strong></strong>' +
    err +
    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
  document.querySelector(".my-alert").innerHTML =
    document.querySelector(".my-alert").innerHTML + alert_update;
  setTimeout(function () {
    document.getElementById(time).remove();
  }, 800);
}
function alertTologin() {
  var d = new Date();
  var time = d.getTime().toString();
  alert_login =
    '<div id="' +
    time +
    '" class="alert alert-danger alert-dismissible fade show position-fixed col-sm-12 alertt" role="alert"><strong>Attention! </strong>username or password incorrect :(<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
  document.querySelector(".my-alert").innerHTML =
    document.querySelector(".my-alert").innerHTML + alert_login;
  setTimeout(function () {
    document.getElementById(time).remove();
  }, 2000);
}
// check admin
function checkAdmin(e) {
  e.preventDefault();
  var username = document.querySelector(".username").value;
  var password = document.querySelector(".password").value;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ToDB/SRdata.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText > 0) {
      window.location.href = "./Dashboard.php";
    } else {
      alertTologin();
    }
  };
  xhr.send(
    JSON.stringify({ username: username, password: password, status: "check" })
  );
}

// get user data to update it

function getdata(stat, ReID = 0) {
  id = "";
  if (document.querySelector(".formUpdate")) {
    id = document.querySelector(".formUpdate").id;
  }
  var xhr = new XMLHttpRequest();

  if (stat === 1) {
    xhr.open("POST", "ToDB/SRdata.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    user = "";
    email = "";
    full = "";
    xhr.onload = function () {
      if (xhr.readyState == 4 && xhr.status == 200 && this.responseText != "") {
        data = JSON.parse(this.responseText);
        document.querySelector(".username").value = data.Username;
        document.querySelector(".email").value = data.Email;
        document.querySelector(".full").value = data.Fullname;
      }
    };

    xhr.send(JSON.stringify({ id: id, status: "getdata" }));
  } else if (stat === 2) {
    // Update Member Data
    xhr.open("POST", "ToDB/SRdata.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (this.status == 200 && this.responseText > 0) {
        alertToUpdate("update seccussful", 1);
      } else if (this.responseText !== "0") {
        data = Array.from(JSON.parse(this.responseText));
        data = data.splice(1, data.length);
        data.forEach((msg) => {
          alertToUpdate(msg);
        });
      }
    };

    xhr.send(
      JSON.stringify({
        id: id,
        username: document.querySelector(".username").value,
        email: document.querySelector(".email").value,
        full: document.querySelector(".full").value,
        password: document.querySelector(".password").value,
        status: "updatedata"
      })
    );
  } else if (stat == 3) {
    // add New Member
    xhr.open("POST", "ToDB/SRdata.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (this.status == 200 && this.responseText == 1) {
        alertToUpdate("new member added", 1);
      } else {
        data = Array.from(JSON.parse(this.responseText));
        data = data.splice(1, data.length);
        data.forEach((msg) => {
          alertToUpdate(msg);
        });
      }
    };

    xhr.send(
      JSON.stringify({
        username: document.querySelector(".username").value,
        email: document.querySelector(".email").value,
        full: document.querySelector(".full").value,
        password: document.querySelector(".password").value,
        status: "addmember"
      })
    );
  } else if (stat == 4) {
    // get data for member table
    xhr.open("POST", "ToDB/SRdata.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (this.status == 200 && this.responseText != 0) {
        data = JSON.parse(this.responseText);
        data.forEach((e) => {
          var t = document.getElementById("active-table");
          var t2 = document.getElementById("pendding-table");
          if (e.Regstatus == 1) {
            var r = document.createElement("TR");
            r.innerHTML =
              "<td>" +
              e.UserID +
              "</td><td>" +
              e.Username +
              "</td><td>" +
              e.Email +
              "</td><td>" +
              e.ResDate +
              '</td><td><a href="./member.php?do=edit&id=' +
              e.UserID +
              '" type="button" class="btn btn-success tb-btn"><i class="fas fa-edit"></i> Edit</a> <a type="button" class="btn btn-danger tb-btn" onclick="Dele_actv_mem(this)"><i class="far fa-trash-alt"></i> Delete</a></td></td>';
            t.tBodies[0].appendChild(r);
          } else {
            var r = document.createElement("TR");
            r.innerHTML =
              "<td>" +
              e.UserID +
              "</td><td>" +
              e.Username +
              "</td><td>" +
              e.Email +
              "</td><td>" +
              e.ResDate +
              '</td><td><a href="./member.php?do=edit&id=' +
              e.UserID +
              '" type="button" class="btn btn-success tb-btn"><i class="fas fa-edit"></i> Edit</a> <a type="button" class="btn btn-danger tb-btn" onclick="Dele_actv_mem(this)"><i class="far fa-trash-alt"></i> Delete</a>  <a type="button" class="btn btn-primary tb-btn active-BB" onclick="Dele_actv_mem(this, 2)"><i class="fas fa-lock-open"></i> Active</a></td></td>';
            t2.tBodies[0].appendChild(r);
          }
        });
      }
    };

    xhr.send(
      JSON.stringify({
        status: "membertable"
      })
    );
  } else if (stat == 5) {
    // delete special member
    xhr.open("POST", "ToDB/SRdata.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    IfDelete = true;
    xhr.onload = function () {
      if (this.status == 200 && this.responseText > 0) {
        alertToUpdate("Deletion seccussful", 1);
      } else {
        IfDelete = false;
        data = Array.from(JSON.parse(this.responseText));
        data = data.splice(1, data.length);
        data.forEach((msg) => {
          alertToUpdate(msg);
        });
      }
    };
    xhr.send(
      JSON.stringify({
        status: "deletemember",
        Reid: ReID
      })
    );
    return IfDelete;
  } else if (stat == 6) {
    // active special member
    xhr.open("POST", "ToDB/SRdata.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    IFActive = true;
    xhr.onload = function () {
      if (this.status == 200 && this.responseText > 0) {
        alertToUpdate("Actvation seccussful", 1);
      } else {
        IFActive = false;
        data = Array.from(JSON.parse(this.responseText));
        data = data.splice(1, data.length);
        data.forEach((msg) => {
          alertToUpdate(msg);
        });
      }
    };
    xhr.send(
      JSON.stringify({
        status: "activemember",
        Reid: ReID
      })
    );
    return IFActive;
  }
}

// DOM
if (document.querySelector(".formUpdate")) getdata(1);

if (document.querySelector(".updatedata")) {
  document
    .querySelector(".updatedata")
    .addEventListener("click", preventdefault);
}

if (document.querySelector(".addmember")) {
  document
    .querySelector(".addmember")
    .addEventListener("click", preventdefault);
}

// preventDefault
function preventdefault(e) {
  e.preventDefault();
  if (e.target.className.split(" ")[0] === "addmember") {
    getdata(3);
  } else if (e.target.className.split(" ")[0] === "updatedata") {
    getdata(2);
  }
}

// get data and insert on member table
if (document.querySelector(".member-table")) {
  getdata(4);
}

// delete member on table and DB
function Dele_actv_mem(e, stat = 1) {
  if (stat == 1) {
    if (confirm("This Member will be Delete!")) {
      if (getdata(5, $(e).parent().parent()[0].cells[0].innerHTML)) {
        $(e).parent().parent().remove();
      }
    }
  } else {
    if (confirm("This Member will be Actvated!")) {
      if (
        $(e).parent().parent()[0].cells &&
        getdata(6, $(e).parent().parent()[0].cells[0].innerHTML)
      ) {
        var t = document.getElementById("active-table");
        var r = document.createElement("TR");
        r.innerHTML =
          "<td>" +
          $(e).parent().parent()[0].cells[0].innerHTML +
          "</td><td>" +
          $(e).parent().parent()[0].cells[1].innerHTML +
          "</td><td>" +
          $(e).parent().parent()[0].cells[2].innerHTML +
          "</td><td>" +
          $(e).parent().parent()[0].cells[3].innerHTML +
          '</td><td><a href="./member.php?do=edit&id=' +
          $(e).parent().parent()[0].cells[0].innerHTML +
          '" type="button" class="btn btn-success tb-btn"><i class="fas fa-edit"></i> Edit</a> <a type="button" class="btn btn-danger tb-btn" onclick="Dele_actv_mem(this)"><i class="far fa-trash-alt"></i> Delete</a></td></td>';
        t.tBodies[0].appendChild(r);
        $(e).parent().parent().remove();
      } else {
        if (getdata(6, $(e)[0].getAttribute("class").split(" ")[0])) {
          setTimeout(() => overview(), 100);
          setTimeout(() => lastestFUC(), 100);
          
        }
      }
    }
  }
}

// switch between active & pendding member
if (document.querySelector(".active-member-B")) {
  document.querySelector(".active-member-B").addEventListener("click", () => {
    document
      .querySelector(".pendding-table")
      .setAttribute("style", "display:none !important");
    document.querySelector(".active-table").style.display = "block";
  });
  document.querySelector(".pendding-member-B").addEventListener("click", () => {
    document
      .querySelector(".pendding-table")
      .setAttribute("style", "display:block !important");
    document.querySelector(".active-table").style.display = "none";
  });
}
