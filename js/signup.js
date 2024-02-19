let signInDiv = document.querySelector(".container .user-info .signin");
let signUpDiv = document.querySelector(".container .user-info .signup");
let notUserDiv = document.querySelector(".container .not-user span ");


signInDiv.onclick = () => {
	window.location.href = "../php/signin.php";
};
signUpDiv.onclick = () => {
	window.location.href = "../php/signup.php";
};
