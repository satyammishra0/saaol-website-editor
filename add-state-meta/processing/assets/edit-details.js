let states = [
  "Andhra Pradesh",
  "Assam",
  "Bihar",
  "Chattisgarh",
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

let edit_city_btn = document.getElementById("edit-city-btn");
let select_city_parent = document.getElementById("select-city-parent");

// Hiding and sidplaying the select and button
edit_city_btn.addEventListener("click", (event) => {
  let edit_city_parent = document.getElementById("edit-city-parent");
  edit_city_parent.style.display = "none";
  select_city_parent.style.display = "block";
});

// Code to handel form submission
$(document).ready(function () {
  let loader_container = document.getElementById("loader-container");

  $("#editMetaForm").submit(function (event) {
    event.preventDefault();

    loader_container.style.display = "grid";
    let formData = new FormData(this);

    $.ajax({
      method: "POST",
      url: "./processing/edit.php",
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
        alert(error);
        loader_container.style.display = "none";
      },
    });
  });
});
