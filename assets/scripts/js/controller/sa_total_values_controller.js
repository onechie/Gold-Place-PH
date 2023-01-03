$(document).ready(function () {

    const token = $(".token").val();

    $.post("../assets/scripts/server/request/system_admin_request.php", {
        requestType:"all-total-data",
        token: token
    },function(data){
        if(data != null && data){
            let totals = JSON.parse(data);
            $(".users .total-values #home-total").text(totals.total);
            $(".users .total-values #home-customer").text(totals.customers);
            $(".users .total-values #home-driver").text(totals.drivers);
            $(".users .total-values #home-admin").text(totals.admins);
        }
    })
});