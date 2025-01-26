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
        }

        .email-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            padding: 15px;
        }

        .header-gradient h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .content {
            padding: 20px;
        }

        .details {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }

        .details-item {
            display: flex;
            margin-bottom: 10px;
        }

        .details-label {
            font-weight: 600;
            color: #2c3e50;
            min-width: 120px;
            margin-right: 10px;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(90deg, #F4831F -0.01%, #EC2024 99.94%);
            color: white !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            margin-top: 15px;
            text-align: center;
            width: auto;
            font-weight: 600;
        }

        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #7f8c8d;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                width: 95%;
            }

            .details-item {
                flex-direction: column;
            }

            .details-label {
                margin-bottom: 5px;
            }

            .logo {
                max-width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo-container">
            <img class="logo" src="{{ asset('assets/logo.png') }}" alt="Tekeats Logo" />
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
                    <div class="details-label">Restaurant Name</div>
                    <div class="details-value">{{ $lead->restaurant_name }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Email</div>
                    <div class="details-value">{{ $lead->email }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Phone Number</div>
                    <div class="details-value">{{ $lead->phone }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Business Size</div>
                    <div class="details-value">{{ $lead->business_size }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Experience Level</div>
                    <div class="details-value">{{ $lead->experience_level }}</div>
                </div>
                <div class="details-item">
                    <div class="details-label">Goals</div>
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
