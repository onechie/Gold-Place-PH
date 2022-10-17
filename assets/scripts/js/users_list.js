$(document).ready(function () {
  "use strict";
  const userList = $("#users-list");
  const userName = $("#users #name")
  const userEmail = $("#users #email")
  const userPhone = $("#users #phone")
  const userImage = $("#users #image")
  const userTotal = $("#users #total")
  const userCancelled = $("#users #cancelled")
  const userDelivered= $("#users #delivered")

  getUsersData();

  $(".users #search-user").on("keyup", function(){
    var value = $(this).val().toLowerCase();
    $("#users-list tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  })

  $("#sort_user_id").click(function(){
    sortTable("id");
  })
  $("#sort_user_name").click(function(){
    sortTable("name");
  })
  $("#sort_user_email").click(function(){
    sortTable("email");
  })
  $("#sort_user_purchased").click(function(){
    sortTable("purchased");
  })

  $("#refresh-users").click(function () {
    getUsersData();
  });

  userList.on("click", ".viewUser", function () {
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    $.post(
      "../assets/scripts/server/catch_admin_request.php",
      {
        id: id,
        requestType: "view-users",
      },
      function (data) {
        if (data && data != "null") {
          let users = JSON.parse(data);
          let user_info = users.user_info;
          let user_orders = users.user_orders;

          let defaultImg = "../assets/images/defaults/default-profile.png";
          let currentImg = "";

          if (user_info.image == "") {
            currentImg = defaultImg;
          } else {
            currentImg = "../assets/images/users/" + user_info.id + "/" + user_info.image;
          }

          userName.text(user_info.name);
          userEmail.text(user_info.email);
          userPhone.text(user_info.phone);
          userImage.prop("src", currentImg);
          userTotal.text(user_orders.orders);
          userCancelled.text(user_orders.cancelled);
          userDelivered.text(user_orders.delivered);
        }
      }
    );
  });

  $("#add-user-btn").click(function(){
    const first_name = $("#add-user #first-name").val();
    const last_name = $("#add-user #last-name").val();
    const email = $("#add-user #email").val();
    const user_type = $("#add-user #user-type").val();
    const password = $("#add-user #password").val();

    $.post("../assets/scripts/server/catch_admin_request.php",{
      requestType:"add-user",
      first_name,
      last_name,
      email,
      user_type,
      password
    }, function(data){
      console.log(data);
    })
  })



    function sortTable(by) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("users-list");
    switching = true;

    dir = "asc";

    while (switching) {

      switching = false;
      rows = table.rows;

      for (i = 0; i < (rows.length - 1); i++) {

        shouldSwitch = false;

        if(by=="id"){
          x = Number($(rows[i]).children(".id").text())
          y = Number($(rows[i+1]).children(".id").text())
        } else if(by=="name"){
          x = $(rows[i].getElementsByTagName("td")[1]).children("div").children(".name").text().toLowerCase()
          y = $(rows[i+1].getElementsByTagName("td")[1]).children("div").children(".name").text().toLowerCase()
        } else if(by=="email"){
          x = $(rows[i]).children(".email").text().toLowerCase()
          y = $(rows[i+1]).children(".email").text().toLowerCase()
        } else {
          x = Number($(rows[i].getElementsByTagName("td")[4]).children(".purchased").text())
          y = Number($(rows[i+1].getElementsByTagName("td")[4]).children(".purchased").text())
        }

        if (dir == "asc") {
          if (x > y) {
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (x < y) {
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount ++;
      } else {
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }

  function getUsersData() {
    $.post(
      "../assets/scripts/server/catch_admin_request.php",
      {
        requestType: "load-users",
      },
      function (data) {
        
        if (data && data != "null") {
          
          let users = JSON.parse(data);
          let htmlData = "";
          userList.empty();
          for (let i = 0; i < users.length; i++) {
            let user = users[i];
            let name = user.first_name+" "+user.last_name;
            let defaultImg = "'../assets/images/defaults/default-profile.png'";
            let currentImg = "";
            if (user.image == "") {
              currentImg = defaultImg;
            } else {
              currentImg =
                "'../assets/images/users/" + user.id + "/" + user.image + "'";
            }
            htmlData += "<tr class='align-middle'>"
                        +"    <td class='ps-4 py-4 id'>"+user.id+"</td>"
                        +"    <td class='ps-4'>"
                        +"        <div class='d-flex align-items-center'>"
                        +"            <div class='position-relative rounded-5 bg-white shadow-sm me-2 flex-shrink-0' style='width:50px; height:50px;'>"
                        +"                <img class='position-absolute m-1 rounded-5' src="+currentImg+" alt='' style='width:42px; height:42px;');>"
                        +"            </div>"
                        +"            <strong class='text-capitalize name text-break'>"+name+"</strong>"
                        +"        </div>"
                        +"    </td>"
                        +"    <td class='ps-4 email text-break'>"+user.email+"</td>"
                        +"    <td class='ps-4 text-break'><strong>"+user.phone+"</strong></td>"
                        +"    <td class='ps-4'><strong class='purchased'>"+user.purchased+"</strong></td>"
                        +"    <td class='ps-4'>"
                        +"        <i class='viewUser bi bi-eye fs-4 text-success icon-btn' data-bs-toggle='modal' data-bs-target='#users'></i>"
                        +"    </td>"
                        +"</tr>"
            }
          userList.append(htmlData)
        }
      }
    );
  }
});
