function myCounter() {
  var num = document.getElementById("jumlah_produk");
  var harga = document.getElementById("harga_produk");
  var ongkir = document.getElementById("ongkir");

  var sub_total = parseInt(harga.getAttribute("data-trueHarga")) * num.value;
  var total = sub_total + parseInt(ongkir.getAttribute("data-valueOngkir")) + parseInt(kupon.getAttribute("data-valueKupon"));

  $("#sub-total").html(sub_total);
  $("#total").html(total);
  $("#input_total").val(total);
}
