<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tekeats - Your Request Received</title>
    <style>
        /* Reset styles for email clients */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Base styles */
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f7f7f7;
            -webkit-font-smoothing: antialiased;
        }

        /* Container improvements */
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        /* Logo styling */
        .logo-container {
            padding: 24px 0;
            background-color: white;
            text-align: center;
        }

        .logo {
            max-width: 220px;
            height: 85px;
            display: inline-block;
        }

        /* Header improvements */
        .header-gradient {
            background: linear-gradient(90deg, #F4831F -0.01%, #EC2024 99.94%);
            color: white;
            text-align: center;
            padding: 28px 20px;
        }

        .header-gradient h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        /* Content area */
        .content {
            padding: 32px 24px;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        /* Improved details section */
        .details {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 24px;
            margin: 24px 0;
            border-left: 5px solid #F4831F;
        }

        .details-item {
            display: table;
            width: 100%;
            margin-bottom: 16px;
            background-color: white;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .details-item:last-child {
            margin-bottom: 0;
        }

        .details-label {
            display: table-cell;
            font-weight: 600;
            color: #2c3e50;
            width: 35%;
            padding-right: 16px;
        }

        .details-value {
            display: table-cell;
            color: #4a5568;
            width: 65%;
            word-break: break-word;
        }

        /* Enhanced CTA button */
        .cta-button {
            display: inline-block;
            background: linear-gradient(90deg, #F4831F -0.01%, #EC2024 99.94%);
            color: white !important;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 8px;
            margin: 24px 0;
            font-weight: 600;
            text-align: center;
            transition: transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(244, 131, 31, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 8px rgba(244, 131, 31, 0.25);
        }

        /* Footer improvements */
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }

        /* Mobile responsiveness improvements */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 95%;
                margin: 10px auto;
            }

            .content {
                padding: 24px 16px;
            }

            .details {
                padding: 16px;
            }

            .details-item {
                display: block;
                padding: 12px;
            }

            .details-label {
                display: block;
                width: 100%;
                margin-bottom: 8px;
                padding-right: 0;
            }

            .details-value {
                display: block;
                width: 100%;
            }

            .header-gradient h1 {
                font-size: 20px;
            }

            .greeting {
                font-size: 16px;
            }

            .cta-button {
                display: block;
                padding: 12px 24px;
                text-align: center;
                width: 100%;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .details {
                background-color: #1a1a1a;
            }

            .details-item {
                background-color: #262626;
            }

            .details-label {
                color: #e2e8f0;
            }

            .details-value {
                color: #cbd5e1;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo-container">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/logo.png'))) }}" alt="Tekeats" class="logo" />
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

            <p>We look forward to helping you streamline your business operations!</p><br>

            <p>Best regards,<br>The Tekeats Team</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tekeats. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
