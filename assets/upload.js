document.addEventListener("DOMContentLoaded", () => {

    const showQRBtn = document.getElementById("showQR");
    const qrContainer = document.getElementById("qrCode");
    const qrWrapper = document.getElementById("qrWrapper");
    const uploadForm = document.getElementById("uploadForm");
    const fileInput = document.getElementById("images");
    const statusText = document.getElementById("status");

    if (showQRBtn && qrContainer && qrWrapper) {
        showQRBtn.addEventListener("click", () => {
            qrContainer.innerHTML = "";

            if (typeof QRCode === "undefined") {
                qrContainer.innerHTML = "<p style='color:red'>QR library missing</p>";
                qrWrapper.style.display = "flex";
                return;
            }

            const uploadUrl = "https://snapshow-swqb.onrender.com/upload.php";

            new QRCode(qrContainer, {
                text: uploadUrl,
                width: 220,
                height: 220,
                correctLevel: QRCode.CorrectLevel.H
            });

            qrWrapper.style.display = "flex";
        });
    }

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
            .catch(() => {
                statusText.textContent = "Upload error. Please try again.";
            });
        });
    }

});
