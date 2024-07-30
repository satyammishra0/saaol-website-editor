let states = [
  "Andhra Pradesh",
  "Assam",
  "Bihar",
  "Chhattisgarh",
  "New Delhi",
  "Jharkhand",
  "Goa",
  "Gujarat",
  "Haryana",
  "Karnataka",
  "Kerala",
  "Maharashtra",
  "Madhya Pradesh",
  "Odisha",
  "Punjab",
  "Rajasthan",
  "Tamil Nadu",
  "Telangana",
  "Uttarakhand",
  "Uttar Pradesh",
  "West Bengal",
];

function populateStates() {
  let selectStateName = document.getElementById("selectStateName");

  for (let i = 0; i < states.length; i++) {
    let stateOptions = document.createElement("option");
    selectStateName.appendChild(stateOptions);
    stateOptions.value = states[i];
    stateOptions.innerText = states[i];
  }
}

populateStates();

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
          location.reload();
        } else {
          alert(data.message);
          loader_container.style.display = "none";
        }
      },
      error: function (error) {
        console.log(error);
        loader_container.style.display = "none";
      },
    });
  });
});
