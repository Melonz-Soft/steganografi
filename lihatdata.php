<?php
$hasil = ""; // Menyimpan hasil pengecekan (berupa pesan HTML)

// Mengecek apakah form dikirim (method POST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Mengecek apakah ada file yang diupload dan tidak terjadi error
  if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {

    $fileTmpPath = $_FILES['gambar']['tmp_name']; // Menyimpan lokasi sementara file upload
    $fileType = $_FILES['gambar']['type']; // Menyimpan tipe file yang diupload (misal image/jpeg)

    // Membatasi file hanya boleh JPG/JPEG
    $allowed = ['image/jpeg', 'image/jpg'];
    if (!in_array($fileType, $allowed)) {
      // Jika bukan JPG/JPEG, tampilkan pesan error
      $hasil = "<p class='text-red-500'>❌ File harus JPG/JPEG</p>";
    } else {
      // Membaca isi file yang diupload
      $content = file_get_contents($fileTmpPath);

      // Mencari apakah ada data tersembunyi dalam file (menggunakan pola <!--hidden:isi-->)
      if (preg_match('/<!--hidden:(.*?)-->/s', $content, $matches)) {
        $hiddenData = htmlspecialchars($matches[1]); // Mengambil isi tersembunyi & menghindari script berbahaya
        $hasil = "<div class='bg-green-100 text-green-800 p-4 rounded-lg'><b>✅ Data Tersembunyi:</b><br><pre class='mt-2 text-sm'>$hiddenData</pre></div>";
      } else {
        // Jika tidak ditemukan data tersembunyi
        $hasil = "<p class='text-yellow-500'>⚠️ Tidak ditemukan data tersembunyi.</p>";
      }
    }

  } else {
    // Jika file gagal diupload
    $hasil = "<p class='text-red-500'>❌ Gagal upload file.</p>";
  }
}
?>

<!DOCTYPE html>
<!-- Menandakan bahwa ini adalah dokumen HTML5 -->
<html lang="id">
<head>
  <meta charset="UTF-8">
  <!-- Mengatur encoding karakter agar mendukung huruf latin dan simbol -->

  <title>Cek Gambar Steganografi</title>
  <!-- Judul halaman yang tampil di tab browser -->

  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Menggunakan Tailwind CSS untuk tampilan modern -->

  <!-- Font Poppins agar teks lebih menarik dan profesional -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    /* Mengatur font dan background halaman agar terlihat elegan dan gelap */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen text-white px-4">
  <!-- Membuat halaman agar kontennya berada di tengah layar, responsif, dan berwarna putih -->

  <div class="bg-white bg-opacity-10 backdrop-blur-md p-10 rounded-xl shadow-lg w-full max-w-xl">
    <!-- Kotak semi transparan dengan efek blur sebagai wadah utama -->

    <h1 class="text-2xl font-bold mb-6 text-center">🔍 Periksa Gambar Tersembunyi</h1>
    <!-- Judul halaman -->

    <form method="post" enctype="multipart/form-data" class="space-y-4">
      <!-- Form untuk upload file, dengan metode POST dan tipe file -->

      <input type="file" name="gambar" accept=".jpg,.jpeg" required
        class="w-full bg-white bg-opacity-20 text-white p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
      <!-- Input pilih file (hanya menerima JPG/JPEG) -->

      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg transition duration-300 font-semibold">
        Cek Sekarang
      </button>
      <!-- Tombol kirim form -->
    </form>

    <div class="mt-6">
      <?= $hasil ?>
      <!-- Bagian untuk menampilkan hasil pengecekan (berisi pesan sukses/gagal atau data tersembunyi) -->
    </div>
  </div>
</body>
</html>

