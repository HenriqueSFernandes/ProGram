import { sendDelete, sendPost, sendToastMessage } from './utils'
const addJoinRequestListener = () => {
    const btnGroupContainer = document.getElementById('group-buttons-container');
    console.log(btnGroupContainer);
    const groupId = btnGroupContainer.getAttribute('data-group-id');
    if (!btnGroupContainer) return;
    const joinGroupBtn = document.getElementById('join-group-button');
    console.log(joinGroupBtn);
    if (!joinGroupBtn) return;
    joinGroupBtn.addEventListener('click', async (event) => {
        event.preventDefault();
        console.log('Joining group...');
        sendPost(`/api/group/${groupId}/join`)
            .then(() => {
                window.location.reload();
            })
            .catch((error) => {
                sendToastMessage('An error occurred while joining the group.', 'error');
            });
    });
}

addJoinRequestListener();