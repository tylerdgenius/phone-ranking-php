document.addEventListener("DOMContentLoaded", function () {
  const passwordVisibility = document.getElementById("password-visibility");

  passwordVisibility.addEventListener("click", () => {
    if (passwordVisibility.innerHTML === "visibility") {
      passwordVisibility.innerHTML = "visibility_off";
    } else {
      passwordVisibility.innerHTML = "visibility";
    }
  });

  const emailNode = document.getElementById("emailInput");
  const emailErrorNode = document.getElementById("emailError");

  emailNode.addEventListener("change", (e) => {
    if (emailErrorNode && !emailErrorNode.classList.contains("d-none")) {
      emailErrorNode.classList.add("d-none");
    }
  });

  if (window.location.pathname.includes("register")) {
    const usernameNode = document.getElementById("usernameInput");
    const usernameErrorNode = document.getElementById("usernameError");

    usernameNode.addEventListener("change", (e) => {
      if (
        usernameErrorNode &&
        !usernameErrorNode.classList.contains("d-none")
      ) {
        usernameErrorNode.classList.add("d-none");
      }
    });
  }

  const passwordNode = document.getElementById("passwordInput");
  const passwordErrorNode = document.getElementById("passwordError");

  passwordNode.addEventListener("change", (e) => {
    if (passwordErrorNode && !passwordErrorNode.classList.contains("d-none")) {
      passwordErrorNode.classList.add("d-none");
    }
  });
});
