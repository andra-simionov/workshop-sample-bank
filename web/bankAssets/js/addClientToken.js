function addClientToken(idStore) {
    $.post("UserAccount/generateClientToken", {action: 'generateClientToken', idStore: idStore}).done(function () {
        window.location.reload();
    })
}
