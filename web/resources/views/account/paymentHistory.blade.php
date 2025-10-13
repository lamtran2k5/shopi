<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử giao dịch</title>
    <link rel="stylesheet" href="{{ asset('css/paymentHistory.css') }}">
</head>
<body>
    <div class="payment-wrapper">
        <h2 class="page-title">Payment History</h2>

        <table class="history-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Wallet Number</th>
                    <th>Amount (VNĐ)</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentHistory as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->wallet_number }}</td>
                    <td>{{ number_format($item->amount, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->transaction_date)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
