// Script untuk mengatur interaksi saat membayar transaksi
// Mendapatkan input yang berisi total harga keseluruhan
const totalHargaKeseluruhan = document.querySelectorAll(
  ".total_harga_keseluruhan"
);
// Mendapatkan input bayaran yang dimasukkan
const bayar = document.querySelectorAll(".bayar");
// Mendapatkan input kembalian yang ditampilkan di halaman
const kembalianDisplay = document.querySelectorAll(".kembalian_display");
// Mendapatkan input kembalian yang tersembunyi
const kembalianInput = document.querySelectorAll(".kembalian_input");
// Regex (Regular Expression) untuk menyaring input selain angka
const regex = /[^0-9]/g;

for (let i = 0; i < totalHargaKeseluruhan.length; i++) {
  // Event listener saat input bayar berubah
  bayar[i].addEventListener("input", function () {
    // Jika memasukkan selain angka pada input
    if (regex.test(bayar[i].value)) {
      // Karakter tersebut akan dihapus
      bayar[i].value = bayar[i].value.replace(regex, "");
    }
    // Jika input bayar tidak kosong
    if (bayar[i].value != "") {
      // Akan menampilkan nilai kembalian
      kembalianDisplay[i].value = (
        parseInt(this.value) - parseInt(totalHargaKeseluruhan[i].value)
      ).toLocaleString("id-ID", {
        style: "currency",
        currency: "IDR",
      });
    }

    // Mengatur nilai input kembalian yang tidak terlihat
    kembalianInput[i].value =
      parseInt(this.value) - parseInt(totalHargaKeseluruhan[i].value);
  });
}
