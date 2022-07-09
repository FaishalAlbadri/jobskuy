function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#display_project_image").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

$(document).ready(function () {
  $("#provinsi").change(function () {
    $("img#load1").show();
    var id_provinces = $(this).val();
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "data-wilayah.php?jenis=kota",
      data: "id_provinces=" + id_provinces,
      success: function (msg) {
        $("select#kota").html(msg);
        $("img#load1").hide();
        getAjaxKota();
      },
    });
  });

  $("#kota").change(getAjaxKota);
  function getAjaxKota() {
    $("img#load2").show();
    var id_regencies = $("#kota").val();
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "data-wilayah.php?jenis=kecamatan",
      data: "id_regencies=" + id_regencies,
      success: function (msg) {
        $("select#kecamatan").html(msg);
        $("img#load2").hide();
        getAjaxKecamatan();
      },
    });
  }

  $("#kecamatan").change(getAjaxKecamatan);
  function getAjaxKecamatan() {
    $("img#load3").show();
    var id_district = $("#kecamatan").val();
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "data-wilayah.php?jenis=kelurahan",
      data: "id_district=" + id_district,
      success: function (msg) {
        $("select#kelurahan").html(msg);
        $("img#load3").hide();
      },
    });
  }

  (function () {
    document.getElementById("min_price_value").onchange = function () {
      konversiRupiah("Min");
    };
  })();

  (function () {
    document.getElementById("max_price_value").onchange = function () {
      konversiRupiah("Max");
    };
  })();

  function konversiRupiah(id) {
    var number;
    var output;
    if (id == "Max") {
      var number = document.getElementById("max_price_value");
      var output = document.getElementById("max_price");
    } else {
      var number = document.getElementById("min_price_value");
      var output = document.getElementById("min_price");
    }
    const numb = number.value;
    const format = numb.toString().split("").reverse().join("");
    const convert = format.match(/\d{1,3}/g);
    const rupiah = convert.join(".").split("").reverse().join("");
    console.log();
    output.innerHTML = id + " Harga " + "Rp. " + rupiah;
  }
});
