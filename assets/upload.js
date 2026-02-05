const overlay = document.getElementById('qrOverlay');
const showBtn = document.getElementById('showQR');
const closeBtn = document.getElementById('closeQR');
const qrCanvas = document.getElementById('qrCanvas');

let qrCreated = false;

showBtn.addEventListener('click', () => {
  overlay.classList.add('active');

  if (!qrCreated) {
    new QRCode(qrCanvas, {
      text: window.location.href,
      width: 300,
      height: 300,
      colorDark: "#ffffff",
      colorLight: "#000000",
      correctLevel: QRCode.CorrectLevel.H
    });
    qrCreated = true;
  }
});

closeBtn.addEventListener('click', () => {
  overlay.classList.remove('active');
});

// Optional: click outside QR to close
overlay.addEventListener('click', (e) => {
  if (e.target === overlay) {
    overlay.classList.remove('active');
  }
});
