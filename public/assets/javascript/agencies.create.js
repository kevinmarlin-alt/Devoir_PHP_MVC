const agencyForm = document.getElementById('agency-form');
const cityInput = document.getElementById('city');

agencyForm.addEventListener('submit', handleSubmit);

async function handleSubmit(e) {
    e.preventDefault()
    clearInputs()

    const data = Object.fromEntries(new FormData(e.target));
    
    if(checkCityIsEmpty(data.city) || await checkCityExist(data.city)) {
        cityInput.classList.add('is-invalid')
        return
    }

    const request = await fetch('/agencies/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    
    if(!request.ok) {
        
        return
    }

    window.location.href = '/dashboard'
}

function checkCityIsEmpty(city) {
    return city === ""
}

async function checkCityExist(city) {
    const response = await fetch('/agencies', {
        method: "GET"
    })

    if(!response.ok) {
        return false
    }

    const agencies = await response.json()
    
    for (const agency of agencies) {
        if (agency.city.toLowerCase() === city.toLowerCase()) {
            return true;
        }
    }

    return false
}

function clearInputs() {
    cityInput.classList.remove('is-invalid')
}