# Verify Your Email Address

Hello {{ $customer->name }},

Thank you for choosing our service! To complete the registration process, we need to verify your email address. Please
use the following one-time password (OTP) for verification:

**OTP: {{ $customer->otp }}**

This OTP is valid for a limited time, so make sure to verify your email promptly.

If you didn't request this verification or have any concerns, please contact our support team immediately.

Thank you,
{{ config('app.name') }}
