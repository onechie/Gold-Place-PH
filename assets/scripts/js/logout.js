$(document).ready(function () {
  "use strict";
  $("#logout-button").click(function () {
    $.get("./assets/scripts/server/logout.php", function () {
      location.reload();
    });
  });
  $("#logout-a").click(function () {
    $.get("../assets/scripts/server/logout.php", function () {
      location.reload();
    });
  });
});