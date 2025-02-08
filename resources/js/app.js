import './bootstrap';
import mask from '@alpinejs/mask';

// Mask plugin'ini yükle ve durumu kontrol et
try {
    Alpine.plugin(mask);
    console.log('✅ @alpinejs/mask yüklendi');
} catch (error) {
    console.error('❌ @alpinejs/mask hatası:', error);
}


