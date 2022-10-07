$(document).ready(function () {

    const toast = new bootstrap.Toast($("#liveToast"));
    const toastBody = $(".toast-body");

    getProfileData();

    $("#profile #save_profile").click(()=>{
        let address_number = $("#profile #address_number").val();
        let address_street = $("#profile #address_street").val();
        let address_city = $("#profile #address_city").val();
        let address_province = $("#profile #address_province").val();

        $.post("./assets/scripts/server/catch_customer_request.php", {
            requestType:"update_profile",
            number: address_number,
            street: address_street,
            city: address_city,
            province: address_province
        }, function (data) {
            if(data=="ok"){
                toastBody.text("Profile updated successfully!");
            }
            if(data=="failed"){
                toastBody.text("Profile failed to update!");
            }
            toast.show();
            getProfileData()
        })
    })

    function getProfileData(){
        $.post("./assets/scripts/server/catch_customer_request.php", {
            requestType:"get_profile"
        }, function (data) {
            console.log(data);
            if(data && data != null){
                let address_data = JSON.parse(data);
                let address = address_data[0];
                let city_list = address.city_list;
                let province_list = address.province_list;
                let user_data = address.user_data[0];
                let city_options = '';
                let province_options = '';

                let defaultImg = "./assets/images/defaults/default-profile.png";
                let currentImg = "";
                if (user_data.image == "") {
                currentImg = defaultImg;
                } else {
                currentImg =
                    "./assets/images/users/" + user_data.id + "/" + user_data.image + "";
                }

                for(let i=0; i < city_list.length; i++){
                    city_options += "<option value='"+city_list[i]+"'>"+city_list[i]+"</option>"
                }
                $("#profile #address_city").append(city_options);

                for(let i=0; i < province_list.length; i++){
                    province_options += "<option value='"+province_list[i]+"'>"+province_list[i]+"</option>"
                }
                $("#profile #address_province").append(province_options);

                $("#profile #image").prop("src", currentImg);
                $("#profile #name").text(user_data.name);
                $("#profile #email").text(user_data.email);
                $("#profile #phone").text(user_data.phone);
                $("#profile #total").text(user_data.orders.total);
                $("#profile #cancelled").text(user_data.orders.cancelled);
                $("#profile #delivered").text(user_data.orders.delivered);

                $("#profile #address_number").val(address.number);
                $("#profile #address_street").val(address.street);
                $("#profile #address_city").val(address.city);
                $("#profile #address_province").val(address.province);
            }
            
            
        })
    }
});