/* - - - - - TAREFAS - - - - - */

// Lista de tarefas
var tarefas = []

// Adiciona tarefa
function addTask(tarefa) {
    tarefas.push({ id: tarefas.length, ...tarefa })
}

// Remove tarefa
function removeTask(tarefa) {
    tarefas.splice(tarefas.findIndex(tarefa), 1)
}

// Filtra tarefas
function filterTasks(filtro) {
    return tarefas.filter(x => x.categoria == filtro)
}

export { tarefas, addTask, removeTask, filterTasks }