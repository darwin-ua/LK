document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('invoiceOpenBtn');
    const closeBtn = document.getElementById('invoiceCloseBtn');
    const overlay = document.getElementById('invoiceOverlay');
    const popup = document.getElementById('invoicePopup');

    if (openBtn && overlay && popup) {
        openBtn.addEventListener('click', () => {
            overlay.classList.add('active');
            popup.classList.add('active');
        });
    }

    function closeInvoice() {
        overlay.classList.remove('active');
        popup.classList.remove('active');
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', closeInvoice);
    }

    if (overlay) {
        overlay.addEventListener('click', closeInvoice);
    }
});
