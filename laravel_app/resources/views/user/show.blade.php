<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }}さんのQRコード</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 50px;
        }
        .qr {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>{{ $user->name }}さんのQRコード</h1>

    <p>このQRコードを店舗でスキャンしてください。</p>

    <div class="qr">
        <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(url('/scan/' . $user->qr_uuid)) }}&size=200x200" alt="QRコード">
    </div>

    <p>リンク：<a href="{{ url('/scan/' . $user->qr_uuid) }}">{{ url('/scan/' . $user->qr_uuid) }}</a></p>

    <p><a href="{{ url('/') }}">← ホームへ戻る</a></p>
</body>
</html>