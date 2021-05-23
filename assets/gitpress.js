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
            var data = data.data
            console.log(data.message)
            return Promise.resolve(data.can_run_next_action)
        })
}


window.addEventListener("load", function () {

    document.getElementById("gitpress_sync_button").addEventListener("click", function () {
        gitPressSyncInterval = setInterval(gitPressSync, 3000)
    })

})