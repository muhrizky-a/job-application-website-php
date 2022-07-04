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