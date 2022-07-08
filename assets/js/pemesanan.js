var isUseKupon = false;
var totalKupon;
var currentNum = 0;
var kuponUsed = 0;

window.onload = function () {
  totalKupon = parseInt($("#kupon").attr("data-valueKupon"));
  if ($("#kuponUsedShow").attr("data-kuponUsed") != null) {
    kuponUsed = parseInt($("#kuponUsedShow").attr("data-kuponUsed"));
  }
  $("#kuponUsedShow").html(`${kuponUsed} kupon`);
}

function changeKuponStatus() {
  isUseKupon = !isUseKupon;
}

// ================ order summary ==================
var sub_total
var total
var ongkir
// ===============================================


// counter order summary [buat ]
function myCounter() {
  var num = parseInt(document.getElementById("jumlah_produk").value);
  var harga = parseInt(document.getElementById("harga_produk").getAttribute("data-trueHarga"));
  ongkir = parseInt(document.getElementById("ongkir").getAttribute("data-valueOngkir"));

  if (jumlah_produk != null && id_produk != null && destinasi != null) {
    setOngkir({ destination: destinasi, qty: num, idProd: id_produk })
  }

  if (isUseKupon && totalKupon > 0 && currentNum < num) {
    // ketika user menggunakan kupon
    totalKupon = totalKupon - 1;
    kuponUsed = kuponUsed + 1;
  } else if (isUseKupon && kuponUsed > 0 && currentNum > num) {
    totalKupon = totalKupon + 1;
    kuponUsed = kuponUsed - 1;
  } else if (!isUseKupon && kuponUsed > 0) {
    totalKupon = totalKupon + 1;
    kuponUsed = kuponUsed - 1;
  }

  sub_total = harga * (num - kuponUsed);
  total = sub_total + ongkir;

  $("#kupon").html(`${totalKupon} kupon`);
  $("#kuponUsed").val(kuponUsed);
  $("#kuponUsedShow").html(`${kuponUsed} kupon`);

  refresh_data({ sub_total: sub_total, total: total })
  currentNum = num;
}

function refresh_data({ sub_total = 0, ongkir = 0, total = 0 }) {
  if (total != 0) {
    $("#input_total").val(total);
    $("#total").html(total);
  }
  if (sub_total != 0) {
    $("#sub-total").html(sub_total);
  }
  if (ongkir != 0) {
    $("#ongkir").attr("data-valueOngkir", ongkir);
    $("#ongkir").html(ongkir);
  }
}

