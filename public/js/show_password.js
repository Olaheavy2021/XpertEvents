function show() {
    let passwordElement = document.getElementById('pswrd');
    let icon = document.querySelector('.fa-lock')

    if (passwordElement.type === "password") {
        passwordElement.type = "text";
        passwordElement.style.marginTop = "20px";
        icon.style.color = "#ED7014";
    } else {
        passwordElement.type = "password"
        icon.style.color = "grey";
    }
};