<!-- Floating WhatsApp Button (melayang di pojok kanan bawah) -->
<a href="https://wa.me/6281234567890?text=Halo%20admin,%20saya%20membutuhkan%20bantuan%20terkait%20login"
   class="whatsapp-float"
   target="_blank"
   id="whatsappButton"
   title="Hubungi Admin">
    <i class="fab fa-whatsapp"></i>
</a>

<div class="whatsapp-tooltip" id="whatsappTooltip">
    Butuh Bantuan?
</div>

<style>
/* Tombol melayang */
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 25px;
    right: 25px;
    background-color: #25D366;
    color: #fff;
    border-radius: 50%;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
    z-index: 3000;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: transform 0.3s ease, background-color 0.3s ease;
    animation: pulse 2s infinite;
}

.whatsapp-float:hover {
    background-color: #1ebe57;
    transform: scale(1.1);
}

/* Tooltip */
.whatsapp-tooltip {
    position: fixed;
    bottom: 90px;
    right: 25px;
    background-color: #333;
    color: #fff;
    padding: 7px 12px;
    border-radius: 6px;
    font-size: 14px;
    white-space: nowrap;
    opacity: 0;
    transform: translateY(5px);
    transition: all 0.3s ease;
    z-index: 3001;
}

/* Tooltip muncul saat hover */
.whatsapp-float:hover + .whatsapp-tooltip {
    opacity: 1;
    transform: translateY(0);
}

/* Efek animasi denyut */
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6); }
    70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
    100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
}
</style>

<script>
    // Konfigurasi WhatsApp
    const whatsappConfig = {
        phoneNumber: '6281234567890', // Nomor WhatsApp admin
        defaultMessage: 'Halo admin, saya membutuhkan bantuan terkait login',
        businessHours: {
            start: 8, // Jam 8 pagi
            end: 17   // Jam 5 sore
        }
    };

    // Fungsi format pesan
    function formatMessage(message) {
        return encodeURIComponent(message);
    }

    // Cek jam operasional
    function isBusinessHours() {
        const now = new Date();
        const currentHour = now.getHours();
        return currentHour >= whatsappConfig.businessHours.start &&
               currentHour < whatsappConfig.businessHours.end;
    }

    // Update link & tooltip
    function updateWhatsAppLink() {
        const whatsappButton = document.getElementById('whatsappButton');
        const tooltip = document.getElementById('whatsappTooltip');

        let message = whatsappConfig.defaultMessage;
        let tooltipText = 'Butuh Bantuan?';

        if (!isBusinessHours()) {
            message = 'Halo admin, saya membutuhkan bantuan. Mohon balas ketika sudah online.';
            tooltipText = 'Admin mungkin offline';
        }

        const whatsappUrl = `https://wa.me/${whatsappConfig.phoneNumber}?text=${formatMessage(message)}`;
        whatsappButton.href = whatsappUrl;
        tooltip.textContent = tooltipText;
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateWhatsAppLink();
        setInterval(updateWhatsAppLink, 60000);
    });

    // Optional: tracking klik
    document.getElementById('whatsappButton').addEventListener('click', function() {
        console.log('WhatsApp button clicked - Help requested');
    });
</script>