// modal detail data pemesanan
$("a.detail_data_pemesanan[title='detail pemesanan']").click(function (event) {
  $.ajax({
    url: "/Minrose/pemesanan/getDataPemesanan",
    data: { id: $(this).attr("data-id"), data_dipesan: $(this).attr("data-dipesan") },
    method: "post",
    dataType: "json",
    success: function (response) {
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
      $("#catatan_transaksi_detail").html(response[0].alasan_penolakan ? response[0].alasan_penolakan : response[0].catatan_pemesanan);
      $("#total_harga_detail").html(response[0].total_harga);
      $("#bukti_transfer_detail").attr("src", "/Minrose/assets/img/bukti/" + response[0].bukti_transfer);
      $("#image_detail").attr("src", "/Minrose/assets/img/produk/" + response[0].image_produk);
      $("#link_bukti_transfer").attr("data-id", response[0].id_pemesanan);
      $("#link_bukti_transfer").attr("data-dipesan", response[1]);

      if (response[0].kuponUsed != null) {
        $("#content-kuponUsed").html(`<span class="link-danger" style="cursor: pointer; ">` + response[0].kuponUsed + ` kupon</span> digunakan untuk pemesanan ini`);
      } else {
        $("#content-kuponUsed").html(`tidak ada kupon yang digunakan untuk pemesanan ini`);
      }

      // [user] link ubah
      $("#link_ubah").each(function () {
        if (response[0].id_status == 2) {
          $(this).removeAttr("data-bs-dismiss");
          $(this).removeAttr("data-bs-toggle");
          this.href = "/Minrose/pemesanan/ubah_pemesanan?id=" + response[0].id_pemesanan;
        } else if (response[0].id_status == 1) {
          $(this).attr("data-bs-dismiss", "modal");
          $(this).attr("data-bs-toggle", "modal");
          this.href = "#ModalAlertPemesanan";
          $("#kontent_modal_pemesanan").html('Aksi <strong class="link-danger">dibatalkan</strong> tidak bisa mengubah data pemesanan yang telah disetujui admin');
        } else if (response[0].id_status == 3) {
          $(this).attr("data-bs-dismiss", "modal");
          $(this).attr("data-bs-toggle", "modal");
          this.href = "#ModalAlertPemesanan";
          $("#kontent_modal_pemesanan").html('Aksi <strong class="link-danger">dibatalkan</strong> tidak bisa mengubah data pemesanan yang telah ditolak admin');
        } else if (response[0].id_status == 4) {
          $(this).attr("data-bs-dismiss", "modal");
          $(this).attr("data-bs-toggle", "modal");
          this.href = "#ModalAlertPemesanan";
          $("#kontent_modal_pemesanan").html('Aksi <strong class="link-danger">dibatalkan</strong> tidak bisa mengubah data riwayat pemesanan');
        }
      });

      $("#link_batalkan").each(function () {
        // btn batalkan akan dihilangkan jika id status selain pending
        if (response[0].id_status != 2) {
          $("#btn_batalkan_pemesanan").css("display", "none");
        }
        this.href = "/Minrose/pemesanan/dibatalkan?id_pemesanan=" + response[0].id_pemesanan;
      });

      // [admin] konfirmasi pemesanan
      $("#link_tolak").each(function () {
        // this.href += "?id=" + response[0].id_pemesanan;
        $(this).attr("data-idPemesanan", response[0].id_pemesanan);
      });
      $("#link_selesai").each(function () {
        this.href = "/Minrose/pemesanan/selesai?id_pemesanan=" + response[0].id_pemesanan;
      });
      $("#link_setujui").each(function () {
        this.href = "/Minrose/pemesanan/disetujui?id_pemesanan=" + response[0].id_pemesanan;
      });

      // restrict fitur upload bukti untuk metode pembayaran COD
      if (response[0].metode_pembayaran == "COD") {
        // menghilangkan element sesuai metode pembayaran
        $("#modal_section_detail_bukti").css("display", "none");
        $("#row_bank").css("display", "none");
      } else {
        // untuk memunculkan kembali element yang dihilangkan
        $("#modal_section_detail_bukti").css("display", "unset");
        $("#row_bank").css("display", "table-row");
      }

      // jika status dari pemesanan "dibatalkan"
      if (response[0].id_status == 5) {
        $("#link_ubah").css("display", "none");
        $("#link_batalkan").css("display", "none");
        $("#message").css("display", "unset");
      } else {
        // untuk memunculkan kembali element yang dihilangkan
        $("#link_ubah").css("display", "unset");
        $("#link_batalkan").css("display", "unset");
        $("#message").css("display", "none");
      }
    },
  });
});

// modal action upload bukti
$("a.iniUploadBukti").click(function (event) {
  $.ajax({
    url: "/Minrose/pemesanan/getBuktiTransfer",
    data: { id: $(this).attr("data-id") },
    method: "post",
    dataType: "json",
    success: function (response) {
      $("#id_pemesanan_upload").val(response[0].id);
      $("#image_ubah").attr("src", "/Minrose/assets/img/bukti/" + response[0].bukti_transfer);
    },
  });
});

// id tolak diklik
$("#link_tolak").click(function (e) {
  $("#id_pemesanan_ditolak").val($(this).attr("data-idPemesanan"));
});

// sweetalert 2
$("#link_selesai").click(function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "data pemesanan akan diakhiri",
    icon: "question",
    confirmButtonText: "Akhiri",
    cancelButtonColor: "#d33",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    timer: 10000,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Aksi anda sedang diproses", "", "success").then((_) => (document.location.href = href));
    } else {
      Swal.fire("Gagal mengakhiri pesanan", "", "info");
    }
  });
});

// sweetalert 2
$("#link_setujui").click(function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "setujui pemesanan",
    icon: "question",
    confirmButtonText: "Setujui",
    cancelButtonColor: "#d33",
    showCancelButton: true,
    confirmButtonColor: "#08a10b",
    timer: 10000,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Aksi anda sedang diproses", "", "success").then((_) => (document.location.href = href));
    } else {
      Swal.fire("Gagal menyetujui pesanan", "", "info");
    }
  });
});

