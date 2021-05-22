var gitPressSyncInterval = null;

function gitPressSync() {
    var formData = new FormData();
    formData.set("action", "static_archive_action")
    formData.set("perform", "ping")
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