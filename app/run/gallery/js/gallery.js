function openIOSViewer(src) {
    const viewer = document.getElementById('iosViewer');
    const img = document.getElementById('viewerImg');
    img.src = src;
    viewer.style.display = 'flex';
}

function closeIOSViewer() {
    document.getElementById('iosViewer').style.display = 'none';
}

// Silme fonksiyonunu senin delete.php'ye bağladık kanki
document.getElementById('deleteBtn').onclick = function() {
    const imgSrc = document.getElementById('viewerImg').src;
    if(confirm('Bu fotoğraf silinecek, emin misin kanki?')) {
        // Buraya senin mevcut silme fonksiyonun gelecek
    }
}
