document.querySelectorAll(".delete-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        if (!confirm("Delete this image?")) return;

        fetch("../delete.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "file=" + encodeURIComponent(btn.dataset.file)
        })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                btn.closest(".item").remove();
            } else {
                alert(res.error || "Delete failed");
            }
        });
    });
});
