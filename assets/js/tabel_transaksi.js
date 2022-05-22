window.addEventListener("DOMContentLoaded", (event) => {
  console.log("oke");
  $("#tabelTransaksi").dataTable({
    // buttons: [
    //   {
    //     text: "My button",
    //     action: function (e, dt, node, config) {
    //       alert("Button activated");
    //     },
    //   },
    // ],
    // dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    columnDefs: [
      { orderable: false, targets: 6 },
      { className: "dt-center", targets: "_all" },
    ],
    lengthMenu: [
      [5, 10, 25, 50, 100, -1],
      [5, 10, 25, 50, 100, "Semua"],
    ],
  });
});
