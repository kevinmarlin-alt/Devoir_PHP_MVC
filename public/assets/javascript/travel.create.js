const createForm = document.querySelector('form')
const formControls = document.querySelectorAll('.form-control')

const departureSelect = document.getElementById('departure_agency_id')
const arrivalSelect = document.getElementById('arrival_agency_id')

const departureDate = document.getElementById('departure_date')
const departureTime = document.getElementById('departure_time')
const arrivalDate = document.getElementById('arrival_date')
const arrivalTime = document.getElementById('arrival_time')

const datetimeInputs = document.querySelectorAll('.datetime-js')
const datetimeFeedback = document.querySelectorAll('.datetime-feedback')

console.log(datetimeInputs)


let departureDatetime = new Date()
let arrivalDatetime = new Date()

createForm.addEventListener('change', handleInputChange)

function handleInputChange() {
    formControls.forEach(formControl => formControl.classList.remove('is-invalid'))
    datetimeFeedback.forEach(feedback => feedback.innerHTML = "")

    initDateTime()
    console.log(departureDateTime, arrivalDateTime)

    if(checkAgenciesIsSame()) {
        departureSelect.classList.add('is-invalid')
        arrivalSelect.classList.add('is-invalid')
    }
console.log(checkDepDateTimeLessThanArrDateTime())
    if(!checkDepDateTimeLessThanArrDateTime()) {
        console.log('test')
        datetimeInputs.forEach(input => input.classList.add('is-invalid'))
        datetimeFeedback.forEach(feedback => feedback.innerHTML = "La date de départ ne peuvent être suppérieur ou identique à la date d'arrivée !")
    }
}

function checkAgenciesIsSame() {
    return departureSelect.value === arrivalSelect.value
}

function checkDateTimeIsSame() {
    return departureDateTime === arrivalDateTime
}

function checkDepDateTimeLessThanArrDateTime() {
    return departureDateTime < arrivalDateTime
}

function initDateTime() {
    departureDateTime = new Date(`${departureDate.value} ${departureTime.value}`)
    arrivalDateTime = new Date(`${arrivalDate.value} ${arrivalTime.value}`) 
}