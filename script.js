let selected = null;

document.getElementById("admin-login").addEventListener("click", function() {
    selected = "admin";
    document.getElementById("role").value = "admin"; // Set hidden input value
    selectButton(this);
});

document.getElementById("employee-login").addEventListener("click", function() {
    selected = "user";
    document.getElementById("role").value = "user"; // Set hidden input value
    selectButton(this);
});

document.getElementById("login-form").addEventListener("submit", function(event) {
    if (!selected) {
        event.preventDefault();
        alert("Please select a user type.");
    }
});

function selectButton(button) {
    document.querySelectorAll(".login-option").forEach(btn => {
        btn.classList.remove("selected");
    });
    button.classList.add("selected");
}
