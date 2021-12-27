# Installation

```shell
composer require sofiakb/php-mail
```

Then, in your .env file
```
MAIL_USER=
MAIL_PASSWORD=
MAIL_HOST=
MAIL_PORT=
MAIL_ENCRYPTION=
```

# Usage
```
use Sofiakb\Mail\Facades\Mail;

Mail::create()
    ->setTo(RECIPIENT_EMAIL)
    ->text("email content"));

```