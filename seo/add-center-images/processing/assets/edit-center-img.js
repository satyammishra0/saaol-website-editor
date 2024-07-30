let edit_reception_img_txt = document.getElementById("edit-reception-img-txt");
edit_reception_img_txt.addEventListener("click", () => {
  let existing_reception_image = document.getElementById(
    "existing-reception-image"
  );
  let edited_reception_image_div = document.getElementById(
    "edited-reception-image-div"
  );
  edited_reception_image_div.style.display = "block";
  existing_reception_image.style.display = "none";
  edit_reception_img_txt.innerText = " ";
});

let edit_gallery_img_txt = document.getElementById("edit-gallery-img-txt");

edit_gallery_img_txt.addEventListener("click", () => {
  let existing_gallery_image = document.getElementById(
    "existing-gallery-imgs-div"
  );
  let edited_gallery_image_div = document.getElementById(
    "edited-gallery-image-div"
  );
  edited_gallery_image_div.style.display = "block";
  existing_gallery_image.style.display = "none";
  edit_gallery_img_txt.innerText = " ";
});
