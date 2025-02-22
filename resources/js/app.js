import './bootstrap';
import mask from '@alpinejs/mask';
import Swal from 'sweetalert2';

// Make SweetAlert2 globally available
window.Swal = Swal;

// Mask plugin'ini yükle ve durumu kontrol et
try {
    Alpine.plugin(mask);
    console.log('✅ @alpinejs/mask yüklendi');
} catch (error) {
    console.error('❌ @alpinejs/mask hatası:', error);
}

// Toast notification configuration
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

// Make Toast globally available
window.Toast = Toast;

// Livewire event listener for SweetAlert2
document.addEventListener('livewire:initialized', () => {
    Livewire.on('swal', (data) => {
        const options = data[0];
        if (options.toast) {
            Toast.fire(options);
        } else {
            Swal.fire(options);
        }
    });
});
