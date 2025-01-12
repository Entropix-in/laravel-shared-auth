# Laravel Shared Auth

[![Latest Version](https://img.shields.io/github/v/release/entropix-in/laravel-shared-auth)](https://packagist.org/packages/entropix-in/laravel-shared-auth)
[![Total Downloads](https://img.shields.io/packagist/dt/entropix-in/laravel-shared-auth)](https://packagist.org/packages/entropix-in/laravel-shared-auth)
[![License](https://img.shields.io/github/license/entropix-in/laravel-shared-auth)](LICENSE)

Laravel Shared Auth is a package to share user authentication functionality across multiple Laravel applications. It provides a shared `User` model, migrations for user-related tables, and the ability to configure shared database connections.

## Features

- Shared `users`, `password_reset_tokens`, and `sessions` tables
- Shared `User` model for authentication
- Configurable shared database connections
- Easy integration into Laravel apps

---

## Installation

### Step 1: Install the Package

Require the package via Composer:

```bash
composer require entropix-in/laravel-shared-auth
```
