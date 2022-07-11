window.addEventListener('load', function () {

    const main = document.getElementsByTagName('main')[0]
    if (document.getElementById('leftNav') !== null) {
        const leftNavToggler = document.getElementById('leftNavToggler')
        const leftNav = document.getElementById('leftNav')
        leftNavToggler.addEventListener('click', () => {
            leftNav.classList.toggle('hidden')
            topNav.classList.add('hidden')
            main.addEventListener('click', () => {
                leftNav.classList.add('hidden')
            })
        })
    }
    const topNavToggler = document.getElementById('topNavToggler')
    const topNav = document.getElementById('topNav')
    topNavToggler.addEventListener('click', () => {
        topNav.classList.toggle('hidden')
        main.addEventListener('click', () => {
            topNav.classList.add('hidden')
        })

        if (document.getElementById('leftNav') !== null) {
            leftNav.classList.add('hidden')
        }

    })

})

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