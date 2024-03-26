document.addEventListener("DOMContentLoaded", function () {
  const passwordVisibility = document.getElementById("password-visibility");

  passwordVisibility.addEventListener("click", () => {
    if (passwordVisibility.innerHTML === "visibility") {
      passwordVisibility.innerHTML = "visibility_off";
    } else {
      passwordVisibility.innerHTML = "visibility";
    }
  });
});
