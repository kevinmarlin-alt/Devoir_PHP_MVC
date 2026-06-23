const deleteAgencyBtnAll = document.querySelectorAll('.table__agency--delete');
const modalConfirmDeleteAgencyBtn = document.querySelector('.agency__modal--confirm');
const deleteModal = document.getElementById('agencyDeleteModal')

deleteAgencyBtnAll.forEach(btn => btn.addEventListener('click', handleModalDelete));
modalConfirmDeleteAgencyBtn.addEventListener('click', handleConfirmDelete);

async function handleConfirmDelete(e){
    e.preventDefault();
    
    idAgency = deleteModal.getAttribute('data-id-agency')
    
    console.log(idAgency)
    await fetch(`/agencies/${idAgency}`, {
        method: 'DELETE'
    })

    window.location.href = '/dashboard';
}


async function handleModalDelete(e) {
    e.preventDefault();

    idAgency = e.target.closest('tr').getAttribute('data-id-agency')
    deleteModal.setAttribute('data-id-agency', idAgency)
}