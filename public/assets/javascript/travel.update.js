const formUpdate = document.querySelector('form');

formUpdate.addEventListener('submit', handleSubmit);

async function handleSubmit(e) {
    e.preventDefault();

    const data = Object.fromEntries(new FormData(e.target));
    
    idTravel = data.id
    const response = await fetch(`/travels/update/${idTravel}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })

    window.location.href = '/';
}