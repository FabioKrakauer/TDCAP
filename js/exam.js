$(document).ready(function () {
    let startTime = new Date()
    let finishTime

    examTime = function () {
        finishTime = new Date()
        let finalTime = ((finishTime - startTime)/1000).toFixed()
        $('#exam-time').val(finalTime)
    }
})
