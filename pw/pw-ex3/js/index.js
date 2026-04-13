/* = = = = = Local Storage and Session Storage = = = = = */

function setLocalStorageValue(key/*parametro*/, json) {
    localStorage.setItem(key, JSON.stringify(json))
}
//vai citar um valor no local, transforma o json em uma string
function getLocalStorageValue(key) {
    return JSON.parse(localStorage.getItem(key))
}

function setSessionStorageValue(key, json) {
    sessionStorage.setItem(key, JSON.stringify(json))
}

function getSessionStorageValue(key) {
    return JSON.parse(sessionStorage.getItem(key))
}

function removeSessionStorageValue(key) {
    sessionStorage.removeItem(key)
}
//Funções utilitárias para simplificar o uso do localStorage/sessionStorage.

//Convertem objetos JavaScript em strings JSON para armazenamento (JSON.stringify) e vice-versa ao recuperar (JSON.parse).

//Exemplo: setLocalStorageValue("tweets", data.tweets) salva os tweets.


//fuctions para facilitar o processo, sem precisar ficar usando json parse ou json stringify, porque a local storage so armazena string


/* = = = = = Variables = = = = = */

const data = {//variaveis dentro de data, sao um objeto
    tweets: getLocalStorageValue("tweets") || [],
    usuarios: getLocalStorageValue("users") || []
}

const state = {
    loggedUser: getSessionStorageValue("loggedUser"),//usuario logado
    modal: { isOpen: false, data: {} },//modal aberto e suas informaçoes
    input: { image: "" }//vai ser usado mais tarde
}
//data: Armazena todos os tweets e usuários, carregados do localStorage.
//state: Gerencia o estado da aplicação:
//loggedUser: Usuário autenticado (armazenado na sessão).
//modal: Controla a exibição de modais (tweets/comentários).
//input: Imagem temporária para novos tweets.
/* = = = = = Utilities = = = = = */

function generateID(length) {
    const chars = `ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`
    var id = ""//vai sortear um dos caracteres de cima e jogar nesse id
    for (var i = 1; i <= length; i++) {
        var random = Math.floor(Math.random() * chars.length)//numero aleatorio baseado no tamanho do chars
        id += chars[random]//adiciona caractere
    }
    if (data.tweets.findIndex(x => x.id == id) !== -1) generateID(length)// se ele encontrar algum tweet que tenha esse id, ele vai gerar outro
    return id//retorna o id novo
}//generateID(length): Cria IDs únicos para tweets/comentários usando caracteres aleatórios.

function parseID(id) {//recebe o id
    if (id.length == 5) {//twett, 5 digitos procura nos tweets
        return data.tweets.find(x => x.id == id)//localiza os 5 primeiros digitos do tweet
    }
    if (id.length == 10) {//comentario, 10 digitos procura nos comenatrios
        return data.tweets.find(x => x.id == id.substring(0, 5)).comments.find(x => x.id == id)//depois localiza o comenario com todos os digitos
    }
}//parseID(id): Localiza um tweet/comentário baseado no tamanho do ID (5 chars = tweet, 10 chars = comentário).

function contentImageParser(content) {//exibir as imagens
    var index = content.findIndex(x => x.type == 'image')
    if (index !== -1) {
        return getLocalStorageValue(content[index].value)//cada imagem esta guardada dentro de uma chave do local.
    }
    return ""
}//o conteudo do post e formado por uma array de objetos, aqui ele vai verificar o item do tipo imagem se existir, e caso exista vai pegar o valor dele

//convertImageToBase64(file): Converte imagens para Base64 (armazenável no localStorage).
function convertImageToBase64(file) {//converter a imagem pra base 64
    return new Promise((resolve) => {
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const base64String = e.target.result;
                resolve(base64String);
            };
            reader.readAsDataURL(file);
        } else {
            resolve("");
        }
    });
}

/* = = = = = Rendering = = = = = */

function createElementHTML(tag, classes, content) {//cria elementos html
    const el = document.createElement(tag)//tag
    classes.forEach(x => el.classList.add(x))//array de classes, feito para facilitar e nao ter que ficar usando for each
    el.innerHTML = content//conteudo
    return el
}//createElementHTML: Cria qualquer elemento com classes e conteúdo.

