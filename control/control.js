function selectedFiles() {
  return Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
    .map(cb => cb.value);
}

function selectAll() {
  document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = true);
}

function clearSelection() {
  document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
}

function deleteSelected() {
  const files = selectedFiles();
  if (!files.length) return alert('No images selected');
  if (!confirm('Delete selected images? This cannot be undone.')) return;

  fetch('actions.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
      action: 'delete',
      'files[]': files
    })
  }).then(() => location.reload());
}

function downloadSelected() {
  const files = selectedFiles();
  if (!files.length) return alert('No images selected');

  const form = document.createElement('form');
  form.method = 'POST';
  form.action = 'actions.php';

  form.innerHTML = `
    <input type="hidden" name="action" value="download">
    ${files.map(f => `<input type="hidden" name="files[]" value="${f}">`).join('')}
  `;

  document.body.appendChild(form);
  form.submit();
  form.remove();
}
