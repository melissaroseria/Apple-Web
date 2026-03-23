<?php
if (isset($_POST['api_url'])) {
    $api_url = $_POST['api_url'];
    
    // 10 haneli rastgele bir isim oluşturabiliriz veya kullanıcı adıyla kaydedebiliriz
    $file_name = uniqid() . ".txt"; // Rastgele bir 10 haneli dosya adı
    
    // Dosyayı logs/ klasörüne kaydediyoruz
    $file_path = "logs/" . $file_name;
    file_put_contents($file_path, $api_url);
    
    // API başarıyla kaydedildiği mesajı
    echo "API başarıyla kaydedildi. Dosya adı: " . $file_name;
}
?>
