$(document).ready(function () {
  ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
    console.error(error);
  });
});

function loadUsersOnline() {
  $.get("functions.php?onlineusers=result", function (data) {
    $(".usersonline").text(data);
  });
}

setInterval(function () {
  loadUsersOnline();
}, 500);
