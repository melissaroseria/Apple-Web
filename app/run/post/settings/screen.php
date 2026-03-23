<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Kaydetme</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h1>API LOGS</h1>
    </div>

    <form action="process.php" method="POST">
        <div class="api-test-box">
            <h3>API URL Girin:</h3>
            <input type="text" name="api_url" placeholder="API URL" required>
            <button type="submit" class="test-btn">API'yi Kaydet</button>
        </div>
    </form>

    <!-- API Kaydedildikten Sonra Gösterilecek Alan -->
    <div class="api-results">
        <?php
        if (isset($_GET['file_name'])) {
            $file_name = htmlspecialchars($_GET['file_name']);
            $api_url = htmlspecialchars($_GET['api_url']); // API URL'si
            echo "
                <div class='api-result-box'>
                    <p class='file-name'>Dosya Adı: $file_name</p>
                    <a href='$api_url' target='_blank'>
                        <button class='result-btn'>Görüntüle</button>
                    </a>
                </div>
            ";
        }
        ?>
    </div>

    <!-- API Logları Listesi -->
    <div class="api-log-list">
        <?php
        $logDirectory = 'logs/';
        $logFiles = array_diff(scandir($logDirectory), array('..', '.'));

        foreach ($logFiles as $file) {
            $filePath = $logDirectory . $file;
            $apiUrl = file_get_contents($filePath);

            echo "<div class='log-entry'>
                    <p class='log-file-name'>$file</p>
                    <a href='$apiUrl' target='_blank'>
                        <button class='view-btn'>Görüntüle</button>
                    </a>
                </div>";
        }
        ?>
    </div>

</div>

</body>
</html>


<!-- Pop-Up (Modal) -->
<div class="popup-modal" id="popupModal">
    <div class="modal-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <iframe id="popupIframe" src="" frameborder="0"></iframe>
    </div>
</div>

<script>
    // Pop-up açma fonksiyonu
    function openPopup(apiUrl) {
        document.getElementById('popupIframe').src = apiUrl;
        document.getElementById('popupModal').style.display = 'flex';
    }

    // Pop-up kapama fonksiyonu
    function closePopup() {
        document.getElementById('popupModal').style.display = 'none';
        document.getElementById('popupIframe').src = ''; // iframe içeriğini temizle
    }
</script>

</body>
</html>