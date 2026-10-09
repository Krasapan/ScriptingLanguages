<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Нова заявка на бета-тест!</h2>
<p>Отримано нову заявку з лендінгу Krasapan's Games.</p>

<ul>
    <li><strong>Ім'я:</strong> {{ $data['name'] }}</li>
    <li><strong>Email:</strong> {{ $data['email'] }}</li>
    <li><strong>Коментар:</strong> {{ $data['message'] ?? 'Не вказано' }}</li>
</ul>
</body>
</html>
