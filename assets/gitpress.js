var gitPressSyncInterval = null;

var isStartCalled = false;

function gitPressSync(action="static_archive_action") {
    var formData = new FormData();
    formData.set("action", action)
    if ( isStartCalled) {
        formData.set("perform", "ping")
    }
    else {
        formData.set("perform", "start")
        isStartCalled = true
    }

    fetch(ajaxurl, {
        method: "POST", body: formData
    }).then(response => response.json())
        .then(data => {
            var message = data.activity_log_html ? data.activity_log_html : data.data.activity_log_html
            var log = document.getElementById("gitpress_log")
            log.innerHTML = log.innerHTML + message
            if ( data.done ) {
                clearInterval(gitPressSyncInterval)
                gitPressSync("gitpress_commit_changes")
            }

        })
}


window.addEventListener("load", function () {


    gitPressSyncInterval = setInterval(gitPressSync, 3000)
    gitPressSync("gitpress_push")

})