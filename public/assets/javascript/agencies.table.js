const deleteAgencyBtnAll = document.querySelectorAll('.table__agency--delete');

deleteAgencyBtnAll.forEach(btn => btn.addEventListener('click', handleDelete));

async function handleDelete(e) {
    e.preventDefault();
    idAgency = e.target.closest('tr').getAttribute('data-id-agency')
    await fetch(`/agencies/${idAgency}`, {
        method: 'DELETE'
    })

    window.location.reload();
}