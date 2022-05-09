// counter order summary [buat ]
console.log("hallo");
function myCounter() {
  var num = document.getElementById("jumlah_produk");
  var harga = document.getElementById("harga_produk");
  var ongkir = document.getElementById("ongkir");

  console.log(num.value);

  var sub_total = parseInt(harga.getAttribute("data-trueHarga")) * num.value;
  var total = sub_total + parseInt(ongkir.getAttribute("data-valueOngkir")) + parseInt(kupon.getAttribute("data-valueKupon"));

  $("#sub-total").html(sub_total);
  $("#total").html(total);
  $("#input_total").val(total);
}

// modal detail data pemesanan
$("a.detail_data_pemesanan[title='detail pemesanan']").click(function (event) {
  console.log("buttton detail click");
  // event.preventDefault();
  $.ajax({
    url: "/Project-PPL/pemesanan/getDataPemesanan",
    data: { id: $(this).attr("data-id"), data_dipesan: $(this).attr("data-dipesan") },
    method: "post",
    dataType: "json",
    success: function (response) {
      console.log(response);
      // $("#modal-image").attr("src", "/Project-PPL/assets/img/produk/" + response[0].image);
      $("#username_detail").html("@" + response[0].username);
      $("#tanggal_dipesan_detail").html(response[1]);
      $("#jumlah_produk_detail").html(response[0].jumlah_produk);
      $("#alamat_detail").html(response[0].alamat_pemesanan);
      $("#metode_detail").html(response[0].metode_pembayaran);
      $("#status_detail").html(response[0].status_pemesanan);
      $("#style_status")
        .removeClass()
        .addClass("spinner-grow spinner-grow-sm text-" + response[0].style_status);
      $("#bank_detail").html(response[0].nama_bank);
      $("#no_rekening_detail").html(response[0].no_rekening);
      $("#catatan_transaksi_detail").html(response[0].catatan_pemesanan);
      $("#total_harga_detail").html(response[0].total_harga);
      $("#bukti_transfer_detail").attr("src", "/Project-PPL/assets/img/bukti/" + response[0].bukti_transfer);
      $("#image_detail").attr("src", "/Project-PPL/assets/img/produk/" + response[0].image_produk);
      $("#link_ubah").each(function () {
        this.href += "?id=" + response[0].id_pemesanan;
      });
      if (response[0].metode_pembayaran == "COD") {
        // menghilangkan element sesuai metode pembayaran
        $("#modal_section_detail_bukti").css("display", "none");
        $("#row_bank").css("display", "none");
      } else {
        // untuk memunculkan kembali element yang dihilangkan
        $("#modal_section_detail_bukti").css("display", "unset");
        $("#row_bank").css("display", "table-row");
      }
    },
  });
});
