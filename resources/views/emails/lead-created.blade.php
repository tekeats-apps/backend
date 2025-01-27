<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tekeats - Your Request Received</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f7f7f7;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
            background-color: white;
        }

        .logo {
            max-width: 250px;
            height: auto;
        }

        .header-gradient {
            background: linear-gradient(90deg, #F4831F -0.01%, #EC2024 99.94%);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .header-gradient h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .content {
            padding: 20px;
        }

        .details {
            display: flex;
            flex-direction: column;
            gap: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 5px solid;
            border-image: linear-gradient(90deg, #F4831F, #EC2024) 1;
        }

        .details-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .details-item:last-child {
            border-bottom: none;
        }

        .details-label {
            font-weight: 600;
            color: #2c3e50;
            flex: 1;
        }

        .details-value {
            color: #555;
            word-wrap: break-word;
            text-align: left;
            flex: 2;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(90deg, #F4831F -0.01%, #EC2024 99.94%);
            color: white !important;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 6px;
            margin-top: 20px;
            text-align: center;
            width: auto;
            font-weight: 600;
        }

        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #7f8c8d;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                width: 95%;
            }

            .details-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .details-label {
                margin-bottom: 5px;
            }

            .logo {
                max-width: 200px;
            }

            .header-gradient h1 {
                font-size: 18px;
            }

            .cta-button {
                padding: 10px 20px;
                font-size: 14px;
            }

            .content {
                padding: 15px;
            }

            .details {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo-container">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/logo.png'))) }}" alt="Tekeats" style="max-width: 220px; height: 85px;" />
        </div>

        <div class="header-gradient">
            <h1>Your Request has been Received!</h1>
        </div>

        <div class="content">
            <p class="greeting">Hello {{ $lead->full_name }},</p>

            <p>Thank you for your interest in Tekeats! We've received your request to get started.</p>

            <p>Our team is currently reviewing your details and will contact you within the next 24 hours.</p>

            <div class="details">
                <div class="details-item">
                    <div class="details-label">Restaurant Name:</div>
                    <div class="details-value">{{ $lead->restaurant_name }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Email:</div>
                    <div class="details-value">{{ $lead->email }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Phone Number:</div>
                    <div class="details-value">{{ $lead->phone }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Business Size:</div>
                    <div class="details-value">{{ $lead->business_size }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Experience Level:</div>
                    <div class="details-value">{{ $lead->experience_level }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Goals:</div>
                    <div class="details-value">{{ implode(', ', $lead->system_goals) }}</div>
                </div>
            </div>

            <p>If you have any urgent questions, feel free to reach out to our support team.</p>

            <a href="mailto:support@tekeats.com" class="cta-button">Contact Support</a>

            <p>We look forward to helping you streamline your business operations!</p>

            <p>Best regards,<br>The Tekeats Team</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tekeats. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
