const readTravelBtnAll = document.querySelectorAll('.table__travel--read');
const deleteTravelBtnAll = document.querySelectorAll('.table__travel--delete');
const modal = document.querySelector('.modal');

readTravelBtnAll.forEach(btn => btn.addEventListener('click', showModalOnClick));
deleteTravelBtnAll.forEach(btn => btn.addEventListener('click', handleDelete));

async function handleDelete(e) {
    e.preventDefault();
    idTravel = e.target.closest('tr').getAttribute('data-id-travel')
    await fetch(`/travels/delete/${idTravel}`, {
        method: 'DELETE'
    })

    window.location.reload();
}

async function showModalOnClick(e) {
    e.preventDefault();
    idTravel = e.target.closest('tr').getAttribute('data-id-travel')
    const travelResponse = await fetch(`/travels/${idTravel}`, {
        method: 'GET'
    })
    
    if(!travelResponse.ok) {
        return
    }
    travel = await travelResponse.json()
    
    const employeeResponse = await fetch(`/employees/${travel.employee_id}`, {
        method: 'GET'
    })
    
    if(!employeeResponse.ok) {
        return
    }

    employee = await employeeResponse.json()

    modal.querySelector('#modal_owner').innerHTML = `${employee.firstname} ${employee.lastname}`;
    modal.querySelector('#modal_phone').innerHTML = employee.phone;
    modal.querySelector('#modal_phone').href = `tel:+${employee.phone}`;
    modal.querySelector('#modal_email').innerHTML = employee.email;
    modal.querySelector('#modal_email').href = `mailto:${employee.email}`;
    modal.querySelector('#modal_total_seats').innerHTML = travel.seats_total;
}