<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
        }
        h1 {
            color: #5a2a83;
            font-size: 28px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }
        ul {
            text-align: left;
            list-style: none;
            padding-left: 0;
            margin-top: 20px;
        }
        li {
            font-size: 15px;
            padding: 6px 0;
        }
        .button {
            margin-top: 30px;
            display: inline-block;
            background-color: #5a2a83;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }
        .button:hover {
            background-color: #472060;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
        .footer a {
            color: #5a2a83;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Hello, {{ $userName}}</h1>

    <p>Thank you for your order of <strong>Soulmate Sketch</strong>!</p>

    <p>Your personalized Soul Sketch and the detailed description is ready. Click on the link below</p>

    {{-- <a href="https://reading.soulmatesketch.com/public/{{ $sketch->image_path }}">Soumate Sketch Image</a>
    <a href="https://reading.soulmatesketch.com/pdf/{{ $sketch->report_id }}">Soumate Sketch Pdf</a> --}}


    <div class="footer">
        <p>If you have any questions, email us at <a href="mailto:support@soulsketchnumerology.com">support@soulsketchnumerology.com</a></p>
    </div>
</div>

</body>
</html>
