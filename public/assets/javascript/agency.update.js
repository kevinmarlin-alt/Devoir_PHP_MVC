const formUpdate = document.querySelector('form');

formUpdate.addEventListener('submit', handleSubmit);

async function handleSubmit(e) {
    e.preventDefault();

    const data = Object.fromEntries(new FormData(e.target));
    
    const idAgency = data.id
    const response = await fetch(`/agencies/update/${idAgency}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })

    if(!response.ok) {
        return
    }

    window.location.href = '/dashboard/#agencies';
}