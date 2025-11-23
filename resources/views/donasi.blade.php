@extends('layouts.main')

@section('title', 'Donasi - SatuHati')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/donasi.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@section('content')
    <section class="donasi-hero">
        <div class="donasi-hero-overlay"></div>
        <div class="donasi-hero-content">
            <h1 class="donasi-hero-title">Kebaikan Anda, Harapan Mereka</h1>
            <p class="donasi-hero-subtitle">Setiap donasi membawa perubahan nyata. Pilih salah satu program di bawah ini dan jadilah bagian dari solusi.</p>
        </div>
    </section>

    <div class="donasi-container">
        <h2 class="donasi-section-heading">Kategori Donasi</h2>
        <div class="donasi-cards">
          <div class="donasi-card" id="donation-1">
            <div class="donasi-card-image">
              <span class="donasi-card-badge">Kesehatan</span>
              <img src="{{ asset('image/gambar_anak7.jpg') }}" alt="Pendidikan">
            </div>
            <div class="donasi-card-body">
              <h3 class="donasi-card-title">Temani Perjuangan Mereka Hingga Sembuh: Donasi untuk Anak dengan Kanker.</h3>
              <p class="donasi-card-description">Di balik senyum manisnya, ia menyimpan semangat juang yang luar biasa. Setiap hari adalah pertempuran melawan penyakit kritis.</p>
              
              <div class="donasi-progress-container">
                <div class="donasi-progress-label">
                  <span>Progress Penggalangan Dana</span>
                  <span class="donasi-progress-percentage">37%</span>
                </div>
                <div class="donasi-progress-bar">
                  <div class="donasi-progress-fill" style="width: 37%"></div>
                </div>
              </div>
              
              <div class="donasi-card-statistics">
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Dana Terkumpul</div>
                  <div class="donasi-stat-value">Rp 32.000.000</div>
                </div>
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Jumlah Donatur</div>
                  <div class="donasi-stat-value">846 Donatur</div>
                </div>
              </div>
              <button class="donasi-card-cta-btn" onclick="openDonationModal('pendidikan')">Donasi Sekarang</button>
            </div>
          </div>

          <div class="donasi-card" id="donation-2">
            <div class="donasi-card-image">
              <span class="donasi-card-badge">Kesehatan</span>
              <img src="{{ asset('image/leukimia-anak.jpg') }}" alt="Kesehatan">
            </div>
            <div class="donasi-card-body">
              <h3 class="donasi-card-title">Leukemia Menguras Tenaganya, Dukungan Kita Mengisi Semangatnya.</h3>
              <p class="donasi-card-description">Di dalam aliran darahnya, ia bertarung dalam perang yang tak terlihat. Leukemia mungkin mencoba meredupkan cahayanya, tapi ia adalah pejuang.</p>
              
              <div class="donasi-progress-container">
                <div class="donasi-progress-label">
                  <span>Progress Penggalangan Dana</span>
                  <span class="donasi-progress-percentage">45%</span>
                </div>
                <div class="donasi-progress-bar">
                  <div class="donasi-progress-fill" style="width: 45%"></div>
                </div>
              </div>
              
              <div class="donasi-card-statistics">
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Dana Terkumpul</div>
                  <div class="donasi-stat-value">Rp 46.000.000</div>
                </div>
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Jumlah Donatur</div>
                  <div class="donasi-stat-value">601 Donatur</div>
                </div>
              </div>
              <button class="donasi-card-cta-btn" onclick="openDonationModal('kesehatan')">Donasi Sekarang</button>
            </div>
          </div>

          <div class="donasi-card" id="donation-3">
            <div class="donasi-card-image">
              <span class="donasi-card-badge">Kesehatan</span>
              <img src="{{ asset('image/gambar_anak9.jpg') }}" alt="Hidrosefalus">
            </div>
            <div class="donasi-card-body">
              <h3 class="donasi-card-title">Kepala Kecil Ini Menanggung Beban Berat: Bantu Ia Lawan Hidrosefalus.</h3>
              <p class="donasi-card-description">Tatapan mata polos ini menanggung beban yang tak terbayangkan. Kepala adik kecil kita ini terus membesar akibat hidrosefalus.</p>
              
              <div class="donasi-progress-container">
                <div class="donasi-progress-label">
                  <span>Progress Penggalangan Dana</span>
                  <span class="donasi-progress-percentage">75%</span>
                </div>
                <div class="donasi-progress-bar">
                  <div class="donasi-progress-fill" style="width: 75%"></div>
                </div>
              </div>
              
              <div class="donasi-card-statistics">
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Dana Terkumpul</div>
                  <div class="donasi-stat-value">Rp 75.000.000</div>
                </div>
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Jumlah Donatur</div>
                  <div class="donasi-stat-value">1,245 Donatur</div>
                </div>
              </div>
              <button class="donasi-card-cta-btn" onclick="openDonationModal('kesehatan')">Donasi Sekarang</button>
            </div>
          </div>

          <div class="donasi-card" id="donation-4">
            <div class="donasi-card-image">
              <span class="donasi-card-badge">Kesehatan</span>
              <img src="{{ asset('image/gambar_anak6.webp') }}" alt="Tumor">
            </div>
            <div class="donasi-card-body">
              <h3 class="donasi-card-title">Bantu Adik Ini Sembuh: Tumor di Wajahnya Butuh Uluran Tangan Kita.</h3>
              <p class="donasi-card-description">Di balik tatapan matanya yang polos, adik kecil ini menahan beban yang luar biasa. Sebuah tumor yang terus membesar di wajahnya.</p>
              
              <div class="donasi-progress-container">
                <div class="donasi-progress-label">
                  <span>Progress Penggalangan Dana</span>
                  <span class="donasi-progress-percentage">75%</span>
                </div>
                <div class="donasi-progress-bar">
                  <div class="donasi-progress-fill" style="width: 75%"></div>
                </div>
              </div>
              
              <div class="donasi-card-statistics">
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Dana Terkumpul</div>
                  <div class="donasi-stat-value">Rp 75.000.000</div>
                </div>
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Jumlah Donatur</div>
                  <div class="donasi-stat-value">1,245 Donatur</div>
                </div>
              </div>
              <button class="donasi-card-cta-btn" onclick="openDonationModal('kesehatan')">Donasi Sekarang</button>
            </div>
          </div>

          <div class="donasi-card" id="donation-5">
            <div class="donasi-card-image">
              <span class="donasi-card-badge">Pendidikan</span>
              <img src="{{ asset('image/gambar_anak8.jpg') }}" alt="Pendidikan">
            </div>
            <div class="donasi-card-body">
              <h3 class="donasi-card-title">Semangat Tak Berdinding: Bantu Mereka Belajar di Ruang yang Layak.</h3>
              <p class="donasi-card-description">Lihatlah semangat yang terpancar dari mata mereka. Di dalam ruang kelas sederhana berdinding bambu ini, puluhan anak pedalaman menimba ilmu.</p>
              
              <div class="donasi-progress-container">
                <div class="donasi-progress-label">
                  <span>Progress Penggalangan Dana</span>
                  <span class="donasi-progress-percentage">20%</span>
                </div>
                <div class="donasi-progress-bar">
                  <div class="donasi-progress-fill" style="width: 20%"></div>
                </div>
              </div>
              
              <div class="donasi-card-statistics">
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Dana Terkumpul</div>
                  <div class="donasi-stat-value">Rp 3.123.000</div>
                </div>
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Jumlah Donatur</div>
                  <div class="donasi-stat-value">34 Donatur</div>
                </div>
              </div>
              <button class="donasi-card-cta-btn" onclick="openDonationModal('pendidikan')">Donasi Sekarang</button>
            </div>
          </div>

          <div class="donasi-card" id="donation-6">
            <div class="donasi-card-image">
              <span class="donasi-card-badge">Pangan</span>
              <img src="{{ asset('image/anak_kurang_gizi.jpg') }}" alt="Pangan">
            </div>
            <div class="donasi-card-body">
              <h3 class="donasi-card-title">Satu Donasi, Satu Nyawa: Lawan Krisis Gizi Buruk Sekarang.</h3>
              <p class="donasi-card-description">Ini bukan sekadar foto, ini adalah panggilan darurat. Gizi buruk merenggut masa kecil mereka. Jangan palingkan wajah Anda.</p>
              
              <div class="donasi-progress-container">
                <div class="donasi-progress-label">
                  <span>Progress Penggalangan Dana</span>
                  <span class="donasi-progress-percentage">90%</span>
                </div>
                <div class="donasi-progress-bar">
                  <div class="donasi-progress-fill" style="width: 90%"></div>
                </div>
              </div>
              
              <div class="donasi-card-statistics">
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Dana Terkumpul</div>
                  <div class="donasi-stat-value">Rp 90.000.000</div>
                </div>
                <div class="donasi-stat-item">
                  <div class="donasi-stat-label">Jumlah Donatur</div>
                  <div class="donasi-stat-value">2,156 Donatur</div>
                </div>
              </div>
              <button class="donasi-card-cta-btn" onclick="openDonationModal('pangan')">Donasi Sekarang</button>
            </div>
          </div>

        </div>
      </div>

    <div id="donationModal" class="donation-modal">
        <div class="donation-modal-overlay"></div>
        <div class="donation-modal-content">
            <button class="donation-modal-close" onclick="closeDonationModal()">&times;</button>
            <div class="donation-modal-body">
                <h2 class="donation-modal-title" id="donationModalTitle">Donasi untuk Pendidikan</h2>
                
                <form class="donation-form" id="donationForm" action="{{ url('/donasi/process') }}" method="POST">
                    @csrf 
                    <div class="form-group">
                        <label class="form-label">Pilih Nominal Donasi</label>
                        <div class="donation-amounts">
                            <label class="amount-option"><input type="radio" name="amount" value="50000" required><span class="amount-text">Rp 50.000</span></label>
                            <label class="amount-option"><input type="radio" name="amount" value="100000" required><span class="amount-text">Rp 100.000</span></label>
                            <label class="amount-option"><input type="radio" name="amount" value="250000" required><span class="amount-text">Rp 250.000</span></label>
                            <label class="amount-option"><input type="radio" name="amount" value="500000" required><span class="amount-text">Rp 500.000</span></label>
                            <label class="amount-option"><input type="radio" name="amount" value="1000000" required><span class="amount-text">Rp 1.000.000</span></label>
                            <label class="amount-option custom-amount"><input type="radio" name="amount" value="custom" required><span class="amount-text">Nominal Lainnya</span></label>
                        </div>
                        <div class="custom-amount-input" id="customAmountInput" style="display: none;">
                            <input type="number" name="customAmount" placeholder="Masukkan nominal donasi" min="10000">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Metode Pembayaran</label>
                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="bank_transfer" required>
                                <div class="payment-info"><i class="bi bi-building"></i><span class="payment-name">Bank Transfer</span></div>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="credit_card" required>
                                <div class="payment-info"><i class="bi bi-credit-card"></i><span class="payment-name">Credit Card</span></div>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="ewallet" required>
                                <div class="payment-info"><i class="bi bi-wallet2"></i><span class="payment-name">E-Wallet</span></div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="donorName">Nama Lengkap</label>
                        <input type="text" id="donorName" name="donorName" class="form-input" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="donorEmail">Email</label>
                        <input type="email" id="donorEmail" name="donorEmail" class="form-input" placeholder="Masukkan email" required>
                    </div>

                    <button type="submit" class="donation-submit-btn">Lanjutkan Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
@endsection