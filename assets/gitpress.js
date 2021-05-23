var gitPressSyncInterval = null;

var isStartCalled = false;

function gitPressSync(action = "static_archive_action") {
    var formData = new FormData();
    formData.set("action", action)
    if (isStartCalled) {
        formData.set("perform", "ping")
    } else {
        formData.set("perform", "start")
        isStartCalled = true
    }

    fetch(ajaxurl, {
        method: "POST", body: formData
    }).then(response => response.json())
        .then(data => {
            console.log(data.activity_log_html)

            if (data.done) {
                clearInterval(gitPressSyncInterval)
                gitPressCustomAction("gitpress_commit_changes").then(() => {
                    gitPressCustomAction("gitpress_push")
                })

            }

        })
}


function gitPressCustomAction(action) {
    var formData = new FormData();
    formData.set("action", action)

    return fetch(ajaxurl, {
        method: "POST", body: formData
    }).then(response => response.json())
        .then(data => {
            var message = data.data.activity_log_html
            console.log(message)
            return Promise.resolve(message)
        })
}


window.addEventListener("load", function () {

    document.getElementById("gitpress_sync_button").addEventListener("click", function () {
        gitPressSyncInterval = setInterval(gitPressSync, 3000)
    })

    $.notify("Welcome to gitpress");

})