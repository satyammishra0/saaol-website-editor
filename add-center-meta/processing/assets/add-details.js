$(document).ready(function () {
  let loader_container = document.getElementById("loader-container");
  $("#addMetaForm").submit(function (event) {
    event.preventDefault();
    loader_container.style.display = "grid";
    let formData = new FormData(this);

    $.ajax({
      method: "POST",
      url: "./processing/add.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status === "success") {
          alert(data.message);
          loader_container.style.display = "none";
          window.location.href = "https://saaol.com/seo/add-center-meta/city-details.php";
        } else {
          alert(data.message);
          loader_container.style.display = "none";
          window.location.href = "https://saaol.com/seo/add-center-meta/city-details.php";
        }
      },
      error: function (error) {
        loader_container.style.display = "none";
      },
    });
  });
});
