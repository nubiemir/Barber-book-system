 // this is used for form validation
 
 // Show input error message
 function displayError(input, message) {
    const formControl = input.parentElement;
    formControl.className = "form-control error";
    const small = formControl.querySelector("small");
    small.innerText = message;
  }

  // Show success outline
  function displaySuccess(input) {
    const formControl = input.parentElement;
    formControl.className = "form-control success";
  }

  function requiredCheck(inputList) { // function to check that the input is not empty
    let required = false;
    inputList.forEach((input) => {
      if (!input.value.trim().length == "") {
        displaySuccess(input);
      } else {
        displayError(input, `${input.id} is required`);
        required = true;
      }
    });
    return required;
  }

  function lengthCheck(input, limit) { // function to check the length of the input is valid
    if (input.value.length < limit) {
      displayError(
        input,
        `${input.id} should be minimum of ${limit} characters`
      );
    } else {
      displaySuccess(input);
    }
  }
  function emailCheck(input) { // function to check the email is valid
    const format =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (format.test(input.value.trim())) {
      displaySuccess(input);
    } else {
      displayError(input, "Invalid E-mail");
    }
  }