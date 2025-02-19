

// validation box

var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// validation box on click

myInput.onfocus =function(){
    document.getElementById("validation_box").style.display="block";
}

// hide the validation box outside of password field

myInput.onblur =function(){
    document.getElementById("validation_box").style.display="none";
}

//when user starts to type password
myInput.onkeyup = function(){

    // lowercase
    if(myInput.value.match(/[a-z]/)){
        letter.style.color = 'green'
    }else{
        letter.style.color = 'red'
    }

    // uppercase
    if(myInput.value.match(/[A-Z]/)){
        capital.style.color = 'green'
    }else{
        capital.style.color = 'red'
    }

    // number
    if(myInput.value.match(/[0-9]/)){
        number.style.color = 'green'
    }else{
        number.style.color = 'red'
    }

    // uppercase
    if(myInput.value.length >= 8){
        characters.style.color = 'green'
    }else{
        characters.style.color = 'red'
    }
}


const showpass = document.querySelector("#show-password");
const showpass2 = document.querySelector("#show-password2");
const showcode = document.querySelector("#show-code");


const passwordField = document.querySelector("#psw");
const confirmpass = document.querySelector("#cpass");
const codekey = document.querySelector("#codekey");


showpass.addEventListener("click" , function(){
    this.classList.toggle("fa-eye-slash");
    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);
})

showpass2.addEventListener("click" , function(){
    this.classList.toggle("fa-eye-slash");
    const type = confirmpass.getAttribute("type") === "password" ? "text" : "password";
    confirmpass.setAttribute("type", type);
})

showcode.addEventListener("click" , function(){
    this.classList.toggle("fa-eye-slash");
    const type = codekey.getAttribute("type") === "password" ? "text" : "password";
    codekey.setAttribute("type", type);
})




