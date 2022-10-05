$(document).ready(function () {
  "use strict";
  $("#logout-button").click(function () {
    $("#logout-button").load("./assets/scripts/server/logout.php", function () {
      location.reload();
    });
  });
});
