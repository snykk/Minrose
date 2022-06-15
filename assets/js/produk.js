$("button.detail").click(function (event) {
  console.log("buttton detail click");
  // event.preventDefault();
  $.ajax({
    url: "/Minrose/produk/getDataProduk",
    data: { id: $(this).attr("data-id") },
    method: "post",
    dataType: "json",
    success: function (response) {
      console.log(response);
      $("#modal-image").attr("src", "/Minrose/assets/img/produk/" + response[0].image);
      $(".text-uppercase").html(response[0].nama);
      $(".orientasi").html(response[0].orientasi);
      $(".deskripsi").html(response[0].deskripsi);
      $(".data-dibuat").html("<small> Data dibuat pada <?php echo date('d F Y'," + response[0].data_dibuat + "); ?></small>");
      $(".stok").html("Tersedia: " + "<em>" + response[0].stok + " stok" + "</em>");
      if (response[0].diskon == 0) {
        $(".harga").html("Harga: " + "<strong>Rp. " + response[0].harga + "</strong>");
        $(".diskon").html("Diskon: " + "<em class='text-danger'>tidak ada diskon untuk saat ini</em>");
      } else {
        $(".harga").html("Harga: " + "<strong class='me-2'>" + (1 - response[0].diskon) * response[0].harga + "</strong>" + "<strong class='strikethrough'>" + response[0].harga + "</strong>");
        $(".diskon").html("Diskon: " + "<em class='text-danger'>" + response[0].diskon * 100 + "%" + "</em>");
      }
    },
  });
});

$("button.ubah").click(function (event) {
  console.log("buttton ubah click");
  // event.preventDefault();
  $.ajax({
    url: "/Minrose/produk/getDataProduk",
    data: { id: $(this).attr("data-id") },
    method: "post",
    dataType: "json",
    success: function (response) {
      console.log(response[0]);
      $("#produk_id").val(response[0].id);
      $("#ubah_nama_produk").val(response[0].nama);
      $("#ubah_orientasi").val(response[0].orientasi);
      $("#ubah_deskripsi").val(response[0].deskripsi);
      $("#ubah_harga").val(response[0].harga);
      $("#ubah_stok").val(response[0].stok);
      $("#ubah_diskon").val(response[0].diskon);
      // $("#ubah_image").val(response[0].image);
    },
  });
});
