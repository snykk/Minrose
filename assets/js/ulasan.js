console.log("halo");
// sweetalert 2
$(".link_hapus_ulasan").click(function (e) {
  console.log("clicked");
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "setelah proses ini ulasan akan dihapus",
    icon: "question",
    confirmButtonText: "Hapus",
    cancelButtonColor: "#d33",
    showCancelButton: true,
    confirmButtonColor: "#08a10b",
    timer: 10000,
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

$(".link_edit_ulasan").click(function (e) {
  $.ajax({
    url: "/Minrose/ulasan/getRowUlasan",
    data: { id_user: $(this).attr("data-id_user"), id_produk: $(this).attr("data-id_produk") },
    method: "post",
    dataType: "json",
    success: function (response) {
      console.log(response);
      $("#id_produk").val(response[0].id_produk);
      $("#ulasan_edit").val(response[0].ulasan);
      $("input[type=radio][value=" + response[0].rating + "]").prop("checked", true);
    },
  });
});
