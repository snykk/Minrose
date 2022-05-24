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
