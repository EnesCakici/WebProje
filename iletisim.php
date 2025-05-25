<?php
// 1) Karakter seti
header('Content-Type: text/html; charset=UTF-8');

// 2) Formdan gelen veriler
$fullName  = $_POST['fullName']  ?? '';
$email     = $_POST['email']     ?? '';
$phone     = $_POST['phone']     ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$subject   = $_POST['subject']   ?? '';
$gender    = $_POST['gender']    ?? '';
$message   = $_POST['message']   ?? '';
$interests = $_POST['interests'] ?? [];

// 3) XSS koruması
function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// 4) FormSubmit’e cURL ile yeniden POST at (mail’i tetiklemesi için)
$postData = [
  'fullName'  => $fullName,
  'email'     => $email,
  'phone'     => $phone,
  'birthdate' => $birthdate,
  'subject'   => $subject,
  'gender'    => $gender,
  'message'   => $message,
  // checkbox’ları array olarak değil virgülle ayrılmış string olarak yollayalım
  'interests' => implode(', ', $interests),
  '_captcha'  => 'false',
];
// Formsubmit adresi
$ch = curl_init('https://formsubmit.co/enescakici65@gmail.com');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);
curl_close($ch);

// 5) Son olarak kullanıcıya kendi sayfanızda verileri gösterin
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Teşekkürler – Enes Çakıcı</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .result-box {max-width:700px;margin:3rem auto;background:#fff;padding:2rem;border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,0.05);}
    .result-box h2 {text-align:center;color:var(--ana-yazi-rengi);margin-bottom:1.5rem;}
    .result-box p, .result-box ul {margin:1rem 0;color:#333;}
    .result-box ul {list-style:disc inside;}
    .back-btn {display:inline-block;margin-top:2rem;padding:10px 20px;background:var(--vurgu-rengi);color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;}
    .back-btn:hover {background:#c9a20c;}
  </style>
</head>
<body>
  <div class="result-box">
    <h2>Mesajınız Alındı</h2>
    <p><strong>Ad – Soyad:</strong> <?=e($fullName)?></p>
    <p><strong>E-posta:</strong> <?=e($email)?></p>
    <p><strong>Telefon:</strong> <?=e($phone)?></p>
    <p><strong>Doğum Tarihi:</strong> <?=e($birthdate)?></p>
    <p><strong>Konu:</strong> <?=e($subject)?></p>
    <p><strong>Cinsiyet:</strong> <?=e($gender)?></p>
    <p><strong>İlgi Alanları:</strong> <?= $interests ? e(implode(', ',$interests)) : '<em>Seçilmedi</em>' ?></p>
    <p><strong>Mesajınız:</strong><br><div style="padding:.5rem;background:#f9f9f9;border-radius:4px;"><?=nl2br(e($message))?></div></p>
    <a href="iletisim.html" class="back-btn">← Geri Dön</a>
  </div>
</body>
</html>
