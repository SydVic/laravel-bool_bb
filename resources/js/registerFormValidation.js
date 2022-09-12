document.getElementById('submit-button').disabled = true;

const validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

let email = '';
const emailListener = document.getElementById('email').addEventListener('keyup', function() {
  email = document.getElementById('email').value;
  console.log(email);

  const emailMessageContainer = document.getElementById('email-validation');
  if (!email.match(validRegex)) {
    emailMessageContainer.innerHTML = `L'email, deve rispettare il formato example@host.com`;
    console.log("L'email deve rispettare il formato example@host.it");
  } else {
    emailMessageContainer.innerHTML = ``;
    console.log('password valida');
  }
});


let password = '';
const passwordListener = document.getElementById('password').addEventListener('keyup', function() {
  password = document.getElementById('password').value;
  let passwordLength = password.length;

  const messageLengthContainer = document.getElementById('password-length');
  if ( passwordLength < 8 ) {
    messageLengthContainer.innerHTML = `La password deve essere almeno 8 caratteri`;
  } else if (passwordLength >= 8) {
    messageLengthContainer.innerHTML = ``;
    if (email.match(validRegex) && passwordConfirm == password) {
      document.getElementById('submit-button').disabled = false;
    }
  }
});


let passwordConfirm = '';
const passwordConfirmListener = document.getElementById('password-confirm').addEventListener('keyup', function() {
  passwordConfirm = document.getElementById('password-confirm').value;

  const messageContainer = document.getElementById('message');
  if ( passwordConfirm === password ) {
    messageContainer.innerHTML = ``;
    if (email.match(validRegex) && passwordConfirm == password) {
      document.getElementById('submit-button').disabled = false;
    }
  } else {
    messageContainer.innerHTML = `Le password non corrispondono.`;
  }
});