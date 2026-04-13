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