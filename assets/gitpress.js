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
            showMessageOnAdminBar(data.activity_log_html, false)

            if (data.done) {
                clearInterval(gitPressSyncInterval)
                gitPressCustomAction("gitpress_commit_changes")
                    .then(() => gitPressCustomAction("gitpress_push"))
                    .then(() => {
                        showMessageOnAdminBar("Sync completed, Click to start again");
                    })

            }

        })
}


function showMessageOnAdminBar(message, isError) {
    var adminBarArea = document.getElementById("gitpress_sync_button")
    adminBarArea.innerText = message
}

function gitPressCustomAction(action) {
    var formData = new FormData();
    formData.set("action", action)
    return fetch(ajaxurl, {
        method: "POST", body: formData
    }).then(response => response.json())
        .then(responseData => {
            var data = responseData.data

            if (data.can_run_next_action) {
                showMessageOnAdminBar(data.message, false)
                return Promise.resolve(data.can_run_next_action)
            } else {
                showMessageOnAdminBar(data.message, true)
                return Promise.reject(data)
            }
        })
}


window.addEventListener("load", function () {

    var syncButton = document.getElementById("gitpress_sync_button")

    if (syncButton) {
        syncButton.addEventListener("click", function () {
            gitPressCustomAction("gitpress_should_do_sync")
                .then(() => gitPressCustomAction("gitpress_clone_repo_action"))
                .then(() => {
                    gitPressSyncInterval = setInterval(gitPressSync, 3000)
                })


        })
    }

})