var idProject = "";
var idUser = "";

function showModalAcceptedBidder(idProject, idUser, userName) {
  this.idProject = idProject;
  this.idUser = idUser;
  $("#modalBodyContentAccepted").html("Apakah anda yakin memilih <b>" + userName + "</b> sebagai pekerja anda?");
  $("#modalAcceptedBidder").modal("show");
}

function showModalFinishedBidder(idProject, idUser, userName) {
  this.idProject = idProject;
  this.idUser = idUser;
  $("#modalBodyContentFinished").html("Apakah pekerjaan yang diberikan kepada <b>" + userName + "</b> telah selesai dikerjakan?");
  $("#modalFinishedBidder").modal("show");
}

function hireWorker() {
  $("#modalAcceptedBidder").modal("hide");
  var url = "hire.php";
  $.blockUI({ message: null });

  var xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    var msg = this.responseText;
    if (msg == "success") {
      location.reload();
    } else {
      alert(msg);
      $.unblockUI();
    }
  };
  var data = "id_project=" + idProject + "&id_user=" + idUser;
  xhr.send(data);
}

function finishedProject() {
  $("#modalFinishedBidder").modal("hide");
  var url = "finished.php";
  $.blockUI({ message: null });

  var xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    var msg = this.responseText;
    if (msg == "success") {
      location.reload();
    } else {
      alert("Gagal Menyelesaikan Pekerjaan");
      $.unblockUI();
    }
  };
  var data = "id_project=" + idProject + "&id_user=" + idUser;
  xhr.send(data);
}
