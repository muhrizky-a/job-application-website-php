function toggleOldPassword() {
    const input = document.querySelector("input[name='oldpassword']");
    if (input.type == "password") {
        input.type = "text";
        document.querySelector("#show-oldpwd").className = "fa fa-eye-slash";
    } else {
        input.type = "password";
        document.querySelector("#show-oldpwd").className = "fa fa-eye";
    }
}

function togglePassword() {
    const input = document.querySelector("input[name='password']");
    if (input.type == "password") {
        input.type = "text";
        document.querySelector("#show-pwd").className = "fa fa-eye-slash";
    } else {
        input.type = "password";
        document.querySelector("#show-pwd").className = "fa fa-eye";
    }
}

function toggleConfirmPassword() {
    const input = document.querySelector("input[name='cpassword']");
    if (input.type == "password") {
        input.type = "text";
        document.querySelector("#show-cpwd").className = "fa fa-eye-slash";
    } else {
        input.type = "password";
        document.querySelector("#show-cpwd").className = "fa fa-eye";
    }
}

const imgProfilePic = document.querySelector(".profile-pic");
const imgUploadBtn = document.querySelector(".profile-pic-upload");

imgProfilePic.onclick = evt => {
    imgUploadBtn.click();
}

imgUploadBtn.onchange = evt => {
    const [file] = imgUploadBtn.files;
    if (file) {
        imgProfilePic.src = URL.createObjectURL(file);
    }
}