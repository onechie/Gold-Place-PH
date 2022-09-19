$(document).ready(function () {

    $('#logout-button').click(function() {
        $('#logout-button').load("../script/server/logout.php",
        function(){
            location.reload();
        }
        );
    })

});