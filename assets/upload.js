document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("uploadForm");
    const status = document.getElementById("status");
    const qrBtn = document.getElementById("showQR");
    const qrBox = document.getElementById("qrCode");
    const qrWrap = document.getElementById("qrWrapper");

    /* =========================
       QR CODE
    ========================= */
    if (qrBtn && qrBox && qrWrap) {
        qrBtn.addEventListener("click", () => {
            qrBox.innerHTML = "";

            if (typeof QRCode === "undefined") {
                qrBox.textContent = "QR library missing";
                qrWrap.style.display = "flex";
                return;
            }

            new QRCode(qrBox, {
                text: "https://snapshow-swqb.onrender.com/upload.php",
                width: 220,
                height: 220
            });

            qrWrap.style.display = "flex";
        });
    }

    /* =========================
       AJAX UPLOAD (SAFE)
    ========================= */
    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();

            const data = new FormData(form);
            status.textContent = "Uploading...";

            fetch(form.action, {
                method: "POST",
                body: data
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    status.textContent = "Upload successful!";
                    form.reset();
                } else {
                    status.textContent = res.error || "Upload failed";
                }
            })
            .catch(() => {
                status.textContent = "Upload error";
            });
        });
    }

});
