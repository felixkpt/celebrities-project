
function invalidDateRange(action = 'show') {
    if (action == 'show') {
        let elements = document.querySelectorAll('#selection-form select');
        Array.from(elements).forEach((element, index) => {
            element.style.border = '2px solid crimson'
        });
        return;
    }
    document.getElementById('selection-form').addEventListener('change', function (e) {
        e.target.style.border = '1px solid gray'
    })

}

function wordCounter(textarea, display, characters = false) {
    textarea = document.querySelector(textarea);
    textarea.addEventListener("input", event => {
        const target = event.currentTarget;
        const text = target.value || target.textContent
        const currentLength = characters ? text.split('').length : text.split(' ').length;
        res = document.createElement('span')
        res.innerHTML = currentLength;
        document.querySelector(display).innerHTML = ''
        document.querySelector(display).append(res)
    });
}