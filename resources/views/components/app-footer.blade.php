<style>
    /* === PENTING: TAMBAHKAN INI KE STRUKTUR UTAMA === */
    /* Ini kuncinya biar footer turun ke bawah kalau konten dikit */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Tinggi minimal seukuran layar */
        margin: 0;
    }

    /* Ini class untuk konten utamamu (di atas footer) */
    /* Pastikan div kontenmu dikasih class ini atau sifat ini */
    .main-content {
        flex: 1; /* Ini yang akan "mendorong" footer ke bawah */
    }

    /* === TECH GEOMETRIC FOOTER (STICKY / RELATIVE) === */
   .tech-footer {
        background-color: transparent;
        /* margin-top: auto; <--- Hapus atau biarkan, tapi lebih baik diatur flex parent */
        font-family: 'Poppins', sans-serif;
        padding-bottom: 20px;
        width: 100%;
        position: relative;
        z-index: 10;
    }

    /* --- HEADER BAR STYLE --- */
    .tech-bar-container {
        display: flex;
        height: 60px;
        margin-bottom: 10px;
        position: relative;
        filter: drop-shadow(0 4px 2px rgba(0,0,0,0.1));
    }

    /* 1. Kotak Logo Hitam (Kiri) */
    .tech-logo-box {
        background-color: #004269;
        color: white;
        padding: 0 30px; /* Saya kurangi dikit biar ga kepanjangan */
        display: flex;
        align-items: center;
        font-weight: 800;
        font-size: 1.1rem;
        position: relative;
        z-index: 2;
    }
    .tech-logo-box::after {
        content: '';
        position: absolute;
        top: 0; right: -15px;
        width: 30px; height: 100%;
        background-color: #004269;
        transform: skewX(-30deg);
        z-index: -1;
    }

    .tech-connector {
        width: 15px;
        height: 100%;
        background-color: #0e7490;
        transform: skewX(-30deg);
        margin-left: 5px;
        position: relative;
        z-index: 1;
    }

    .tech-main-bar {
        flex: 1;
        position: relative;
        display: flex;
        align-items: center;
        padding-left: 30px;
        background: white;
        font-size: 0.85rem; /* Font diperkecil sedikit agar rapi */
        font-weight: 600;
        color: #333;
    }
    
    .tech-main-bar::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0;
        height: 4px; background-color: #009da5;
    }
    
    .tech-main-bar::after {
        content: ''; position: absolute; bottom: 0; left: -10px; right: 15%;
        height: 8px; background-color: #009da5; z-index: 0;
    }

    /* 4. Dekorasi Kanan */
    .tech-right-decor {
        position: absolute; bottom: 0; right: 0;
        width: 15%; height: 100%; overflow: visible;
    }
    
    .tech-end-block {
        position: absolute; bottom: 0; right: 0;
        width: 100%; height: 20px;
        background-color: #009da5;
        clip-path: polygon(15% 0%, 100% 0, 100% 100%, 0% 100%);
    }

    .tech-elbow {
        position: absolute; bottom: 8px; left: 0;
        width: 30px; height: 15px;
        background-color: #009da5;
        clip-path: polygon(0 100%, 100% 100%, 70% 0, 30% 0);
    }

    .tech-dashed {
        position: absolute; bottom: 0; left: -120px;
        width: 100px; height: 4px;
        background-image: linear-gradient(to right, #009da5 60%, transparent 40%);
        background-size: 10px 100%;
        transform: skewX(-30deg);
    }

    /* Mobile Responsive */
    @media (max-width: 640px) {
        .tech-bar-container { height: auto; flex-direction: column; }
        .tech-logo-box { width: 100%; justify-content: center; padding: 10px; }
        .tech-logo-box::after, .tech-connector, .tech-right-decor, .tech-main-bar::after, .tech-main-bar::before { display: none; }
        .tech-main-bar { width: 100%; justify-content: center; padding: 15px; border-bottom: 5px solid #009da5; text-align: center; }
    }
</style>

<footer class="tech-footer">
        <div class="max-w-7xl mx-auto pt-10 px-4">
            
            <div class="tech-bar-container">
                
                <div class="tech-logo-box">
                    E-STUDENT
                </div>
                
                <div class="tech-connector"></div>

                <div class="tech-main-bar">
                    <span class="uppercase tracking-wide text-blue-700">
                        &copy; {{ date('Y') }} E-STUDENT <b>|</b> Created By ASE-10 <b>|</b> v1.0 <b>|</b> Rev.04
                    </span>
                </div>

                <div class="tech-right-decor">
                    <div class="tech-dashed"></div>
                    <div class="tech-elbow"></div>
                    <div class="tech-end-block"></div>
                </div>

            </div>

        </div>
    </footer>