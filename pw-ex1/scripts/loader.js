import { convertToId } from "./utils.js"
import { tarefas } from "./tarefas.js"
import { reloadHandlers } from "./handlers.js"

/* - - - - - CARREGADOR DE CONTEÚDO - - - - - */

const TRASH_ICON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width:16px;height:16px;"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>'
const EMPTY_STAR_ICON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="width:16px;height:16px;"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>'
const STAR_ICON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="width:16px;height:16px;"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>'

var ContentLoaderTasks = document.querySelector("#ContentLoader-Tasks")

// Carrega as tarefas no corpo
function LoadTasks(tasks) {
    // Limpa todo o conteúdo da lista (Etapa 01 do refresh)
    ContentLoaderTasks.innerHTML = ""
    // Gera todos os items novamente (Etapa 02 do refresh)
    tasks.forEach(tarefa => {
        var li = document.createElement("li")
        li.innerHTML = `<div><input type="checkbox" id="${convertToId(tarefa.titulo)}-checkbox" ${tarefa.feito ? "checked" : "  "}></input><span id="${convertToId(tarefa.titulo)}-content">${tarefa.titulo}</span></div><div><span id="${convertToId(tarefa.titulo)}-star">${tarefa.favorito ? STAR_ICON : EMPTY_STAR_ICON}</span><span id="${convertToId(tarefa.titulo)}-trash">${TRASH_ICON}</span></div>`
        ContentLoaderTasks.append(li)
    })
    // Recarrega handlers de interação com o usuário (Etapa 03 do refresh)
    reloadHandlers()
}

function reloadContent() {
    LoadTasks(tarefas)
}

export { LoadTasks, reloadContent }