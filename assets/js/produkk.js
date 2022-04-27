var image_modal = document.getElementById("modal-image");
$("button.detail").click(function (event) {
  console.log("buttton detail click");
  // event.preventDefault();
  $.ajax({
    url: "/Project-PPL/produk/getDataProduk",
    data: { id: $(this).attr("data-id") },
    method: "post",
    dataType: "json",
    success: function (response) {
      console.log(response);
      $("#modal-image").attr("src", "/Project-PPL/assets/img/produk/" + response[0].image);
      $(".text-uppercase").html(response[0].nama);
      $(".orientasi").html(response[0].orientasi);
      $(".deskripsi").html(response[0].deskripsi);
      $(".harga").html("Harga: " + "<strong>Rp. " + response[0].harga + "</strong>");
      $(".stok").html("Tersedia: " + "<em>" + response[0].stok + " stok" + "</em>");
    },
  });
});

$("button.ubah").click(function (event) {
  console.log("buttton ubah click");
  // event.preventDefault();
  $.ajax({
    url: "/Project-PPL/produk/getDataProduk",
    data: { id: $(this).attr("data-id") },
    method: "post",
    dataType: "json",
    success: function (response) {
      console.log(response);
      $("#ubah_nama_produk").val(response[0].nama);
      $("#ubah_orientasi").val(response[0].orientasi);
      $("#ubah_deskripsi").val(response[0].deskripsi);
      $("#ubah_harga").val(response[0].harga);
      $("#ubah_stok").val(response[0].stok);
      $("#ubah_diskon").val(response[0].diskon);
      $("#ubah_image").val(response[0].image);
    },
  });
});
