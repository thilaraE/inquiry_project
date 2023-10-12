// apply.js


// Function to validate the date of birth (dd/mm/yyyy format)
function validateDOB() {
    var dobField = document.getElementById("dob");
    var dobValue = dobField.value;
    var dobRegex = /^\d{2}\/\d{2}\/\d{4}$/;
    var dobParts = dobValue.split("/");
}
  
    // check the format of the date 
    if (!dobRegex.test(dobValue)) {
      alert("follow the correct fotmat of the Date of Birth filed");
      dobField.focus();
      return false;
    }
    // Function to validate state and postcode
function checkPostcode() {
    const postcodeField = document.getElementById("postcode");
    const stateField = document.getElementById("state");
    var postCodeValue = postcodeField.value;
    var stateValue = stateField.value;
    const statesToPost = {
      VIC: ["3", "8"],
      NSW: ["1", "2"],
      QLD: ["4", "9"],
      NT: ["0"],
      WA: ["6"],
      SA: ["5"],
      TAS: ["7"],
      ACT: ["0"]
    }
  
    var selectedState = statesToPost[stateValue]
  
    if (selectedState[0] == postCodeValue[0] || selectedState[1] == postCodeValue[0]) {
    } else {
      alert("the postcode is not related to state");
      postcodeField.focus();
      return false;
    }
    return true;
  }
  // Function to perform overall validation
 function validateForm() {
  return validateDOB() && checkPostcode() && checkFeiled();
}

//listiner for form + pre-fill if exsit 
 document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  if (userDetailsJSON) {
    const userDetails = JSON.parse(userDetails);

  // Pre-fill form fields with user details
  document.getElementById("firstName").value = userDetails.firstName || "";
  document.getElementById("lastName").value = userDetails.lastName || "";
  document.getElementById("dob").value = userDetails.dob || "";
  document.getElementById("state").value = userDetails.state || "";
  document.getElementById("postcode").value = userDetails.postcode || "";
  document.getElementById("email").value = userDetails.email || "";

  // Check and pre-fill skills
  const skills = document.querySelectorAll('input[name="skills"]');
  skills.forEach((skill) => {
    if (userDetails.skills && userDetails.skills.includes(skill.value)) {
      skill.checked = true;
    }
  });
}
  if (!validateForm()) {
    event.preventDefault(); // Prevent form submission if validation fails
  }
});

