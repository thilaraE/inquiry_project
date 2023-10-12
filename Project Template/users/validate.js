function validateForm() {
    var name = document.getElementById("firstname").value;
    var dob = document.getElementById("dob").value;
    var state = document.getElementById("state").value;
    var postcode = document.getElementById("postcode").value;

    if (firstname === "") {
        alert("Name field is required!");
        return false;
    }

    if (lastname === "") {
        alert("Name field is required!");
        return false;
    }


    if (dob === "") {
        alert("Date of Birth field is required!");
        return false;
    }

    if (state === "") {
        alert("State field is required!");
        return false;
    }

    if (postcode === "") {
        alert("Post Code field is required!");
        return false;
    }

    
    return true;
}
