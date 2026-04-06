import { parseCategoria } from "./utils.js"
import { addTask, tarefas, filterTasks } from "./tarefas.js"
import { reloadContent } from "./loader.js"
import { LoadTasks } from "./loader.js"
import { convertToId } from "./utils.js"

/* - - - - - HANDLERS - - - - - */

// Adiciona handler aos elementos das categorias
document.querySelectorAll("#categorias div").forEach((el) => {
    el.addEventListener("click", () => {
        if (el.id == "tasks") {
            // Todas as tarefas
            LoadTasks(tarefas)
        } else {
            // Tarefas filtradas
            LoadTasks(filterTasks(el.id))
        }
    })
})

// Handler para adicionar item
function newItemHandler() {
    var content = document.querySelector("#ContentInteraction-itemContent")
    var parsed = parseCategoria(content.value)
    addTask({ titulo: parsed.text, categoria: parsed.categoria, favorito: false, feito: false })
    content.value = ""
    reloadContent()
}

// Handler para adicionar item quando clicar no botão
document.querySelector("#ContentInteraction-addItem").addEventListener("click", newItemHandler)

// Se o usuário apertar enter, adicionar o item, se não, só foca no input
document.addEventListener("keydown", (el) => {
    if (el.key == "Enter") {
        newItemHandler()
    } else {
        if (document.activeElement.tagName !== "INPUT") {
            var input = document.querySelector("#ContentInteraction-itemContent")
            input?.focus()
        }
    }
})

// Handler
function reloadHandlers() {
    tarefas.forEach((tarefa, index) => {
        // Handler para marcar item como feito
        document.querySelector(`input#${convertToId(tarefa.titulo)}-checkbox`)?.addEventListener("change", (ev) => {
            if (ev.currentTarget.checked) {
                const [movedTarefa] = tarefas.splice(index, 1)
                tarefas.push({ ...movedTarefa, feito: true })
                reloadContent()
            } else {
                const [movedTarefa] = tarefas.splice(index, 1)
                tarefas.splice(movedTarefa.id, 0, { ...movedTarefa, feito: false })
                reloadContent()
            }
        })

        // Handler para favoritar item
        document.querySelector(`span#${convertToId(tarefa.titulo)}-star`)?.addEventListener("click", (ev) => {
            tarefa.favorito = !tarefa.favorito
            reloadContent()
        })

        // Handler para deletar item
        document.querySelector(`span#${convertToId(tarefa.titulo)}-trash`)?.addEventListener("click", (ev) => {
            tarefas.splice(index, 1)
            reloadContent()
        })
    })
}

export { reloadHandlers }