const inputNome = document.querySelector('#valor_nome');
const inputDesc = document.querySelector('#valor_desc');
const inputPreco = document.querySelector('#valor_preco');
const inputImagem = document.querySelector('#input_img');
const inputButton = document.querySelector('#b-cadastrar');
const inputEstoque = document.querySelector("#valor_estoque")

const TRASH_ICON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width:16px;height:16px;"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>'
const DEFAULT_IMAGE = "data:image/jpeg;base64,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"

var filtro = ""

var items = []

function deletarCampos() {
    inputNome.value = ""
    inputDesc.value = ""
    inputPreco.value = ""
    inputImagem.value = ""
    inputEstoque.value = ""
    document.querySelector("#preview").src = ""
}

inputImagem.addEventListener("change", (e) => {
    const file = e.target.files[0];

    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();

        reader.onload = function(readerEvent) {
            const base64Data = readerEvent.target.result;
            document.querySelector("#preview").src = base64Data
        }

        reader.readAsDataURL(file)
    }
})

function itemEl(nome, descricao, preco, estoque, imagem, id) {
    return `<li class="item" id="item-${id}"><div><img src="${imagem}"><div><h2>${nome}</h2><span>${descricao}</span></div></div><span>R$ ${preco}</span><span>${estoque} items</span><span id="trash">${TRASH_ICON}</span></li>`
}

function loadLista(lista) {
    var sortedItems = items
    if (lista) sortedItems = lista
    const produtos = document.querySelector("#produtos")
    produtos.innerHTML = ""
    sortedItems.forEach((item, idx) => {
        produtos.innerHTML += itemEl(item.nome, item.descricao, item.preco, item.estoque, item.imagem, item.id)  
    })
    reloadHandlers()
    if (!lista) filtro = ""
}

function reloadHandlers() {
    items.forEach((item, index) => {
        document.querySelector(`#item-${item.id} #trash`).addEventListener("click", () => {
            items.splice(index, 1)
            loadLista()
        })
    })
}

inputButton.addEventListener("click", () => {
    if (!inputNome.value || !inputDesc.value || inputPreco.value < 0) {
        window.alert("não é possivel adicionar um item vazio")
    } else {
        items.push({ id: items.length + 1, nome: inputNome.value, descricao: inputDesc.value, preco: Number(inputPreco.value).toFixed(2), estoque: Number(inputEstoque.value), imagem: (document.querySelector("#preview").src.startsWith("data") ? document.querySelector("#preview").src : DEFAULT_IMAGE) })
    }
    loadLista()
    deletarCampos()
})

document.querySelector("#sort-nome-sea").addEventListener("click", () => {
    var value = prompt("Digite uma palavra chave").toLowerCase()
    loadLista(items.filter(x => x.nome.toLowerCase().includes(value) || x.descricao.toLowerCase().includes(value)))
    filtro = "sort-nome-sea"
    reloadStyle()
})

document.querySelector("#limit-preco").addEventListener("click", () => {
    var value = Number(prompt("Valor máximo"))
    loadLista(items.filter(x => x.preco <= value))
    filtro = "limit-preco"
    reloadStyle()
})

document.querySelector("#limit-preco-min").addEventListener("click", () => {
    var value = Number(prompt("Valor mínimo"))
    loadLista(items.filter(x => x.preco >= value))
    filtro = "limit-preco-min"
    reloadStyle()
})

document.querySelector("#sort-preco").addEventListener("click", () => {
    loadLista(items.sort((a, b) => a.preco - b.preco))
    filtro = "sort-preco"
    reloadStyle()
})

document.querySelector("#sort-preco-mai").addEventListener("click", () => {
    loadLista(items.sort((a, b) => b.preco - a.preco))
    filtro = "sort-preco-mai"
    reloadStyle()
})

document.querySelector("#sort-nome").addEventListener("click", () => {
    loadLista(items.sort((a, b) => a.nome.toLowerCase() < b.nome.toLowerCase() ? -1 : a.nome.toLowerCase() > b.nome.toLowerCase() ? 1 : 0))
    filtro = "sort-nome"
    reloadStyle()
})

document.querySelector("#sort-nome-dec").addEventListener("click", () => {
    loadLista(items.sort((a, b) => a.nome.toLowerCase() < b.nome.toLowerCase() ? 1 : a.nome.toLowerCase() > b.nome.toLowerCase() ? -1 : 0))
    filtro = "sort-nome-dec"
    reloadStyle()
})

document.querySelector("#sort-estoque-cec").addEventListener("click", () => {
    loadLista(items.sort((a, b) => a.estoque - b.estoque))    
    filtro = "sort-estoque-cec"
    reloadStyle()
})

document.querySelector("#sort-estoque-dec").addEventListener("click", () => {
    loadLista(items.sort((a, b) => b.estoque - a.estoque))
    filtro = "sort-estoque-dec"
    reloadStyle()
})

document.addEventListener("keydown", (ev) => {
    if (ev.key === "Enter") {
        inputButton.click()
        deletarCampos()
    }
})

function reloadStyle() {
    document.querySelectorAll(".sort").forEach(item => {
        if (item.id == filtro) {
            item.classList.add("active")
        } else {
            item.classList.remove("active")
        }
    })
}