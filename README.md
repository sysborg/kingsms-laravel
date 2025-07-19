# KingSMS Laravel Package

Easily integrate [KingSMS](https://www.kingsms.com.br/) into your Laravel application.

This package simplifies the process of sending SMS, retrieving reports, checking balance, and receiving replies using the KingSMS API.

---

## 📦 Installation

Install the package via Composer:

```bash
composer require sysborg/kingsms
```

The service provider is auto-discovered by Laravel, so no need to manually add it to `config/app.php`.

---

## ⚙️ Configuration

Add your KingSMS credentials to your `.env` file:

```env
KINGSMS_URL=https://painel.kingsms.com.br/kingsms/api.php
KINGSMS_LOGIN=your_login
KINGSMS_TOKEN=your_token
```

The default API URL is already set, but you can override it if needed.

---

## 🚀 Usage

### Send SMS

```php
use Facades\Sysborg\KingSMS\Services\KingSMS;

$response = KingSMS::sendSMS(
    '5598999999999', // Recipient phone number
    'Your message goes here', // Message content
    'Optional Campaign Name',
    'Optional Date (dd/mm/yyyy)',
    'Optional Time (hh:mm)'
);
```

### Get SMS Report

```php
$response = KingSMS::getRelatorio('your_sms_id');
```

### Check Balance

```php
$response = KingSMS::getSaldo();
```

### Get SMS Replies

```php
$response = KingSMS::getResposta('read'); // or 'unread'
```

---

## 🔔 Using as Notification Channel

You can also send SMS using Laravel's notification system.

### 1. Add `toKingsms()` method in your Notification:

```php
public function via($notifiable)
{
    return ['kingsms'];
}

public function toKingsms($notifiable)
{
    return 'This is your notification message';
}
```

### 2. Your Notifiable Model must return the phone number

To let Laravel know which phone number to use, your notifiable model (usually User) must implement the following method:

```php
public function routeNotificationForKingsms(): ?string
{
    // Example: clean Brazilian cellphone format and prepend +55
    $phone = preg_replace('/\D/', '', $this->celular); // or $this->phone
    return $phone ? '+55' . $phone : null;
}
```

Ensure your notifiable entity has a `phone` attribute or method.

---

## 🔗 Useful Links

- 📘 [Official KingSMS API Documentation](https://kingsms.docs.apiary.io/#)
- 🌐 [KingSMS Website](https://www.kingsms.com.br/)

---

## 👨‍💻 Author

Developed and maintained by:

**Anderson Arruda**  
📧 [andmarruda@gmail.com](mailto:andmarruda@gmail.com)

Also maintained by:  
**Sysborg**  
📧 [contato@sysborg.com.br](mailto:contato@sysborg.com.br)
