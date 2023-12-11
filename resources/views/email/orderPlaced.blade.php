<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        h1 {
            color: #333333;
        }

        p {
            color: #555555;
        }

        .order-details {
            margin-top: 20px;
            border: 1px solid #dddddd;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>New Order Notification</h1>
        <p>Hello Admin,</p>
        <p>A new order has been placed on your website. Below are the details:</p>

        <div class="order-details">
            <p><strong>Order ID:</strong>#{{ $data['order_id'] }}</p>
            <p><strong>Customer Name:</strong> {{ $data['customer_name'] }}</p>
            <p><strong>Email:</strong> {{ $data['customer_email'] }}</p>
            <p><strong>Phone:</strong> {{ $data['customer_phone'] }}</p>
            <p><strong>Total Amount:</strong> £{{ $data['order_amount'] }}</p>
        </div>

        <p>Please review and process the order as soon as possible.</p>

        <p>Thank you for your attention.</p>
        <p>Best regards,<br>{{ env('APP_NAME') }}</p>
    </div>
</body>

</html>
