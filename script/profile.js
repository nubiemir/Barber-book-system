// this is for the update and delete profile pop ups

const update = document.querySelector("#update-profile");
const modalEdit = document.querySelector(".modal_edit");
const profileWrapper = document.querySelector(".profile-wrapper");
const closeEdit = document.querySelector("#close_edit");


const deleteProfile = document.querySelector("#btn-delete-profile");
const modalDelete = document.querySelector(".modal-delete");
const closeDelete = document.querySelector("#cancel-delete");



update.addEventListener("click", () => { // update button is clicked
  modalEdit.classList.add("active"); // pop up the edit modal
  profileWrapper.classList.add("inactive"); // dim the body to make the pop up more visible
});

closeEdit.addEventListener("click", () => { // close edit modal clicked
  modalEdit.classList.remove("active"); // hide the popup of edit
  profileWrapper.classList.remove("inactive"); // make the body fully visible
});

deleteProfile.addEventListener("click", () => { // delete button is clicked
  modalDelete.classList.add("active"); // pop up the delete modal
  profileWrapper.classList.add("inactive"); // dim the body to make the pop up more visible
});

closeDelete.addEventListener("click", () => { // close button is clicked
  modalDelete.classList.remove("active"); // hide delete pop up
  profileWrapper.classList.remove("inactive"); // make the body fully visible
});









function updateProfile(){
  // update user profile
  console.log('update')
}