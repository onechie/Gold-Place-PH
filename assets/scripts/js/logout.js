$(document).ready(function () {

    $('#logout-button').click(function() {
        $('#logout-button').load("./assets/scripts/server/logout.php",
        function(){
            location.reload();
        }
        );
    })

});