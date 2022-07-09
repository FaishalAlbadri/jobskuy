var slider = document.getElementById("bidSlider");
var output = document.getElementById("bidPrice");

const numb = slider.value;
const format = numb.toString().split("").reverse().join("");
const convert = format.match(/\d{1,3}/g);
const rupiah = "Tawar Rp " + convert.join(".").split("").reverse().join("");

output.innerHTML = rupiah; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function () {
  const numb = this.value;
  const format = numb.toString().split("").reverse().join("");
  const convert = format.match(/\d{1,3}/g);
  const rupiah = "Tawar Rp " + convert.join(".").split("").reverse().join("");
  output.innerHTML = rupiah;
};

function bid(id, email, username, title) {
  var url = "../detail/bid.php";
  var slider = document.getElementById("bidSlider");

  $.blockUI({ message: null });

  var xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    var msg = this.responseText;
    if (msg == "success") {
      location.reload();
    } else {
      alert("Gagal Menawar Pekerjaan");
    }
  };
  var data = "id=" + id + "&value=" + slider.value + "&email=" + email + "&username=" + username + "&title=" + title;
  xhr.send(data);
}