function getTweetElementHTML(classes, image, name, content, likes) {//responde o html pro tweet
    const tweetContent = `
        <div class="tweet">
            <div class="tweet-author">
                <img src="${image}" alt="Image Profile">
            </div>
            <div class="tweet-body">
                <p class="tweet-author-name">${name}</p>
                <p class="tweet-content">${content.find(x => x.type == 'text').value}</p>
                <img class="tweet-content" src="${contentImageParser(content)}">
            </div>
        </div>
        <div class="tweet-interactions">
            <div class="like">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                <span>${likes.length}</span>
            </div>
        </div>
    `
    return createElementHTML("div", classes, tweetContent)
}//getTweetElementHTML: Gera o HTML de um tweet com imagem, texto e botões de interação.

function renderTweetGeneric(classes, image, name, id, content, likes, onClick) {//pega o elemento html
    const tweet = getTweetElementHTML(classes, image, name, content, likes)
//serve para adicionar os eventos dos botoes
    if (onClick) onClick(id, tweet)//adiciona as funçoes de click

    const likeButton = tweet.querySelector(".tweet-interactions .like")//botao de like
    if (likes.includes(state.loggedUser.id)) likeButton.classList.add("active")
    likeButton.addEventListener("click", () => likeTweet(id))

    return tweet
}

function renderTweetsListGeneric(tweets, classes, listElement, onClick) {//lista de twetts
    const tweetList = document.querySelector(listElement)
    tweetList.innerHTML = ''

    data.tweets = getLocalStorageValue("tweets")
    data.usuarios = getLocalStorageValue("users")

    tweets.forEach((tweetData) => {//cada um dos tweets na lista
        const user = data.usuarios[tweetData.author - 1]//pega o usuario que tiver o mesmo id do autor, remove menos 1 porque estamso trabalhando com numero de 1 pra mais
        const tweet = renderTweetGeneric(classes, user.image, user.name, tweetData.id, tweetData.content, tweetData.likes, onClick)
//vai gerar o tweet generico
        tweetList.append(tweet)//coloca o tweet dentro da lista
    })
}//renderTweetsListGeneric: Renderiza listas de tweets/comentários no DOM.

function reload() {//recarregar
    renderTweetsListGeneric(data.tweets, ["tweet-list-item"], ".tweet-list", (id, el) => {//quando clicar no tweet mostra isso aqui
        const tweetData = parseID(id)
        const user = data.usuarios[tweetData.author - 1]//chama a lista de cima dnv com os valores que precisamos
        el.querySelector(".tweet").addEventListener("click", () => {//abre o modal
            showTweetModal(user.image, user.name, tweetData.content, tweetData.likes, tweetData.id)//mostrar o modal do tweet
        })
    })

    if (state.modal.isOpen) renderTweetsListGeneric(parseID(state.modal.data.id).comments, ["modal-tweet-item", "comment-item"], ".comments-list")
}//se o modal estiver aberto, recarrega os comentarios
//reload(): Atualiza a interface: Renderiza tweets. Se um modal estiver aberto, renderiza seus comentários.
function reloadModal() {//se estiver aberto recarrega tudo q estiver dentro do modal
    if (state.modal.isOpen) {
        const tweet = parseID(state.modal.data.id)
        const user = data.usuarios[tweet.author - 1]
        showTweetModal(user.image, user.name, tweet.content, tweet.likes, state.modal.data.id)
    }
}

function renderLoggedUser() {//renderizar o usuario logado
    document.querySelector("#loggedUserName").innerHTML = state.loggedUser.name//nome usuario
    document.querySelector("#loggedUserImage").src = state.loggedUser.image//imagem
}//renderLoggedUser(): Exibe o nome e imagem do usuário logado.

/* = = = = = Modal Manager = = = = = */
//gerenciador de modals
const modalWrapper = document.querySelector(".modal-backdrop")//elemento html do modal

const showModal = () => {//exibir o modal e adiciona a classe visible
    modalWrapper.classList.add("visible")
    state.modal.isOpen = true//atualiza o estado do app que o modal esta aberto
}

const hideModal = () => {//vai remover a classe visible
    modalWrapper.classList.remove("visible")
    state.modal.isOpen = false//modal esta fechado
    state.modal.data = {}//limpa as infos do modal
}

