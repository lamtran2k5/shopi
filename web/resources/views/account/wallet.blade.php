<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp tiền</title>
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
</head>
<body>
    <div class="edit-form-container">
        <h2>Wallet</h2>

        {{-- Thông báo thành công --}}
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        {{-- Thông báo lỗi --}}
        @if(session('error'))
            <p style="color:red;">{{ session('error') }}</p>
        @endif

        <form action="{{ route('account.wallet') }}" method="POST">
            @csrf

            {{-- Tài khoản hiện tại --}}
            <label>Số Tài khoản:</label>
            <input type="text" value="{{ $user->wallet_number }}" readonly>
            
            <label>Số dư:</label>
            <input type="text" value="{{ number_format($user->wallet->wallet_balance, 0, ',', '.') }} VNĐ" readonly>

            {{-- Chọn ngân hàng --}}
            <label>Ngân hàng:</label>
            <select name="bank_name" id="bank_name" required>
                <option value="">-- Chọn ngân hàng --</option>
                <option value="Vietcombank">Vietcombank</option>
                <option value="Techcombank">Techcombank</option>
                <option value="MB Bank">MB Bank</option>
                <option value="ACB">ACB</option>
                <option value="VPBank">VPBank</option>
            </select>

            {{-- Ảnh ngân hàng --}}
            <img id="bankImage" src="" style="display:none; margin-top:10px; max-width:300px;">

            {{-- Nhập số tiền --}}
            <label>Số tiền muốn nạp (VNĐ):</label>
            <input type="number" name="amount" min="1000" placeholder="Nhập số tiền..." required>

            <button tupe="submit">Xác nhận nạp tiền</button>
        </form>
    </div>
    <script>
    const bankSelect = document.getElementById('bank_name');
    const bankImage = document.getElementById('bankImage');

    const bank_name = {
        'Vietcombank': 'https://img.vietqr.io/image/VCB-113366668888-print.png',
        'Techcombank': 'https://img.vietqr.io/image/TCB-113366668888-print.png',
        'MB Bank': 'https://img.vietqr.io/image/MB-113366668888-print.png',
        'ACB': 'https://img.vietqr.io/image/ACB-113366668888-print.png',
        'VPBank': 'https://img.vietqr.io/image/VPB-113366668888-print.png'
    };

    bankSelect.addEventListener('change', function() {
        const selected = this.value;
        if (bank_name[selected]) {
            bankImage.src = bank_name[selected];
            bankImage.style.display = 'block';
        } else {
            bankImage.style.display = 'none';
        }
    });
</script>
</body>
</html>