// sweetalert 2
$("#link_batalkan").click(function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "setelah proses ini, data pemesanan tidak lagi valid dan tidak dapat diubah",
    icon: "question",
    confirmButtonText: "Batalkan",
    cancelButtonColor: "#d33",
    showCancelButton: true,
    confirmButtonColor: "#08a10b",
    timer: 10000,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Aksi anda sedang diproses", "", "success").then((_) => (document.location.href = href));
    } else {
      Swal.fire("Gagal membatalkan pesanan", "", "info");
    }
  });
});

// link detail bukti transfer diklik
$("#link_bukti_transfer").click(function (event) {
  $.ajax({
    url: "/Minrose/pemesanan/getBuktiTransfer",
    data: { id: $(this).attr("data-id"), data_dipesan: $(this).attr("data-dipesan") },
    method: "post",
    dataType: "json",
    success: function (response) {
      $("#image_detail_bukti").attr("src", "/Minrose/assets/img/bukti/" + response[0].bukti_transfer);
    },
  });
});


$("#submit_simpan_perubahan").click(function (e) {
  e.preventDefault();
  var form = document.getElementById("form_ubah_pemesanan");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "setelah proses ini data pemesanan akan diubah",
    icon: "question",
    confirmButtonText: "Simpan",
    cancelButtonColor: "#d33",
    showCancelButton: true,
    confirmButtonColor: "#08a10b",
    timer: 10000,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Aksi anda sedang diproses", "", "success").then((_) => form.submit());
    } else {
      Swal.fire("Gagal mengubah pesanan", "", "info");
    }
  });
});

$("#hapus_bukti_transfer").click(function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "setelah proses ini bukti transfer akan dihapus",
    icon: "warning",
    confirmButtonText: "Hapus",
    cancelButtonColor: "grey",
    showCancelButton: true,
    confirmButtonColor: "red",
    timer: 10000,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Aksi anda sedang diproses", "", "success").then((_) => document.location.href = href);
    } else {
      Swal.fire("Gagal menghapus bukti transfer", "", "info");
    }
  });
});



// ===================================  Ongkir  =======================================
// ==== DATA ====
var id_produk;
var destinasi;
var jumlah_produk

// ==============


function getLokasi() {
  $op = $("#select_provinsi");

  $.getJSON("/Minrose/ongkir/provinsi", function (data) {
    $.each(data, function (i, field) {
      $op.append('<option value="' + field.province_id + '">' + field.province + '</option>');
    });
  });
}

getLokasi();

$("#select_provinsi").on("change", function (e) {
  e.preventDefault();
  var option = $('option:selected', this).val();
  $('#select_kota option:gt(0)').remove();
  $('#kurir').val('');

  if (option === '') {
    alert('null');
    $("#select_kota").prop("disabled", true);
    $("#kurir").prop("disabled", true);
  } else {
    $("#select_kota").prop("disabled", false);
    getKota(option);
  }
});

$("#select_kota").on("change", function (e) {
  e.preventDefault();

  id_produk = $("#jumlah_produk").attr("data-idProduk");
  destinasi = $(this).val();
  jumlah_produk = $("#jumlah_produk").val();

  setOngkir({ destination: destinasi, qty: jumlah_produk, idProd: id_produk });
});

function getKota(idpro) {
  var $op = $("#select_kota");

  $.getJSON("/Minrose/ongkir/kota/" + idpro, function (data) {
    $.each(data, function (i, field) {
      $op.append('<option value="' + field.city_id + '">' + field.type + ' ' + field.city_name + '</option>');
    });
  });
}

function setOngkir({ origin = "86", destination, qty, courier = "jne", idProd }) {
  $.getJSON("/Minrose/ongkir/tarif/" + origin + "/" + destination + "/" + qty + "/" + courier + "/" + idProd, function (data) {
    ongkir = data[0]['costs'][0]["cost"][0]["value"];
    total = sub_total + ongkir;
    refresh_data({ ongkir: ongkir, sub_total: sub_total, total: total })
  });
}
