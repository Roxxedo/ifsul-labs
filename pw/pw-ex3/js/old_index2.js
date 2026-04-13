/* = = = = = Local Storage and Session Storage = = = = = */
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

function removeSessionStorageValue(key) {
    sessionStorage.removeItem(key)
}

/* = = = = = Variables = = = = = */
var tweets = getLocalStorageValue("tweets") || []
var usuarios = getLocalStorageValue("users") || []

const state = {
    loggedUser: getSessionStorageValue("loggedUser"),
    modal: { isOpen: false, data: {} },
}

/* = = = = = Utilities Methods = = = = = */
function createElementHTML(tag, classes, content) {
    const el = document.createElement(tag)
    classes.forEach(x => el.classList.add(x))
    el.innerHTML = content
    return el
}

/* = = = = = Tweets Rendering = = = = = */
function getTweetElementHTML(classes, image, name, content, likes, isComment, tweetIndex, commentIndex) {
    const tweetContent = `
        <div class="tweet">
            <div class="tweet-author">
                <img src="${image}" alt="Image Profile">
            </div>
            <div class="tweet-body">
                <p class="tweet-author-name">${name}</p>
                <p class="tweet-content">${content}</p>
            </div>
        </div>
        <div class="tweet-interactions">
            <div class="like">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                <span>${likes.length}</span>
            </div>
        </div>
    `
    const tweet = createElementHTML("div", classes, tweetContent)

    const likeButton = tweet.querySelector(".tweet-interactions .like")
    if (likes.includes(state.loggedUser.id)) likeButton.classList.add("active")
    likeButton.addEventListener("click", () => likeTweet(isComment ? tweetIndex : commentIndex, commentIndex, isComment))

    return tweet
}

function renderTweetsListGeneric(_tweet, tweetClasses, list, isComment, tweetIndex = 0) {
    const tweetList = document.querySelector(list)
    tweetList.innerHTML = ''

    tweets = getLocalStorageValue("tweets")
    usuarios = getLocalStorageValue("users")

    _tweet.forEach((tweet, index) => {
        const user = usuarios[tweet.author - 1]
        const tweetElement = getTweetElementHTML(tweetClasses, user.image, user.name, tweet.content, tweet.likes, isComment, tweetIndex, index)

        if (!isComment) {
            tweetElement.querySelector(".tweet").addEventListener("click", () => {
                setCommentsModalBody(user.image, user.name, tweet.content, tweet.likes, tweetIndex, index)
                showModal()
            })
        }

        tweetList.append(tweetElement)
    })
}

function renderTweetsList() {
    renderTweetsListGeneric(tweets, ["tweet-list-item"], ".tweet-list", false)
}

function renderTweetsCommentsList(index) {
    renderTweetsListGeneric(tweets[index].comments, ["modal-tweet-item", "comment-item"], ".comments-list", true, index)
}

function reload() {
    if (!state.modal.isOpen) {
        renderTweetsListGeneric(tweets, ["tweet-list-item"], ".tweet-list", false)
    } else {
        renderTweetsListGeneric(...state.modal.data)
    }
}

/* = = = = = Comments Modal Management = = = = = */
const modalWrapper = document.querySelector(".modal-backdrop")

const showModal = () => modalWrapper.classList.add("visible")
const hideModal = () => modalWrapper.classList.remove("visible")

modalWrapper.querySelector("#modal>.close-button").addEventListener("click", () => hideModal())

function setModalBody(content) {
    const body = modalWrapper.querySelector(".modal-body")
    body.innerHTML = ''
    content.forEach((html) => {
        body.append(html)
    })
}

function setCommentsModalBody(image, author, content, likes, tweetIndex, commentIndex) {
    const commentInputContent = `
        <input id="comment-input" placeholder="Adicione um comentário!" type="text">
        <button id="submit-comment">Comentar</button>
    `

    const originalTweet = getTweetElementHTML(['modal-tweet-item'], image, author, content, likes, false, tweetIndex, commentIndex)
    const commentsList = createElementHTML('div', ['comments-list'], "")
    const commentInput = createElementHTML('div', ['comment-input-container'], commentInputContent)

    setModalBody([originalTweet, commentsList, commentInput])

    renderTweetsCommentsList(commentIndex)

    commentInput.querySelector("#submit-comment").addEventListener("click", () => {
        createComment(index)
    })
}

/* = = = = = Tweets Management = = = = = */
function createPost() {
    const tweetInput = document.querySelector(".tweet-input")

    if (tweetInput.value) {        
        if (!tweets) tweets = []
        tweets.push({ author: loggedUser.id, content: [{ type: 'text', value: tweetInput.value }], comments: [], likes: [] })
        setLocalStorageValue("tweets", tweets)

        tweetInput.value = ''

        renderTweetsList()
    }
}

/* = = = = = Comments Management = = = = = */
function createComment(index) {
    const commentInput = document.querySelector("#comment-input")

    if (commentInput.value) {
        tweets[index].comments.push({ author: loggedUser.id, content: commentInput.value, likes: [] })
        setLocalStorageValue("tweets", tweets)

        commentInput.value = ''

        renderTweetsCommentsList(index)
    }
}

/* = = = = = Search Management = = = = = */
const searchSuggestionsList = document.querySelector(".search-suggestions-list")
const searchInput = document.querySelector("#search")

function setSearchSuggestionsData(searchTerm) {
    var users = usuarios.filter((x) => x.name.toLowerCase().includes(searchTerm.toLowerCase()) || x.username.toLowerCase().includes(searchTerm.toLowerCase()))
    searchSuggestionsList.innerHTML = ''

    if (searchTerm) {
        users.forEach((x) => {
            searchSuggestionsList.append(createElementHTML("div", ["search-suggestions-list-item"], x.name))
        })
    }
}

