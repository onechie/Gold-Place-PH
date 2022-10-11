$(document).ready(function () {

    $recentOrders = $(".orders #recent-orders")

    $.post("../assets/scripts/server/catch_admin_request.php",{
        requestType:"get-recent-orders"
    }, function (data) {
        $recentOrders.empty();
        
        if (data && data != "null") {
            let orders = JSON.parse(data);
            let htmlData = '';
            for(let i=0; i < orders.length; i++){

                let order = orders[i];

                let defaultImg = "'../assets/images/defaults/default-profile.png'";
                let currentImg = "";

                if (order.user_image == "") {
                currentImg = defaultImg;
                } else {
                currentImg =
                    "'../assets/images/users/" + order.user_id + "/" + order.user_image + "'";
                }

                htmlData+= "<tr class='align-middle'>"
                +"<td class='ps-4'>"
                +"    <div class='d-flex align-items-center'>"
                +"        <span class='position-relative rounded-5 bg-white shadow-sm me-3' style='width:50px; height:50px'>"
                +"            <img class='position-absolute m-1 bg-primary rounded-5' src="+currentImg+" alt='' style='width:42px; height:42px'>"
                +"        </span>"
                +"        <div class=''>"
                +"            <strong>"+order.user_name+"</strong>"
                +"            <br>"
                +"            <span class='text-muted fs-7'>"+order.user_email+"</span>"
                +"        </div>"
                +"    </div>"
                +"</td>"
                +"<td class='ps-4'>"+order.items+"</td>"
                +"<td class='ps-4'>"+order.date+"</td>"
                +"<td class='ps-4'>"+order.order_status+"</td>"
                +"<td class='px-4'>"
                +"    <a class='text-success' href=''><i class='bi bi-eye fs-3'></i></a>"
                +"</td>"
                +"</tr>"

            }
            $recentOrders.append(htmlData);
        }


    })  
})