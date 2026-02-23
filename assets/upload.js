document.addEventListener("DOMContentLoaded", () => {

    const showQRBtn = document.getElementById("showQR");
    const qrContainer = document.getElementById("qrCode");
    const uploadForm = document.getElementById("uploadForm");
    const fileInput = document.getElementById("images");
    const statusText = document.getElementById("status");

    // =========================
    // SHOW QR CODE
    // =========================
    if (!showQRBtn) {
        console.error("Show QR button (#showQR) not found");
        return;
    }

    if (!qrContainer) {
        console.error("QR container (#qrCode) not found");
        return;
    }

    showQRBtn.addEventListener("click", () => {
        qrContainer.innerHTML = "";

        if (typeof QRCode === "undefined") {
            console.error("QRCode library is NOT loaded");
            qrContainer.innerHTML = "<p style='color:red'>QR library missing</p>";
            qrContainer.style.display = "block";
            return;
        }

        const uploadUrl = window.location.origin + window.location.pathname;

        new QRCode(qrContainer, {
            text: uploadUrl,
            width: 220,
            height: 220,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        qrContainer.style.display = "block";
    });

    // =========================
    // HANDLE UPLOAD
    // =========================
    if (uploadForm && fileInput) {
        uploadForm.addEventListener("submit", (e) => {
            e.preventDefault();

            if (!fileInput.files.length) {
                statusText.textContent = "Please select at least one image.";
                return;
            }

            const formData = new FormData();

            for (let i = 0; i < fileInput.files.length; i++) {
                formData.append("images[]", fileInput.files[i]);
            }

            statusText.textContent = "Uploading...";

            fetch("upload-handler.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    statusText.textContent = "Thank you! Your images have been uploaded.";
                    uploadForm.reset();
                } else {
                    statusText.textContent = data.error || "Upload failed.";
                }
            })
            .catch(err => {
                console.error(err);
                statusText.textContent = "Upload error. Please try again.";
            });
        });
    }

});
