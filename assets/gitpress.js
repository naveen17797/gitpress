var gitPressSyncInterval = null;

var isStartCalled = false;

function gitPressSync() {
    var formData = new FormData();
    formData.set("action", "static_archive_action")
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
            var log = document.getElementById("gitpress_log")
            log.innerHTML = log.innerHTML + data.activity_log_html
            if ( data.done ) {
                clearInterval(gitPressSyncInterval)
            }
        })
}


window.addEventListener("load", function () {


    gitPressSyncInterval = setInterval(gitPressSync, 3000)


})