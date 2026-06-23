const updatePwdForm = document.querySelector('#employeesPasswordCollapse form');
const updatePwdCollapseBtn = document.querySelector('.employees__updatePwdCollapse--Btn');
const passwordFeedback = document.getElementById('pwd');


updatePwdForm.addEventListener('submit', handleSubmit);

async function handleSubmit(e) {
    e.preventDefault()
    clearFeedback()

    const data = Object.fromEntries(new FormData(e.target));

    if(checkNewPasswordIsEmpty(data.pwd)) {
        passwordFeedback.classList.add('is-invalid')
        return
    }

    const idEmployee = data.email;
    const response = await fetch(`/employees/update/${idEmployee}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })

    if(!response.ok) {
        return
    }

    updatePwdCollapseBtn.click()

    window.location.href = '/dashboard/#employees';
}

function clearFeedback() {
    passwordFeedback.classList.remove('is-invalid')
}

function checkNewPasswordIsEmpty(password) {
    return password === ""
}