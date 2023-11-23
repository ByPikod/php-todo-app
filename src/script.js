function checkTask(id) {
    axios.post('/actions.php?action=check', {
        id: id
    }, {
        headers: { 'Content-Type': 'multipart/form-data' },
    })
    .then(function (response) {
        console.log(response);
    })
}

document.addEventListener('DOMContentLoaded', function() {
    $('#draggable').sortable();
});