searchInput.addEventListener("focus", () => {
    searchInput.addEventListener("input", (x) => {
        if (searchInput.value) {
            searchSuggestionsList.classList.add("visible")
        } else {
            searchSuggestionsList.classList.remove("visible")
        }
        setSearchSuggestionsData(x.currentTarget.value)
    })
})

searchInput.addEventListener("blur", () => {
    searchSuggestionsList.classList.remove("visible")
    searchInput.removeEventListener("input", () => { })
})

/* = = = = = Rendering Necessities = = = = = */
function renderLoggedUser() {
    document.querySelector("#loggedUserName").innerHTML = loggedUser.name
    document.querySelector("#loggedUserImage").src = loggedUser.image
}

/* = = = = = Rendering Profile = = = = = */
if (window.location.pathname == "/profile.html") {
    function renderProfile() {
        document.querySelector("#profileImage").src = loggedUser.image
        document.querySelector("#profileName").innerHTML = loggedUser.name
        document.querySelector("#profileUsername").innerHTML = `@${loggedUser.username}`

        document.querySelector("#edit-profile").addEventListener("click", () => {
            setProfileModalBody()
            showModal()
        })

        renderTweetsListGeneric(tweets.filter(x => x.author == loggedUser.id), ["tweet-list-item"], ".tweet-list", true)
    }

    const usernameValidation = (username) => { 
        var regex = /^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/g
        return regex.test(username)
    }

    const passwordValidation = (password) => {
        var regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/g
        return regex.test(password)
    }

    function updateProfileData(profilePicturePreview, profileName, profileUsername, profilePassword, errorMessage) {
        if (profilePicturePreview.src && profileName.value && profileUsername.value && profilePassword.value) {
            if (!usernameValidation(profileUsername.value)) {
                errorMessage.innerHTML = "Esse usuário é inválido"
                return;
            }
            if (!passwordValidation(profilePassword.value)) {
                errorMessage.innerHTML = "Essa senha é inválida"
                return;
            }

            var loggedUserIndex = usuarios.findIndex(x => x.username == loggedUser.username)
            
            usuarios[loggedUserIndex] = { id: loggedUser.id, image: profilePicturePreview.src, name: profileName.value, username: profileUsername.value, password: profilePassword.value }
            setLocalStorageValue("users", usuarios)

            loggedUser = usuarios[loggedUserIndex]
            setSessionStorageValue("loggedUser", usuarios[loggedUserIndex])

            hideModal()
            renderProfile()
            renderLoggedUser()
        }
    }

    function setProfileModalBody() {
        var content = `
            <div class="edit-profile-container">
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
        const profileContent = createElementHTML('div', ['edit-profile-container'], content)

        const profilePicture = profileContent.querySelector("#profile-edit-picture")
        const profilePicturePreview = profileContent.querySelector("#profile-picture-preview")
        const profileName = profileContent.querySelector("#profile-edit-name")
        const profileUsername = profileContent.querySelector("#profile-edit-username")
        const profilePassword = profileContent.querySelector("#profile-edit-password")
        const errorMessage = profileContent.querySelector(".error-message")

        profilePicturePreview.src = loggedUser.image
        profileName.value = loggedUser.name
        profileUsername.value = loggedUser.username
        profilePassword.value = loggedUser.password

        profilePicture.addEventListener("change", (x) => {
            const file = x.currentTarget.files[0]
            if (file) {
                const reader = new FileReader()

                reader.onload = function (e) {
                    const base64String = e.target.result
                    profilePicturePreview.src = base64String
                }

                reader.readAsDataURL(file)
            }
        })

        profileContent.querySelector("#profile-edit-save").addEventListener("click", () => {
            updateProfileData(profilePicturePreview, profileName, profileUsername, profilePassword, errorMessage)
        })

        setModalBody([profileContent])
    }

    document.querySelector("#logout").addEventListener("click", () => {
        removeSessionStorageValue("loggedUser")       
        window.location = "/login.html"
    })
}

/* = = = = = Dark Mode = = = = = */
var r = document.querySelector(':root')
var isDarkMode = false

const setColorSchemeProperty = (property, value) => r.style.setProperty(`--${property}`, value)

document.querySelector(".darkmode").addEventListener("click", () => {
    isDarkMode = !isDarkMode
    if (isDarkMode) {
        setColorSchemeProperty("background-color", "#000")
        setColorSchemeProperty("secondary-color", "#090909")
        setColorSchemeProperty("font-color", "#fff")
    } else {
        setColorSchemeProperty("background-color", "#fff")
        setColorSchemeProperty("secondary-color", "#f9f9f9")
        setColorSchemeProperty("font-color", "#000")
    }
})

/* = = = = = Tweet Interactions Management = = = = = */
function likeTweet(tweetIndex, commentIndex, isComment) {
    var likes = isComment ? tweets[tweetIndex].comments[commentIndex].likes : tweets[tweetIndex].likes
    if (!likes.includes(loggedUser.id)) {
        likes.push(loggedUser.id)
        setLocalStorageValue("tweets", tweets)

        isComment ? renderTweetsCommentsList(tweetIndex) : renderTweetsList()
    } else {
        likes.splice(likes.findIndex(x => x == loggedUser.id), 1)
        setLocalStorageValue("tweets", tweets)

        isComment ? renderTweetsCommentsList(tweetIndex) : renderTweetsList()
    }
}

/* = = = = = START POINT = = = = = */
if (getSessionStorageValue("loggedUser")) {
    if (window.location.pathname == "/profile.html") {
        renderProfile()
    } else {
        document.querySelector(".tweet-submit").addEventListener("click", () => createPost())
        renderTweetsList()
    }

    renderLoggedUser()
} else {
    window.location = "/login.html"
}