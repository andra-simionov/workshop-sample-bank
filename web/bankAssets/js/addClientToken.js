function addClientToken(storeName) {
    $.post("UserAccount/generateClientToken", {action: 'generateClientToken', storeName: storeName}).done(function () {
        window.location.reload();
    })
}
