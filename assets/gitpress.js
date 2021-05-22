window.addEventListener("load", function () {

    fetch(ajaxurl + "?action=static_archive_action", {
        method: "POST", body: JSON.stringify({
            action: "static_archive_action",
            perform: "ping"
        })
    }).then(response => response.json())
        .then(response => {
            console.log(response.message)
        })


})