// Function to validate the email format
function isEmailValid(email) {
    // Use a regular expression to check if the email matches a valid format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Function to handle form submission
function validateForm() {
    // Get the values of the email and password fields
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Check if the email and password fields are empty
    if (email.trim() === "") {
        alert("Email is required.");
        return false; // Prevent form submission
    }

    if (password.trim() === "") {
        alert("Password is required.");
        return false; // Prevent form submission
    }

    // Check if the email is in a valid format
    if (!isEmailValid(email)) {
        alert("Invalid email format.");
        return false; // Prevent form submission
    }

    // Here, you can add additional validation logic if needed
    // For example, checking password strength, etc.

    // If all checks pass, allow the form submission
    return true;
}
