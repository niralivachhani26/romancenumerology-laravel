# Romance Numerology & AI Soulmate Sketch Platform

A full-stack enterprise web application built with **Laravel** that combines astrological numerology algorithms with generative AI image models. The platform calculates personalized numerology metrics (Life Path, Expression, and Soul Urge numbers) and generates automated, high-resolution AI soulmate sketches based on user profile inputs.

---

### 🚀 Core Features

* **Algorithmic Numerology Engine:** Custom mathematical logic calculating core numbers (Life Path, Expression, Soul Urge, and Destiny) using birth dates and name mapping.
* **Dynamic AI Prompt Generation:** Dynamically maps numerology traits into detailed prompts and triggers async requests to generative AI image APIs (OpenAI DALL-E / Stability AI / Replicate).
* **Cloud Storage Integration:** Directly connects with cloud asset storage (AWS S3) for secure, fast storage and delivery of generated sketch images.
* **Automated CI/CD Workflows:** Equipped with pre-configured **GitHub Actions CI/CD** pipelines running automated unit tests (`php artisan test`) and zero-downtime deployment steps upon push.
* **Secure Environment Variables:** Strictly isolates API keys and cloud credentials using `.env` environment loading to keep secrets out of source control.

---

### 🛠️ Tech Stack & Architecture

| Layer | Technology |
| :--- | :--- |
| **Backend Framework** | ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white) ![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white) |
| **Database Engine** | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) |
| **Generative AI** | OpenAI API |
| **DevOps & Testing** | GitHub Actions (CI/CD) / PHPUnit |

---

### 💻 Local Installation & Setup Instructions

Follow these 7 structured steps to deploy and execute the application locally:

#### 1. Clone the Infrastructure
git clone [https://github.com/niralivachhani26/romancenumerology-laravel.git](https://github.com/niralivachhani26/romancenumerology-laravel.git)

cd romancenumerology-laravel

#### 2. Install PHP Dependencies
composer install

#### 3. Environment Configuration
##### On Windows Command Prompt:
copy .env.example .env

##### On Bash / Linux / Mac:
cp .env.example .env

#### 4. Generate Application Encryption Key
php artisan key:generate

#### 5. Configure Database & AI Secrets
(Open .env and set your database connection and AI API credentials:)

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=romancenumerology_db

DB_USERNAME=root

DB_PASSWORD=


##### AI & Cloud Storage Configuration
OPENAI_API_KEY=your_openai_api_key_here

REPLICATE_API_TOKEN=your_replicate_token_here

#### 6. Run Migrations & Seeders
php artisan migrate --seed

#### 7. Link Storage & Launch Application
php artisan storage:link

php artisan serve