modalWrapper.querySelector("#modal>.close-button").addEventListener("click", () => hideModal())
//adicionar o evento de fechar modal no cantinho
function setModalBody(content) {//definir o corpo, conteudo e uma array com os elementos html dentro
    const body = modalWrapper.querySelector(".modal-body")//antes do modal abrir a funçao vai ser chamada
    body.innerHTML = ''//corpo vazio
    content.forEach((html) => {
        body.append(html)//cada item dentro do conteudo vai ser adicionado ao corpo
    })
}//showModal()/hideModal(): Exibem/ocultam o modal.
//setModalBody(): Define o conteúdo do modal.
//showTweetModal: Exibe um tweet e seus comentários.
//showImageUploadModal: Permite fazer upload de imagens.

/* = = = = = Tweets Manager = = = = = */

// Método para criar tweets, é chamado toda vez que clicamos no botão ".tweet-submit"
function createPost() {//criar o post
    //createPost():Cria um novo tweet com texto/imagem. Armazena em data.tweets e atualiza o localStorage.
    const tweetInput = document.querySelector(".tweet-input")

    if (tweetInput.value) {// se tiver valor vai rodar isso
        if (!data.tweets) data.tweets = []//se ainda nao tiver tweets vai dizer que eles sao vazios

        var content = [{ type: 'text', value: tweetInput.value }]//valor do conteudo

        if (state.input.image) {//se o input tiver uma imagem
            var id = `image-${generateID(10)}`//gerar codigo de 10 digitos para a imagem
            setLocalStorageValue(id, state.input.image)//vai armazenar no local
            content.push({ type: 'image', value: id })//vai colocar a imagem dentro do content
        }
        
//adiciona os tweets dentro da lista de tweets, colocando o id de 5 digitos
        data.tweets.push({ id: generateID(5), author: state.loggedUser.id, content, comments: [], likes: [] })//comentarios e likes vazios
        setLocalStorageValue("tweets", data.tweets)

        tweetInput.value = ''//limpa modal

        reload()//recarrega
    }
}

// Método para criar comentários, é chamado toda vez que clicamos no botão "#submit-comment"
// Parâmetros:
//   index - Recebe o index original do tweet 
function createComment(id) {//createComment(id):Adiciona um comentário a um tweet existente. Usa parseID(id) para localizar o tweet.
    const commentInput = document.querySelector("#comment-input")

    if (commentInput.value) {//cria comentarios
       /*pega o post*/ parseID(id).comments.push({ id: id + generateID(5), author: state.loggedUser.id, content: [{ type: 'text', value: commentInput.value }], likes: [] })
        setLocalStorageValue("tweets", data.tweets)
//adiciona os comentarios
        commentInput.value = ''//limpa input

        reload()//recarrega
    }
}

// Método usado para curtir tweets
// Parâmetros:
// tweetIndex - Recebe o index original do tweet
// commentIndex - Recebe o index do comentário
// isComment - Recebe se é comentário ou não
function likeTweet(id) {//likeTweet(id): Adiciona/remove a curtida do usuário logado.Atualiza a interface via reloadModal().
    var likes = parseID(id).likes
    if (!likes.includes(state.loggedUser.id)) {//se os likes nao incluem o usuario logado
        likes.push(state.loggedUser.id)//ele vai adicionar
    } else {
        likes.splice(likes.findIndex(x => x == state.loggedUser.id), 1)//se incluem o usuario logado, ele remove
    }
    setLocalStorageValue("tweets", data.tweets)

    reloadModal()
    reload()
}

function showImageUploadModal() {//quando clicar no botao de adicionar imagem vai abrir esse modal 
    const content = `
        <input type="file" name="picture" id="tweet-upload-image" accept="image/*">
        <img src="${state.input.image}" id="upload-preview-image">
        <button>Enviar</button>//conteudo
    `

    const element = createElementHTML('div', ['image-upload-container'], content)//cria o html

    element.querySelector("#tweet-upload-image").addEventListener("change", (x) => {
        const file = x.currentTarget.files[0]
        if (file) {
            const reader = new FileReader()

            reader.onload = function (e) {
                const base64String = e.target.result
                element.querySelector(`#upload-preview-image`).src = base64String
            }

            reader.readAsDataURL(file)
        }//funçao de colocar o previwem da imagem
    })

    element.querySelector("button").addEventListener("click", () => {//botao ok
        state.input.image = element.querySelector("#upload-preview-image").src//guarda o valor dqa imagem atual no state
        hideModal()//esconde o modal
    })

    setModalBody([element])//corpo do modal

    showModal()//exibe modal
}

