if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#display_user_image").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
