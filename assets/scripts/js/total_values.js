$(document).ready(function () {


    $.post("../assets/scripts/server/catch_admin_request.php", {
        requestType:"all-total-data"
    },function(data){
        if(data != null && data){
            let totals = JSON.parse(data);

            $("#total-sales").text(totals.sales);
            $("#total-orders").text(totals.orders);
            $(".total-values #home-sales").text(totals.sales);
            $(".total-values #home-orders").text(totals.orders);
            $(".total-values #home-stocks").text(totals.stocks);
            $(".total-values #home-users").text(totals.users);
        }
    })
});