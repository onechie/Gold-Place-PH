$(document).ready(function(){

    getItemsData();

    $("#item-list").on("click", ".viewItem", (function(){
        let id = $(this).siblings(".id").val();
        $.post("./assets/scripts/server/item_data.php", {requestType:"load-item", id:id}, function(data){
            if(data) {
                let itemInfo = JSON.parse(data);
                let item = itemInfo[0];
                console.log(item);

                $("#image-carousel .carousel-inner").empty();

                for(let i=0; i < item.images.length; i++){
                    let setActive = "active";
                    if (i == 0)setActive = "active";
                    else setActive = ""

                    $("#image-carousel .carousel-inner").append(
                    "<div class='carousel-item "+setActive+" ratio ratio-1x1' style='max-width: 400px;'>"
                    +"    <img src='./assets/images/items/"+item.id+"/"+item.images[i]+"' class='d-block rounded-4' alt='image' style='object-fit: cover;'>"
                    +"</div>"
                    );
                }

                $("#item #item-name").text(item.name);
                $("#item #item-price").text(item.price);
                $("#item #item-sold").text(item.sold);
                $("#item #item-stocks").text(item.stocks);
                $("#item #item-description").text(item.description);

            }
        })

    }))

    $("#next").click(function(){
        let page = parseInt($("#page").val());
        page+=1;
        $("#page").val(page);
        getItemsData();
    })
    
    $("#previous").click(function(){
        let page = parseInt($("#page").val());
        page-=1;
        $("#page").val(page);
        getItemsData();
    })

    function getItemsData(){
        let page = $("#page").val();
        $.post("./assets/scripts/server/item_data.php",{requestType:"load-items", page: page}, function(data){
        //CHECK IF JSON DATA IS NOT EMPTY
        if (data) {
        //PUT THE JSON DATA INTO ARRAY
        let itemInfo = JSON.parse(data);

        let cardCount = 0;
        $("#user-panel #item-list").hide();

        $("#user-panel #item-list").empty();
        //GET THE DATA ON EACH JSON
        for (let i = 0; i < itemInfo.length; i++) {
            let item = itemInfo[i];
            cardCount = i;
            
            //if(i <= (page*cardCount-1)-8 || i >= (page*cardCount))continue;
            //PUT INTO ITEM LIST DIVIDER WITH THE ITEM VALUES
            $("#user-panel #item-list").append(
                "<div class='card shadow my-3 bg-light p-2 rounded-4 mx-1'>"
                +"    <img src='./assets/images/items/"+item.id+"/"+item.images[0]+"' class='card-img-top' alt='...'>"
                +"    <div class='card-body pb-0 px-1'>"
                +"        <h6 class='card-title m-0 fs-6 fw-light text-dark'>"+item.name+"</h6>"
                +"        <h6 class='card-text text-warning m-0 fs-5 fw-normal'><span>&#8369;</span>"+item.price+"</h6>"
                +"        <div class='row justify-content-between'>"
                +"            <div class='col-6 my-auto'>"
                +"                <span class='align-middle'>"
                +"                    <i class='bi bi-star-fill text-warning'></i>"
                +"                    <i class='bi bi-star-fill text-warning'></i>"
                +"                    <i class='bi bi-star-fill text-warning'></i>"
                +"                    <i class='bi bi-star-fill text-warning'></i>"
                +"                    <i class='bi bi-star-fill text-warning'></i>"
                +"                </span>"
                +"            </div>"
                +"            <div class='col-6 text-end'>"
                +"                <input type='hidden' class='id' value='"+item.id+"'>"
                +"                <button type='button' class='addCart btn btn-outline-warning'><i class='bi bi-bag-plus'></i></button>"
                +"                <button type='button' class='viewItem btn btn-outline-warning' data-bs-toggle='modal' data-bs-target='#item'><i class='bi bi-search'></i></button>"
                +"            </div>"
                +"        </div>"
                +"    </div>"
                +"</div>"
            )
        }
        $("#user-panel #item-list").fadeIn();
        if(page == 1){
            $("#previous").prop("disabled", true);
        } else {
            $("#previous").prop("disabled", false);
        }
        if(cardCount < 7){
            $("#next").prop("disabled", true);
        } else {
            $("#next").prop("disabled", false);
        }

        }

        })
    }

    
});