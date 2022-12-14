// Enable tooltips everywhere
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new coreui.Tooltip(tooltipTriggerEl)
})


const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");
if (togglePassword != null) {
    togglePassword.addEventListener("click", function() {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
}


function isNumber(event) {
    var allowed = "";
    if (event.target.value.includes(".")) {
        allowed = "0123456789";
    } else {
        allowed = "0123456789.";
    }
    if (!allowed.includes(event.key)) {
        event.preventDefault();
    }
}

document.querySelectorAll('.number_input').forEach(el => {
    el.addEventListener('keypress', isNumber);
});
