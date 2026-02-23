document.addEventListener("DOMContentLoaded", () => {
    const showQRBtn = document.getElementById("showQR");
    const qrContainer = document.getElementById("qrContainer");
    const uploadForm = document.getElementById("uploadForm");
    const fileInput = document.getElementById("images");
    const statusBox = document.getElementById("status");

    // Generate QR code when button is clicked
    if (showQRBtn) {
        showQRBtn.addEventListener("click", () => {
            qrContainer.innerHTML = "";

            const uploadURL = window.location.href;

            new QRCode(qrContainer, {
                text: uploadURL,
                width: 220,
                height: 220,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            qrContainer.style.display = "block";
        });
    }

    // Handle image upload
    if (uploadForm) {
        uploadForm.addEventListener("submit", (e) => {
            e.preventDefault();

            if (!fileInput.files.length) {
                statusBox.textContent = "Please select at least one image.";
                statusBox.style.color = "red";
                return;
            }

            const formData = new FormData();

            for (let i = 0; i < fileInput.files.length; i++) {
                formData.append("images[]", fileInput.files[i]);
            }

            statusBox.textContent = "Uploading...";
            statusBox.style.color = "#555";

            fetch("upload-handler.php", {
                method: "POST",
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        statusBox.textContent = "Upload successful! Thank you.";
                        statusBox.style.color = "green";
                        uploadForm.reset();
                    } else {
                        statusBox.textContent = data.error || "Upload failed.";
                        statusBox.style.color = "red";
                    }
                })
                .catch(() => {
                    statusBox.textContent = "Network error. Please try again.";
                    statusBox.style.color = "red";
                });
        });
    }
});
