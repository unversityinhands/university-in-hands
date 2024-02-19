let signInDiv = document.querySelector(".container .user-info .signin");
let signUpDiv = document.querySelector(".container .user-info .signup");
let notUserDiv = document.querySelector(".container .not-user span "); 
let passowrdForget = document.querySelector('.container form .forget-pass');

signInDiv.onclick = ()=>{
  window.location.href = "../php/signin.php";
}
signUpDiv.onclick = ()=>{
  window.location.href = "../php/signup.php";
}
notUserDiv.onclick = () => {
  window.location.href = "../php/signup.php";
}

passowrdForget.onclick = () => {
  window.location.href = "../php/forget_password.php";
}
