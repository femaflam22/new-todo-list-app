const sign_in = document.querySelector("#signIn-btn");
const sign_up = document.querySelector("#signUp-btn");
const container = document.querySelector(".wrap");

sign_up.addEventListener('click', () => {
    container.classList.add("signUp-mode");
});

sign_in.addEventListener('click', () => {
    container.classList.remove("signUp-mode");
});