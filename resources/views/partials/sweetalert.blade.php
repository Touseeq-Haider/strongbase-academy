<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const swalDark = {
        background: '#0F1420',
        color: '#EDEEF3',
        confirmButtonColor: '#7C6CF6',
        cancelButtonColor: 'rgba(255,255,255,.08)',
    };

    // Auto-show a toast for any Laravel session flash message
    @if (session('success'))
        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            ...swalDark,
        }).fire({ icon: 'success', title: @json(session('success')) });
    @endif

    @if ($errors->any())
        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
            ...swalDark,
        }).fire({ icon: 'error', title: @json($errors->first()) });
    @endif

    // Reusable delete-confirmation helper.
    // Usage: <form onsubmit="return confirmDelete(event, 'this student')">
    function confirmDelete(event, itemLabel = 'this item') {
        event.preventDefault();
        const form = event.target;
        Swal.fire({
            title: 'Are you sure?',
            text: `This will permanently delete ${itemLabel}. This action cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            ...swalDark,
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
        return false;
    }
</script>
