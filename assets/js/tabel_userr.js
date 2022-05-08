window.addEventListener("DOMContentLoaded", (event) => {
  const nama_pembeli = document.getElementById("nama_pembeli");
  console.log("oke");
  $("#datatablesSimple").dataTable({ oSearch: { sSearch: $("#nama_pembeli").val() } });
});
