$(document).ready(function () {
  getUsersData();

  $("#refresh-users").click(function () {
    getUsersData();
  });

  $('#users-list').on("click", ".viewUser", function(){
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    $.post(
      "../assets/scripts/server/users_list.php",
      {
        id: id,
        requestType: "view-users",
      },
      function (data){
        if(data) {
          let users = JSON.parse(data);
          let user = users[0];

          let defaultImg = "../assets/images/defaults/default-profile.png";
          let currentImg = "";

          if(user.image == ""){
            currentImg = defaultImg;
          } else {
            currentImg = "../assets/images/users/"+user.id+"/"+user.image;
          }

          $("#users #name").text(user.name);
          $("#users #email").text(user.email);
          $("#users #phone").text(user.phone);
          $("#users #image").prop("src", currentImg);
          $("#users #total").text(user.orders.total);
          $("#users #cancelled").text(user.orders.cancelled);
          $("#users #delivered").text(user.orders.delivered);
        }
      }
    );

  })
  function getUsersData(){
    $.post(
      "../assets/scripts/server/users_list.php",
      {
        requestType: "load-users",
      },
      function (data) {
        if (data) {
          let users = JSON.parse(data);
          $("#users-list").empty();
          for (let i = 0; i < users.length; i++) {
            let user = users[i];
  
            let defaultImg = "'../assets/images/defaults/default-profile.png'";
            let currentImg = "";
            if(user.image == ""){
              currentImg = defaultImg;
            } else {
              currentImg = "'../assets/images/users/"+user.id+"/"+user.image+"'";
            }
  
              $('#users-list').append(
              "<tr class='align-middle'>"
              +"    <td class='ps-4 py-4 id'>"+user.id+"</td>"
              +"    <td class='ps-4'>"
              +"        <div class='d-flex align-items-center'>"
              +"            <span class='position-relative rounded-5 bg-white shadow-sm me-2' style='width:50px; height:50px;'>"
              +"                <img class='position-absolute m-1 rounded-5' src="+currentImg+" alt='' style='width:42px; height:42px;');>"
              +"            </span>"
              +"            <strong class='text-capitalize'>"+user.name+"</strong>"
              +"        </div>"
              +"    </td>"
              +"    <td class='ps-4'>"+user.email+"</td>"
              +"    <td class='ps-4'><strong>"+user.phone+"</strong></td>"
              +"    <td class='ps-4'><strong>"+user.purchased+"</strong></td>"
              +"    <td class='ps-4'>"
              +"        <i class='viewUser bi bi-eye fs-4 text-success icon-btn' data-bs-toggle='modal' data-bs-target='#users'></i>"
              +"    </td>"
              +"</tr>"
              );
          }
        }
      }
    );
  }

});
