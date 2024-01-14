<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <style>
        /* Inline your CSS here if the email client supports it */
    </style>
</head>
<body style="font-family: Arial, sans-serif; color: #333333; background-color: #f4f4f4; padding: 20px; text-align: center;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h4 style="color: #4CAF50; font-size: 32px; text-align: left; padding-left: 40px; margin-bottom: 10px">Заявка за кола</h4>
        <p style="text-align: left; font-size: 20px; margin:0; padding-left: 40px;"><strong>Марка:</strong> {{ $car->brand }}</p>
        <p style="text-align: left; font-size: 20px; margin:0; padding-left: 40px;"><strong>Модел:</strong> {{ $car->model }}</p>
        <p style="text-align: left; font-size: 20px; margin:0; padding-left: 40px;"><strong>От:</strong> {{ $start_date }}</p>
        <p style="text-align: left; font-size: 20px; margin:0; padding-left: 40px;"><strong>До:</strong> {{ $end_date }}</p>
        <p style="text-align: left; font-size: 20px; margin:0; padding-left: 40px;"><strong>Клиент:</strong> {{ $name }}</p>
        <p style="text-align: left; font-size: 20px; margin:0; padding-left: 40px;"><strong>Телефон:</strong> <a href="tel:{{ $phone }}">{{ $phone }}</a> </p>
        <a href="{{ $confirmUrl }}" style="background-color: #4CAF50; font-size:18px; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 40px;">Потвърди</a>
    </div>
</body>
</html>
