const formUpdate = document.querySelector('form');
const formControls = document.querySelectorAll('.form-control')

formUpdate.addEventListener('submit', handleSubmit);
formUpdate.addEventListener('change', handleInputChange);

const departureSelect = document.getElementById('departure_agency_id')
const arrivalSelect = document.getElementById('arrival_agency_id')
const departureDate = document.getElementById('departure_date')
const arrivalDate = document.getElementById('arrival_date')
const departureTime = document.getElementById('departure_time')
const arrivalTime = document.getElementById('arrival_time')
const datetimeInputs = document.querySelectorAll('.datetime-js')
const datetimeFeedback = document.querySelectorAll('.datetime-feedback')

const seatsAvailable = document.getElementById('seats_available')
const seatsTotal = document.getElementById('seats_total')

let departureDateTime = null
let arrivalDateTime = null

function handleInputChange() {
    formControls.forEach(formControl => formControl.classList.remove('is-invalid'))

    departureDateTime = new Date(`${departureDate.value} ${departureTime.value}`)
    arrivalDateTime = new Date(`${arrivalDate.value} ${arrivalTime.value}`)   

    seatsAvailable.setAttribute('max', seatsTotal.value)

    datetimeFeedback.forEach(feedback => feedback.innerHTML = "")

    if(checkAgenciesSame()) {
        departureSelect.classList.add('is-invalid')
        arrivalSelect.classList.add('is-invalid')
    }

    if(checkDateTimeSame() || !checkDepDateTimeLessThanArrDateTime()) {
        datetimeInputs.forEach(input => input.classList.add('is-invalid'))
        datetimeFeedback.forEach(feedback => feedback.innerHTML = "La date de départ et d'arrviée ne peuvent être identique !")
    }

    if(!checkSeatsAvailable()) {
        seatsAvailable.classList.add('is-invalid')
    }


}

async function handleSubmit(e) {
    e.preventDefault();

    if(!checkValidation()) {
        return
    }
    
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



function checkValidation() {
    if(checkAgenciesSame()) {
        return false
    }

    if(checkDateTimeSame() || !checkDepDateTimeLessThanArrDateTime()) {
        return false
    }

    if(!checkSeatsAvailable()) {
        return false
    }

    return true


}

function checkAgenciesSame() {
    return departureSelect.value === arrivalSelect.value
}


function checkDateTimeSame() {
    return departureDateTime === arrivalDateTime
}
function checkDepDateTimeLessThanArrDateTime() {
    return departureDateTime < arrivalDateTime
}

function checkSeatsAvailable() {
    return seatsAvailable.value <= seatsTotal.value
}
