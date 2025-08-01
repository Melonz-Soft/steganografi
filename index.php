<!DOCTYPE html>
<!-- Menandakan bahwa ini adalah dokumen HTML5 -->
<html lang="id">
<!-- Menandakan bahwa bahasa utama halaman ini adalah Bahasa Indonesia -->
<head>
  <meta charset="UTF-8" />
  <!-- Mengatur karakter encoding menjadi UTF-8 agar mendukung karakter internasional -->
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Membuat halaman responsif agar tampil baik di berbagai ukuran layar (HP, tablet, desktop) -->

  <title>Login - Portal Rahasia</title>
  <!-- Judul yang akan tampil di tab browser -->

  <!-- Memuat Tailwind CSS untuk styling modern dan responsif -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Memuat Feather Icons jika ingin menggunakan ikon SVG ringan -->
  <script src="https://unpkg.com/feather-icons"></script>

  <!-- Memuat stylesheet untuk plugin alert modern -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/PesonaCoding/modern-alert@main/modern-alert.css">

  <!-- Memuat script JavaScript dari plugin alert modern -->
  <script src="https://cdn.jsdelivr.net/gh/PesonaCoding/modern-alert@main/modern-alert.js"></script>

  <!-- Mengimpor font Poppins dari Google Fonts untuk tampilan teks yang lebih elegan -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    /* Mengatur font dan background halaman dengan gambar yang menutupi seluruh layar */
    body {
      font-family: 'Poppins', sans-serif;
      background: url('http://fands.infinityfreeapp.com/pixelite/uploads/687f483ac4096_1753172026.jpeg') no-repeat center center/cover;
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-black bg-opacity-60">
  <!-- Membuat layout tengah secara vertikal dan horizontal, serta memberikan efek gelap transparan -->

  <div class="bg-white bg-opacity-10 backdrop-blur-md shadow-2xl p-10 rounded-xl w-full max-w-md">
    <!-- Kotak transparan dengan efek blur dan shadow sebagai kontainer form login -->

    <h2 class="text-3xl font-semibold text-center text-white mb-6">Login</h2>
    <!-- Judul besar halaman login -->

    <form action="" method="post" class="space-y-4">
      <!-- Formulir untuk input username dan password -->

      <div>
        <!-- Input username -->
        <label class="block text-white font-medium">Username</label>
        <input type="text" name="username" required
          class="w-full mt-1 p-3 rounded-lg bg-white bg-opacity-20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <!-- Input password -->
        <label class="block text-white font-medium">Password</label>
        <input type="password" name="password" required
          class="w-full mt-1 p-3 rounded-lg bg-white bg-opacity-20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div class="text-center">
        <!-- Tombol submit login -->
        <button type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300">
          🚀 Login Sekarang
        </button>
      </div>
    </form>

    <p class="text-sm text-center text-gray-300 mt-6 italic">Lupa password? Yaudah relain aja</p>
    <!-- Kalimat bercanda di bawah form untuk user yang lupa password -->
  </div>

  <?php
  // Mengecek apakah user menekan tombol submit (mengirimkan data)
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menyimpan data dari inputan form ke variabel
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Menggabungkan data input ke satu string, ini yang akan disisipkan ke gambar
    $dataToHide = "Username: $username | Password: $password";

    // Gambar dasar yang akan digunakan sebagai tempat menyimpan data tersembunyi
    $baseImage = 'input.jpg';

    // Nama file hasil penyimpanan akan berbeda tiap kali login (agar tidak menimpa file lama)
    $outputImage = 'output_' . time() . '.jpg';

    // Membaca isi file gambar asli
    $original = file_get_contents($baseImage);

    // Menggabungkan isi gambar dengan data tersembunyi di akhir (pakai HTML comment agar tak terlihat)
    $combined = $original . "\n<!--hidden:$dataToHide-->";

    // Menyimpan hasil gambar baru yang sudah berisi data tersembunyi
    file_put_contents($outputImage, $combined);

    // Menampilkan alert notifikasi bahwa data berhasil disimpan ke gambar
    echo "<script>
            ModernAlert.show({
              type: 'info',
              title: 'Berhasil!',
              message: 'Data login disimpan ke $outputImage'
            })
          </script>";
  }
  ?>
</body>
</html>

