window.addEventListener("DOMContentLoaded", (event) => {
  console.log("oooke");
  $("#datatablesSimple").dataTable({ oSearch: { sSearch: $("#username").val() } });
});
