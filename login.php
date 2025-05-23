<?php
// 1) Türkçe karakter uyumu
header('Content-Type: text/html; charset=UTF-8');

// 2) Beklenen kullanıcı ve şifre
$expectedUser = 'b241210380@sakarya.edu.tr';  // Kendi e-posta adresin
$expectedPass = 'b241210380';                 // Sadece öğrenci numaran (domain olmadan)

// 3) Formdan gelen POST verilerini al ve temizle
$user = isset($_POST['username']) ? trim($_POST['username']) : '';
$pass = isset($_POST['password']) ? trim($_POST['password']) : '';

// 4) Kontrol: Doğru mu?
if ($user === $expectedUser && $pass === $expectedPass) {
    $studentNo = explode('@', $expectedUser)[0];
    // 5) Giriş başarılıysa hoşgeldin mesajı göster
    echo "<!DOCTYPE html>
<html lang='tr'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Hoşgeldiniz</title>
  <link rel='stylesheet' href='style.css'>
</head>
<body>
  <div class='login-container' style='max-width:380px; margin:70px auto; text-align:center;'>
    <h2>Hoşgeldiniz, {$studentNo}!</h2>
    <p>Başarıyla giriş yaptınız.</p>
    <a href='index.html' class='btn' style='display:inline-block;margin-top:16px;'>Ana Sayfa</a>
  </div>
</body>
</html>";
} else {
    // 6) Hatalıysa login sayfasına geri gönder ve GET parametresiyle hata ekle
    header('Location: login.html?error=1');
    exit;
}
?>
