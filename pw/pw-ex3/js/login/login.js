function setLocalStorageValue(key, json) {
    localStorage.setItem(key, JSON.stringify(json))
}

function getLocalStorageValue(key) {
    return JSON.parse(localStorage.getItem(key))
}

function setSessionStorageValue(key, json) {
    sessionStorage.setItem(key, JSON.stringify(json))
}

function getSessionStorageValue(key) {
    return JSON.parse(sessionStorage.getItem(key))
}

var usuarios = [] // array vazia de usuarios

const errorMessage = document.querySelector(".error-message") // html da mensagem de erro

function entrarUsuario() {
    // pega os inputs de login
    const usernameInput = document.querySelector("#username")
    const passwordInput = document.querySelector("#password")

    // se existe algum valor nos inputs
    if (usernameInput.value && passwordInput.value) {
        // pega os usuarios
        usuarios = getLocalStorageValue("users")

        // procura se existe o usuario
        var index = usuarios.findIndex((x) => usernameInput.value == x.username)
        if (index !== -1) { // se tiver
            if (usuarios[index].password == passwordInput.value) {
                // define o usuario logado como o usuario encontrado e redireciona para o index.html
                setSessionStorageValue("loggedUser", usuarios[index])
                window.location = "/index.html"
            } else { // se nao tiver
                // mostra a mensagem de erro
                errorMessage.innerHTML = "Usuário ou senha inválidos"
                passwordInput.value = ''
            }
        } else {
            // mensagem de erro para caso a pessoa nao tenha escrito nada nos inputs
            errorMessage.innerHTML = "Usuário ou senha inválidos"
            passwordInput.value = ''
        }
    }
}

// eventos de click do mouse e enter do teclado para a funcao de login
document.querySelector("#login-submit").addEventListener("click", () => entrarUsuario())
document.addEventListener("keypress", (e) => {
    if (e.key === 'Enter') {
        entrarUsuario()
    }
})
