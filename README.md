# Pre order package.
Pre order package using api and admin panel

---

## Installation

```sh
composer require pre-order/pre-order-backend
```

#### Run command for crud file generate
```sh
php artisan migrate
```

## Google Captcha Configuration

#### Add your application .env
```sh
    GOOGLE_RECAPTCHA_SITE_KEY="your google site key"
    GOOGLE_RECAPTCHA_SECRET_KEY="your google secret key"
    GOOGLE_RECAPTCHA_BYPASS="false" (if you do not want t use captcha then set false else true)
```

## Email Configuration

#### Email configuration to your application .env
```sh
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=dfasd
MAIL_PASSWORD=24324
```

#### Queue management for email for your application
```sh
    configure supervisor for queue worker
              OR
    Run : php artisan queue:work
```

## Contribution
You're open to create any Pull request for contribution.
