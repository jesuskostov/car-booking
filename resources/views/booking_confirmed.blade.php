<!DOCTYPE html>
<html>
<head>
    <title>Потвърдено</title>
</head>
<body>
    <h1 style="color: green;">{{ $booking->car->brand }} {{ $booking->car->model }} е успешно запазена за периода от {{ $booking->start_date }} до {{ $booking->end_date }}</h1>
</body>
</html>
