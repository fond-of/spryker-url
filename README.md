# fond-of-spryker/smtp-mail
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/smtp-mail)

Extends the default Spryker mail module with smtp functionality.

## Install

```
composer require fond-of-spryker/smtp-mail
```

#### 1. Extend MailDependencyProvider

Open your MailDependencyProvider, mostly stored in Pyz\Zed\Mail. 
Extend your MailDependency with the FondOfSprykerMailDependencyProvider 
instaead the SprykerMailDependency.

```
class MailDependencyProvider extends FondOfSprykerMailDependencyProvider
```

#### 2. Set Configuration

Set the following variables to your ConfigFile like config_default_whatever.php

```
$config[MailConfigConstants::MAILER_SMTP_HOST] = 'localhost';
$config[MailConfigConstants::MAILER_SMTP_PORT] = 25;
$config[MailConfigConstants::MAILER_SMTP_USER] = 'JohnDoe';
$config[MailConfigConstants::MAILER_SMTP_PASSWORD] = 'password';
```

You can extend the configuration by yourself. Take a look into FondOfSpryker\Zed\SmtpMail\MailDependencyProvider