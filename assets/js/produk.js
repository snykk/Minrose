var image_modal = document.getElementById("modal-image");
$("button.detail").click(function (event) {
  console.log("buttton click");
  // event.preventDefault();
  $.ajax({
    url: "/Project-PPL/produk/getDataProduk",
    data: { id: $(this).attr("data-id") },
    method: "post",
    dataType: "json",
    success: function (response) {
      console.log(response);
      $("#modal-image").attr("src", "/Project-PPL/assets/img/produk/" + response[0].image);
      $(".text-uppercase").html("");
      $(".text-uppercase").append(response[0].nama);
      $(".deskripsi").append(response[0].deskripsi);
      // $(".content .rating").html("Rating : ");
      // $(".content .rating").append(response[0].peringkat);
      // $(".content .bahasa").html("Bahasa : ");
      // $(".content .bahasa").append(response[0].bahasa);
      // $(".content .fitur").html("Fitur Spesial : ");
      // $(".content .fitur").append(response[0].fitur_spesial);
      // $(".content .aktor").html("Aktor : ");
      // for (var i = 0; i < response.length - 1; i++) {
      //   $(".content .aktor").append(response[i].aktor + ", ");
      // }
      // $(".content .aktor").append(response[response.length - 1].aktor);
      // $(".content .kategori").html("Kategori : ");
      // $(".content .kategori").append(response[0].kategori);
      // $("p").html("");
      // $("p").append(response[0].deskripsi);
    },
  });
  // $.get("/Project-PPL/produk/getDataProduk", { id: $(this).attr("data-id") }, function (response) {
  //   console.log(response);
  // console.log("jalankah");

  // });
});
