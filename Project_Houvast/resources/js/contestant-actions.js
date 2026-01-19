// Handles AJAX toggling of 'present' status on the contestants list
// Progressive enhancement: falls back to normal form submit if fetch fails or is unavailable

document.addEventListener('submit', function (e) {
    const form = e.target;
    if (!form.classList.contains('toggle-present-form')) return;

    // Progressive enhancement: try to submit via fetch to avoid full page reload
    e.preventDefault();

    const url = form.action;
    const formData = new FormData(form);

    fetch(url, {
        method: form.method || 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
        body: formData,
        credentials: 'same-origin'
    })
    .then(resp => {
        if (!resp.ok) throw new Error('Network response was not ok');
        return resp.json();
    })
    .then(data => {
        // find the button inside the form and update its appearance
        const btn = form.querySelector('button[type="submit"]');
        if (!btn) return;

        const isPresent = !!data.is_present;
        btn.textContent = isPresent ? 'Present' : 'Not Present';

        if (isPresent) {
            btn.classList.remove('bg-red-100', 'text-red-700', 'hover:bg-red-200');
            btn.classList.add('bg-green-100', 'text-green-700', 'hover:bg-green-200');
        } else {
            btn.classList.remove('bg-green-100', 'text-green-700', 'hover:bg-green-200');
            btn.classList.add('bg-red-100', 'text-red-700', 'hover:bg-red-200');
        }
    })
    .catch(() => {
        // fallback: submit the form normally (will reload)
        form.removeEventListener('submit', arguments.callee);
        form.submit();
    });
});