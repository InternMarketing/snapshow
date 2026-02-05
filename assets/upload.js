document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('qrOverlay');
  const showBtn = document.getElementById('showQR');
  const closeBtn = document.getElementById('closeQR');
  const qrBox = document.getElementById('qrCanvas');

  if (!overlay || !showBtn || !closeBtn || !qrBox) {
    console.error('❌ QR elements missing');
    return;
  }

  // Safety check: QRCode library loaded
  if (typeof QRCode === 'undefined') {
    console.error('❌ QRCode library not loaded');
    return;
  }

  let qrInstance = null;

  showBtn.addEventListener('click', () => {
    overlay.classList.add('active');

    // Generate QR only once
    if (!qrInstance) {
      qrBox.innerHTML = ''; // extra safety
      qrInstance = new QRCode(qrBox, {
        text: window.location.href,
        width: 300,
        height: 300,
        colorDark: '#ffffff',
        colorLight: '#000000',
        correctLevel: QRCode.CorrectLevel.H
      });
    }
  });

  closeBtn.addEventListener('click', () => {
    overlay.classList.remove('active');
  });

  // Click outside QR to close
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) {
      overlay.classList.remove('active');
    }
  });
});
