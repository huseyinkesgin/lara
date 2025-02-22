// SweetAlert2 Toast configuration
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

const showToast = ({ title, text, icon = 'success' }) => {
    Toast.fire({
        icon,
        title,
        text
    });
};

const showAlert = ({ title, text, icon = 'success' }) => {
    Swal.fire({
        icon,
        title,
        text
    });
};

const confirmDelete = (callback) => {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Bu işlemi geri alamazsınız!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, sil!',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.isConfirmed && callback) {
            callback();
        }
    });
};

export { showToast, showAlert, confirmDelete };
