import { choicesAlert } from "../helpers/sweetAlert2.js";

const btnSubscribeEls = document.querySelectorAll('.btn-subscribe');
btnSubscribeEls.forEach(btnSubscribeEl => {
    btnSubscribeEl.addEventListener('click', () => {
        const title = "If you already have an account, click 'Login'. If not, choose 'Signup'";
        choicesAlert(title, "Login", "Signup", () => location.href = '../page/login.php', () => location.href = '../page/signup.php');
    })
});