function showTweetModal(image, name, content, likes, id) {
    const commentInputContent = `
        <input id="comment-input" placeholder="Adicione um comentário!" type="text">
        <button id="submit-comment">Comentar</button>//adiciona comentarios
    `

    state.modal.data = { id }//coloca infos no state de modal

    const originalTweet = renderTweetGeneric(['modal-tweet-item'], image, name, id, content, likes)
    const commentsList = createElementHTML('div', ['comments-list'], "")
    const commentInput = createElementHTML('div', ['comment-input-container'], commentInputContent)//3 itens html

    setModalBody([originalTweet, commentsList, commentInput])//adiciona tudo no corpo do modal

    commentInput.querySelector("#submit-comment").addEventListener("click", () => {
        createComment(id)//vai chamar a funçao de criar comentario
    })

    showModal()
    reload()
}

/* = = = = = Search Sugestions = = = = = */

const searchSuggestionsList = document.querySelector(".search-suggestions-list")
const searchInput = document.querySelector("#search")

function setSearchSuggestionsData(searchTerm) {//data das sugestoes, funçao recebe oque a pessoa digitou, vai filtrar tanto pelo nome quanto pelo usuario na array de users
    var users = data.usuarios.filter((x) => x.name.toLowerCase().includes(searchTerm.toLowerCase()) || x.username.toLowerCase().includes(searchTerm.toLowerCase()))
    searchSuggestionsList.innerHTML = ''//valor zero

    if (searchTerm) {
        users.forEach((x) => {
            searchSuggestionsList.append(createElementHTML("div", ["search-suggestions-list-item"], x.name))
        })//se tiver algo vai começar a preencher a lista no loop
    }
}

searchInput.addEventListener("focus", () => {//quando a pessoa focar, quando a pessoa clica na coisa
    searchInput.addEventListener("input", (x) => {
        if (searchInput.value) {
            searchSuggestionsList.classList.add("visible")//se tiver valor no input vai mostrar
        } else {
            searchSuggestionsList.classList.remove("visible")
        }
        setSearchSuggestionsData(x.currentTarget.value)//definir o corpo com os valores que a pessoa digitou
    })
})

searchInput.addEventListener("blur", () => {//quando clicar em outro lugar que nao seja o input a pessoa perde o foco
    searchSuggestionsList.classList.remove("visible")//remove o visible
    searchInput.removeEventListener("input", () => { })//remove o evento do input
})

/* = = = = = Dark Mode = = = = = */

var r = document.querySelector(':root')//parte da tag css
var isDarkMode = false//flag de controle

const setColorSchemeProperty = (property, value) => r.style.setProperty(`--${property}`, value)

document.querySelector(".darkmode").addEventListener("click", () => {
    isDarkMode = !isDarkMode//inverte o valor quando a pessoa clica
    if (isDarkMode) {//padrao dark mode
        setColorSchemeProperty("background-color", "#000")
        setColorSchemeProperty("secondary-color", "#090909")
        setColorSchemeProperty("font-color", "#fff")
    } else {//se nao for ativado, fica branco
        setColorSchemeProperty("background-color", "#fff")
        setColorSchemeProperty("secondary-color", "#f9f9f9")
        setColorSchemeProperty("font-color", "#000")
    }
})

