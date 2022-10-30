$(document).ready(function () {

    const token = $(".token").val();

    $.post("../assets/scripts/server/request/admin_total_values_request.php", {
        requestType:"all-total-data",
        token: token
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