const deleteAgencyBtnAll = document.querySelectorAll('.table__agency--delete');
const modalConfirmDeleteAgencyBtn = document.querySelector('.agency__modal--confirm');
const deleteModal = document.getElementById('agencyDeleteModal')

deleteAgencyBtnAll.forEach(btn => btn.addEventListener('click', handleModalDelet));
modalConfirmDeleteAgencyBtn.addEventListener('click', handleConfirmDelete);

async function handleConfirmDelete(e){
    e.preventDefault();
    idAgency = deleteModal.getAttribute('data-id-agency')
    
    console.log(idAgency)
    await fetch(`/agencies/${idAgency}`, {
        method: 'DELETE'
    })

    window.location.reload();
}


async function handleModalDelet(e) {
    e.preventDefault();
    idAgency = e.target.closest('tr').getAttribute('data-id-agency')
    deleteModal.setAttribute('data-id-agency', idAgency)
    console.log(deleteModal.getAttribute('data-id-agency'))

}