/* = = = = = Rendering Profile = = = = = */
//se estiver no profile.html
if (window.location.pathname == "/profile.html") {
    /*vai renderizar o perfil*/  
    function renderProfile() {
        document.querySelector("#profileImage").src = state.loggedUser.image
        document.querySelector("#profileName").innerHTML = state.loggedUser.name
        document.querySelector("#profileUsername").innerHTML = `@${state.loggedUser.username}`

        document.querySelector("#edit-profile").addEventListener("click", () => {
            setProfileModalBody()
            showModal()//mostrar o modal de editar perfil
        })

    //renderProfile(): Exibe dados do usuário e seus tweets.usernameValidation: Usuário deve ter 3-20 caracteres (letras/números).
        renderTweetsListGeneric(data.tweets.filter(x => x.author == state.loggedUser.id), ["tweet-list-item"], ".tweet-list")
    }//renderizar os tweets da pessoa em si, filtro pro author ser o mesmo

    const usernameValidation = (username) => { //regex de validaçao do user
        var regex = /^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/g
        return regex.test(username)
    }
    
    //passwordValidation: Senha deve ter 8+ caracteres (letras + números). 
    const passwordValidation = (password) => {//regex da senha
        var regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/g
        return regex.test(password)
    }
//atualiza infos do perfil
    function updateProfileData(profilePicturePreview, profileName, profileUsername, profilePassword, errorMessage) {
        if (profilePicturePreview.src && profileName.value && profileUsername.value && profilePassword.value) {//confere tudo que precisa
            if (!usernameValidation(profileUsername.value)) {//vai validar o user
                errorMessage.innerHTML = "Esse usuário é inválido"
                return;//vai verificar se o usario e valido
            }
            if (!passwordValidation(profilePassword.value)) {//vai validar a senha
                errorMessage.innerHTML = "Essa senha é inválida"
                return;//a senha tbm
            }

            var loggedUserIndex = data.usuarios.findIndex(x => x.username == state.loggedUser.username)//index do user localizar
            
            data.usuarios[loggedUserIndex] = { id: state.loggedUser.id, image: profilePicturePreview.src, name: profileName.value, username: profileUsername.value, password: profilePassword.value }//´pega o usuario atual e os valores
            setLocalStorageValue("users", data.usuarios)
//vai pegar as infos, alterar e salvar
            loggedUser = data.usuarios[loggedUserIndex]
            state.loggedUser = data.usuarios[loggedUserIndex]
            setSessionStorageValue("loggedUser", data.usuarios[loggedUserIndex])
            
            hideModal()
            renderProfile()
            renderLoggedUser()
        }
    }

    function setProfileModalBody() {//definir o corpo do modal
        var content = `
                <h2>Editar Perfil</h2>
                <label for="picture">Foto de Perfil</label>
                <input type="file" name="picture" id="profile-edit-picture" accept="image/*">
                <img id="profile-picture-preview" src="" alt="">
                <label for="name">Nome</label>
                <input type="text" name="name" id="profile-edit-name">
                <label for="username">Usuário</label>
                <input type="text" name="username" id="profile-edit-username">
                <label for="password">Senha</label>
                <input type="password" name="password" id="profile-edit-password">
                <span class="error-message"></span>
                <button id="profile-edit-save">Salvar</button>
        `
        const profileContent = createElementHTML('div', ['edit-profile-container'], content)//div externa

        const profilePicture = profileContent.querySelector("#profile-edit-picture")
        const profilePicturePreview = profileContent.querySelector("#profile-picture-preview")
        const profileName = profileContent.querySelector("#profile-edit-name")
        const profileUsername = profileContent.querySelector("#profile-edit-username")
        const profilePassword = profileContent.querySelector("#profile-edit-password")
        const errorMessage = profileContent.querySelector(".error-message")//todos os elementos html que precisa

        profilePicturePreview.src = state.loggedUser.image
        profileName.value = state.loggedUser.name
        profileUsername.value = state.loggedUser.username
        profilePassword.value = state.loggedUser.password//define os valores atuais do usuario

        // toda vez que a pessoa mudar o arquivo atualiza o preview
        profilePicture.addEventListener("change", (x) => {
            const file = x.currentTarget.files[0]
            if (file) {
                const reader = new FileReader()

                reader.onload = function (e) {
                    const base64String = e.target.result
                    profilePicturePreview.src = base64String
                } //quando a pessoa clicar em ok 

                reader.readAsDataURL(file)
            }
        })

        // quando clicar no botao de salvar roda a função de atualizar as informacoes
        profileContent.querySelector("#profile-edit-save").addEventListener("click", () => {
            updateProfileData(profilePicturePreview, profileName, profileUsername, profilePassword, errorMessage)
        })

        setModalBody([profileContent])//corpo do modal
    }

    document.querySelector("#logout").addEventListener("click", () => {
        removeSessionStorageValue("loggedUser") // remove qualquer valor na chave de loggedUser no session storage     
        window.location = "/login.html"//logout
    })
}

/* = = = = = Initialization = = = = = */
//Fluxo de inicialização:
//Verifica se há usuário logado. Se na página de perfil: Renderiza perfil.
//Senão: Configura eventos para postar tweets. Se não logado: Redireciona para login.
// Confere se já existe algum usuário logado.
if (state.loggedUser) {
    // Se a página for o perfil
    if (window.location.pathname == '/profile.html') {
        renderProfile()
    } else {
        document.querySelector(".tweet-add-image").addEventListener("click", () => showImageUploadModal())
        document.querySelector(".tweet-submit").addEventListener("click", () => createPost())
    }

    renderLoggedUser()
    reload()
} else {
    // Redireciona para página de login
    window.location = '/login.html'
}
