document.addEventListener("DOMContentLoaded", () => {

    const showQRBtn = document.getElementById("showQR");
    const qrWrapper = document.getElementById("qrWrapper");
    const qrContainer = document.getElementById("qrCode");
    const uploadForm = document.getElementById("uploadForm");
    const statusText = document.getElementById("status");

    let qrVisible = false;

    /* =========================
       QR TOGGLE
    ========================= */
    if (showQRBtn && qrWrapper && qrContainer) {
        showQRBtn.addEventListener("click", () => {

            // HIDE QR
            if (qrVisible) {
                qrWrapper.style.display = "none";
                showQRBtn.textContent = "Show QR Code";
                qrVisible = false;
                return;
            }

            // SHOW QR
            qrContainer.innerHTML = "";

            if (typeof QRCode === "undefined") {
                qrContainer.textContent = "QR library missing";
                qrWrapper.style.display = "flex";
                showQRBtn.textContent = "Hide QR Code";
                qrVisible = true;
                return;
            }

            new QRCode(qrContainer, {
                text: "https://snapshow-swqb.onrender.com/upload.php",
                width: 220,
                height: 220,
                correctLevel: QRCode.CorrectLevel.H
            });

            qrWrapper.style.display = "flex";
            showQRBtn.textContent = "Hide QR Code";
            qrVisible = true;
        });
    }

    /* =========================
       UPLOAD (AJAX SAFE)
    ========================= */
    if (uploadForm) {
        uploadForm.addEventListener("submit", (e) => {
            e.preventDefault();

            const formData = new FormData(uploadForm);
            statusText.textContent = "Uploading...";

            fetch(uploadForm.action, {
                method: "POST",
                body: formData
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    statusText.textContent = "Upload successful!";
                    uploadForm.reset();
                } else {
                    statusText.textContent = res.error || "Upload failed.";
                }
            })
            .catch(() => {
                statusText.textContent = "Upload error. Please try again.";
            });
        });
    }

});
