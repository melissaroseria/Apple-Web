<div align="center">

<img src="755/mn.png" width="320" alt="Apple-Web Logo" />

# 🍎 Apple-Web — iOS on Web Servers

**Web sunucularında gerçek bir iOS deneyimi.**
PHP ile çalışan, mobil uyumlu, açık kaynak bir iOS simülasyon projesi.

[![License: MIT](https://img.shields.io/badge/License-MIT-white?style=flat-square&logo=opensourceinitiative)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Version](https://img.shields.io/badge/Version-V5%20DELUXE-blue?style=flat-square&logo=apple&logoColor=white)]()
[![Stars](https://img.shields.io/github/stars/melissaroseria/Ios-Web?style=flat-square&color=yellow)]()

</div>

---

## ✨ Nedir?

**Apple-Web**, web sunucularında iOS işletim sistemi deneyimi sunan açık kaynaklı bir PHP projesidir. Lock screen'den Safari'ye, Ayarlar menüsünden proxy yönetimine kadar tıpa tıp iOS arayüzü ile tasarlanmıştır.

iOS seven ama sunucudan vazgeçemeyen herkes için. 🫠

---

## 📸 Özellikler

<div align="center">

<img src="755/1.png" width="80" />

</div>

### 🔐 Lock Screen & PIN Sistemi
- Gerçek iOS kilit ekranı — saat, tarih, bildirim kartı
- 4 haneli PIN ekranı (iOS tuş takımı)
- Yukarı kaydırma (swipe up) hareketi ile PIN açma
- Yanlış şifrede sarsılma animasyonu ve titreşim
- Sunucu taraflı şifre doğrulama (`src/pass.txt`)

---

<div align="center">

<img src="755/2.png" width="80" />

</div>

### ⚙️ iOS Ayarlar Paneli
- **Profil kartı** — fotoğraf, isim, iCloud açıklaması
- **Arama kutusu** — anlık filtreleme
- **Disk Yönetimi** — önbellek görüntüleme ve temizleme
- **Yedekleme** — notlar, galeri, dosyalar ZIP olarak indir
- **Güvenlik** — şifre değiştirme, güç göstergesi
- **Ekran & Parlaklık** — duvar kağıdı ve profil fotoğrafı değiştirme
- **Log Kayıtları** — IP tabanlı erişim geçmişi

---

<div align="center">

<img src="755/3.png" width="80" />

</div>

### 🌐 Safari Tarayıcı
- Birebir iOS Safari arayüzü (alt adres çubuğu, nav ikonlar)
- Favoriler ızgarası, Gizlilik Raporu kartı, Okuma Listesi
- **Proxy Sistemi** — tek tıkla ücretsiz proxy bağlantısı
  - Otomatik proxy seçimi (ProxyScrape API)
  - Bağlanan proxy'nin IP, ülke ve protokolü gösterilir
  - Yeşil/kırmızı bağlantı göstergesi
- Arama motoru seçimi: Google, Bing, DuckDuckGo, Ecosia
- Gizli gezinme, çerez ve reklam engelleme toggleları

---

## 🚀 Kurulum

```bash
# 1. Repoyu klonla
git clone https://github.com/melissaroseria/Ios-Web.git

# 2. Web sunucuna yükle (Apache / Nginx / LocalXampp)
cp -r Ios-Web/ /var/www/html/

# 3. Şifre dosyasını oluştur
echo "1234" > src/pass.txt

# 4. index.php'yi aç — hazır!
```

> **Gereksinimler:** PHP 7.4+, Apache/Nginx, `mod_rewrite` aktif

---

## 📁 Proje Yapısı

```
Ios-Web/
├── index.php          # 🔐 Lock Screen & PIN
├── src/
│   ├── pass.txt       # Şifre (boş bırak, gizli tut)
│   └── get_password.php
├── app/
│   └── main.php       # Ana uygulama
├── browser/
│   └── index.php      # 🌐 Safari tarayıcı
├── charts/            # ⚙️ Ayarlar modülleri
│   ├── cache/         # Disk yönetimi
│   ├── backup/        # Yedekleme
│   ├── sec/           # Güvenlik & şifre
│   ├── screen/        # Ekran & parlaklık
│   ├── logs/          # Log kayıtları
│   └── support/       # FAQ & hakkında
└── css/               # Stil dosyaları
```

---

## 🛠️ Teknolojiler

| | Teknoloji |
|---|---|
| 🐘 | PHP 7.4+ |
| 🎨 | Vanilla CSS (iOS Design System) |
| ⚡ | Vanilla JavaScript |
| 🔣 | Font Awesome 6 |
| 🌐 | ProxyScrape API |

---

## 🤝 Katkı

Açık kaynak — fork'la, geliştir, gönder!

```bash
git checkout -b yeni-ozellik
git commit -m "✨ yeni özellik eklendi"
git push origin yeni-ozellik
```

Pull Request açmaktan çekinme. ❤️

---

## 📬 İletişim & Destek

<div align="center">

[![Telegram Destek](https://img.shields.io/badge/Telegram-Destek-0088cc?style=for-the-badge&logo=telegram)](https://t.me/+447599608079)
[![Telegram Kanal](https://img.shields.io/badge/Telegram-ViosTeam-0088cc?style=for-the-badge&logo=telegram)](https://t.me/ViosTeam)
[![GitHub](https://img.shields.io/badge/GitHub-zeedslowy-181717?style=for-the-badge&logo=github)](https://github.com/zeedslowy)

</div>

---

<div align="center">

MIT License — © 2025 melissaroseria

*Made with ❤️ for iOS lovers*

</div>
