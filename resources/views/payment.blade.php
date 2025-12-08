<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Donasi - {{ $campaign->Judul }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, rgba(14, 165, 148, 0.1) 0%, rgba(11, 127, 93, 0.1) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            overflow-y: auto;
            z-index: 1000;
        }

        .payment-modal {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            max-width: 550px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease-out;
            position: relative;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .payment-header {
            background: linear-gradient(135deg, #0ea594 0%, #0b7f5d 100%);
            padding: 24px 28px;
            position: sticky;
            top: 0;
            text-align: center;
            z-index: 10;
            flex-shrink: 0;
        }

        .payment-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            padding: 0;
            line-height: 1;
            flex-shrink: 0;
        }

        .payment-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .payment-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
            margin-bottom: 6px;
        }

        .payment-subtitle {
            font-size: 0.95rem;
            color: #D1FAE5;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            word-wrap: break-word;
        }

        .payment-body {
            padding: 28px 24px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-weight: 700;
            margin-bottom: 12px;
            color: #0F172A;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
        }

        /* Donation Amounts Grid */
        .donation-amounts {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .amount-option {
            cursor: pointer;
            position: relative;
        }

        .amount-option input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .amount-text {
            display: block;
            padding: 14px 10px;
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            text-align: center;
            font-size: 0.9rem;
            color: #64748B;
            transition: all 0.3s ease;
            font-weight: 600;
            background: #F8FAFC;
            font-family: 'Poppins', sans-serif;
            word-break: break-word;
        }

        .amount-option input:checked + .amount-text {
            background: linear-gradient(135deg, #0ea594 0%, #0b7f5d 100%);
            color: white;
            border-color: #0ea594;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(14, 165, 148, 0.3);
        }

        .amount-option:hover .amount-text {
            border-color: #0ea594;
            transform: translateY(-1px);
        }

        .custom-amount-input {
            margin-top: 12px;
        }

        .custom-amount-input input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
            box-sizing: border-box;
        }

        .custom-amount-input input:focus {
            border-color: #0ea594;
            box-shadow: 0 0 0 3px rgba(14, 165, 148, 0.1);
        }

        /* Payment Methods */
        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .payment-option {
            cursor: pointer;
            position: relative;
        }

        .payment-option input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .payment-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #F8FAFC;
            word-break: break-word;
        }

        .payment-info i {
            font-size: 1.3rem;
            color: #0ea594;
            width: 26px;
            text-align: center;
            flex-shrink: 0;
        }

        .payment-name {
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
        }

        .payment-option input:checked + .payment-info {
            background: linear-gradient(135deg, #0ea594 0%, #0b7f5d 100%);
            border-color: #0ea594;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(14, 165, 148, 0.3);
        }

        .payment-option input:checked + .payment-info .payment-name,
        .payment-option input:checked + .payment-info i {
            color: white;
        }

        .payment-option:hover .payment-info {
            border-color: #0ea594;
            transform: translateY(-1px);
        }

        /* Submit Button */
        .payment-submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #0ea594 0%, #0b7f5d 100%);
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 6px 20px rgba(14, 165, 148, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .payment-submit-btn:hover {
            background: linear-gradient(135deg, #0b7f5d 0%, #0ea594 100%);
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(14, 165, 148, 0.4);
        }

        .payment-submit-btn:active {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(14, 165, 148, 0.3);
        }

        /* Responsive - Tablet */
        @media (max-width: 768px) {
            .payment-header {
                padding: 20px 24px;
            }

            .payment-title {
                font-size: 1.25rem;
            }

            .payment-subtitle {
                font-size: 0.9rem;
            }

            .payment-body {
                padding: 24px 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                margin-bottom: 10px;
                font-size: 0.9rem;
            }

            .donation-amounts {
                gap: 8px;
            }

            .amount-text {
                padding: 12px 8px;
                font-size: 0.85rem;
            }

            .payment-info {
                padding: 12px 14px;
                gap: 10px;
            }

            .payment-info i {
                font-size: 1.2rem;
                width: 24px;
            }

            .payment-name {
                font-size: 0.9rem;
            }

            .payment-submit-btn {
                padding: 12px 18px;
                font-size: 0.9rem;
            }
        }

      
        @media (max-width: 480px) {
            .payment-overlay {
                padding: 12px;
            }

            .payment-modal {
                max-height: 95vh;
            }

            .payment-header {
                padding: 18px 20px;
            }

            .payment-close {
                width: 36px;
                height: 36px;
                font-size: 24px;
            }

            .payment-title {
                font-size: 1.1rem;
                margin-bottom: 4px;
            }

            .payment-subtitle {
                font-size: 0.85rem;
            }

            .payment-body {
                padding: 20px 16px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .form-label {
                margin-bottom: 10px;
                font-size: 0.85rem;
            }

            .donation-amounts {
                gap: 8px;
            }

            .amount-text {
                padding: 12px 6px;
                font-size: 0.8rem;
            }

            .custom-amount-input input {
                padding: 10px 12px;
                font-size: 0.85rem;
            }

            .payment-info {
                padding: 12px 12px;
                gap: 8px;
            }

            .payment-info i {
                font-size: 1.1rem;
                width: 22px;
            }

            .payment-name {
                font-size: 0.85rem;
            }

            .payment-submit-btn {
                padding: 12px 16px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>

    <div class="payment-overlay">
        <div class="payment-modal">
            <div class="payment-header">
                <h2 class="payment-title">Konfirmasi Donasi</h2>
                <p class="payment-subtitle">{{ $campaign->Judul }}</p>
                <a href="{{ route('donasi.index') }}" class="payment-close" title="Tutup">&times;</a>
            </div>
            
            <div class="payment-body">
                <form class="donation-form" id="donationForm" action="{{ route('transaction.store') }}" method="POST">
                    @csrf 
                    
                    <input type="hidden" name="campaign_id" value="{{ $campaign->CampaignID }}">
                    <input type="hidden" name="amount" id="finalAmount">

                    <div class="form-group">
                        <label class="form-label">Pilih Nominal Donasi</label>
                        <div class="donation-amounts">
                            <label class="amount-option"><input type="radio" name="temp_amount" value="50000" onclick="toggleCustom(false)"><span class="amount-text">Rp 50.000</span></label>
                            <label class="amount-option"><input type="radio" name="temp_amount" value="100000" onclick="toggleCustom(false)"><span class="amount-text">Rp 100.000</span></label>
                            <label class="amount-option"><input type="radio" name="temp_amount" value="250000" onclick="toggleCustom(false)"><span class="amount-text">Rp 250.000</span></label>
                            <label class="amount-option"><input type="radio" name="temp_amount" value="500000" onclick="toggleCustom(false)"><span class="amount-text">Rp 500.000</span></label>
                            <label class="amount-option"><input type="radio" name="temp_amount" value="1000000" onclick="toggleCustom(false)"><span class="amount-text">Rp 1.000.000</span></label>
                            <label class="amount-option"><input type="radio" name="temp_amount" value="custom" id="radioCustom" onclick="toggleCustom(true)"><span class="amount-text">Nominal Lainnya</span></label>
                        </div>
                        
                        <div class="custom-amount-input" id="customAmountInput" style="display: none;">
                            <input type="number" id="inputCustomReal" placeholder="Masukkan nominal (Min Rp 10.000)" min="10000">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Metode Pembayaran</label>
                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="bank_transfer" required checked>
                                <div class="payment-info"><i class="bi bi-building"></i><span class="payment-name">Bank Transfer</span></div>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="credit_card" required>
                                <div class="payment-info"><i class="bi bi-credit-card"></i><span class="payment-name">Kartu Kredit</span></div>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="ewallet" required>
                                <div class="payment-info"><i class="bi bi-wallet2"></i><span class="payment-name">E-Wallet</span></div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="payment-submit-btn">Bayar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleCustom(show) {
            const customBox = document.getElementById('customAmountInput');
            const customInput = document.getElementById('inputCustomReal');
            
            if (show) {
                customBox.style.display = 'block';
                customInput.focus();
            } else {
                customBox.style.display = 'none';
                customInput.value = '';
            }
        }

        document.getElementById('donationForm').addEventListener('submit', function(e) {
            const finalAmountInput = document.getElementById('finalAmount');
            const selectedRadio = document.querySelector('input[name="temp_amount"]:checked');
            const customInput = document.getElementById('inputCustomReal');

            if (!selectedRadio) {
                alert("Silakan pilih nominal donasi.");
                e.preventDefault();
                return;
            }

            let amountValue = 0;

            if (selectedRadio.value === 'custom') {
                amountValue = customInput.value;
                if (amountValue < 10000) {
                    alert("Minimal donasi nominal lainnya adalah Rp 10.000");
                    e.preventDefault();
                    return;
                }
            } else {
                amountValue = selectedRadio.value;
            }

            finalAmountInput.value = amountValue;
        });
    </script>

</body>
</html>