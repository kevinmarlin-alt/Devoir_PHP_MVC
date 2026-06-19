const updatePwdForm = document.querySelector('#employeesPasswordCollapse form');
const updatePwdCollapseBtn = document.querySelector('.employees__updatePwdCollapse--Btn');


updatePwdForm.addEventListener('submit', handleSubmit);

async function handleSubmit(e) {
    e.preventDefault()
    const data = Object.fromEntries(new FormData(e.target));
    console.log(data)

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