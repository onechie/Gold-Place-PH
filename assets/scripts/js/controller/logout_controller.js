$(document).ready(function () {
  "use strict";
  $("#logout-button").click(function () {
    $.get("./assets/scripts/server/request/logout_request.php", function () {
      location.reload();
    });
  });
  $("#logout-a").click(function () {
    $.get("../assets/scripts/server/request/logout_request.php", function () {
      location.reload();
    });
  });
});