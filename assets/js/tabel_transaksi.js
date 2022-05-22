window.addEventListener("DOMContentLoaded", (event) => {
  console.log("oooke");
  $("#datatablesSimple").dataTable({
    columnDefs: [
      { orderable: false, targets: 6 },
      { className: "dt-center", targets: "_all" },
    ],
  });
});
