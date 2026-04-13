/* - - - - - UTILIDADES - - - - - */

// Define a categoria a partir de um texto pré definido
function parseCategoria(content) {
    if (content.includes(" - myday")) return { text: content.replace(" - myday", ""), categoria: "myday" }
    if (content.includes(" - important")) return { text: content.replace(" - important", ""), categoria: "important" }
    if (content.includes(" - planned")) return { text: content.replace(" - planned", ""), categoria: "planned" }
    if (content.includes(" - assignedtome")) return { text: content.replace(" - assignedtome", ""), categoria: "assignedtome" }
    if (content.includes(" - flagleemail")) return { text: content.replace(" - flagleemail", ""), categoria: "flagleemail" }
    return { text: content, categoria: "" }
}

// Converte o titulo do item em um """id"""
function convertToId(titulo) {
    return titulo.replace(" ", "").toLowerCase()
}

export { parseCategoria, convertToId }