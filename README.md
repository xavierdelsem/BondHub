<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Project Features and Processes

BondHub is a specialized platform designed to automate the management and prize-tracking of Bangladesh Bank Prize Bonds. Below are the core features and their underlying technical processes.

### 1. User Account & KYC Management

The system maintains comprehensive user profiles necessary for official prize claims as required by banking regulations.

- **Registration**: Users provide standard credentials (name, email, password).
- **Extended Profile (KYC)**: To facilitate claim form generation, the system collects detailed attributes such as nationality, occupation, bank account details (Bank Name, Branch, Account Number), and address details (Village, Post, Thana, Zilla).
- **Relationships**: Users can manage "Relation" data, which is often required for specific bond claim categories.

### 2. Bond Portfolio Management

Users can register and maintain a digital inventory of their physical prize bonds.

- **Data Points**: The system tracks the Bond Number, Series, and the Date of Purchase.
- **Ownership**: Each bond is linked to a `User` model via Eloquent relationships, ensuring that notifications are routed to the correct owner.

### 3. Automated Prize Winner Identification

The application features a centralized process to check all registered bonds against official draw results. This is handled by the `Bond::updateStatus()` method:

- **Draw Syncing**: It retrieves a map of all winning numbers and their prize positions from the `draws` table.
- **Integrity Check**: It automatically resets the status of bonds that no longer match winning numbers (handling edge cases like draw data updates or corrections).
- **Winner Scanning**: It identifies bonds in the system that match current winning numbers and have not yet been flagged as winners.
- **Status Update**: It updates the `isPrizeWon` status in the database to ensure tracking is current and to prevent duplicate alerts.

### 4. Multi-Channel Notification Workflow

Once a win is confirmed, the system triggers the `AlertWinner` notification process:

- **Dynamic Channel Routing**: The system checks the user's available contact methods. It always logs the win to the **Database Channel** for in-app history and conditionally sends an email via the **Mail Channel** if a valid email address is present.
- **Personalized Messaging**: Notifications include the specific bond number and the prize rank (e.g., 1st prize, 2nd prize).
- **Email Delivery**: Emails are dispatched using SMTP (configured for services like Mailtrap in development). The email includes a personalized greeting and a direct link to the official Bangladesh Bank claim form PDF.
- **Database Persistence**: Winners can view their prize history and messages within the application's notification interface at any time.

### 5. Claim Assistance

The system bridges the gap between winning and claiming the prize.

- **Document Access**: Every win notification provides immediate access to the official legal documentation required for the claim.
- **Data Readiness**: Because the user profile captures bank and address details, the application maintains the necessary data to assist users in preparing for submission to designated bank branches.
