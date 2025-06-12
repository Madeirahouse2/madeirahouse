   document.getElementById('contact-form').addEventListener('submit', function(event) {
      var hcaptchaVal = document.querySelector('[name="h-captcha-response"]').value;
      if (hcaptchaVal === "") {
        event.preventDefault();
        alert("Please complete the hCaptcha");
      }
    });
    ```