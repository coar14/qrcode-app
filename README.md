
---

# QR Code Generator

This is a simple QR code generator built using Laravel. The application allows users to create QR codes for various types of data, such as URLs, text, and more.

## Features

- Generate QR codes for URLs, text, or any string data.
- Download the generated QR codes as image files (PNG format).
- Easy and intuitive web interface.

## Tech Stack

- **Laravel**: PHP framework used for the backend.
- **Composer**: Dependency manager for PHP.
- **Endroid QR Code**: A package used for generating QR codes.

## Installation

Follow the steps below to install and set up the project:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/coar14/qrcode-app-laravel
   cd qrcode-generator
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Create a `.env` file** by copying the example:
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

5. **Run migrations** (if applicable):
   ```bash
   php artisan migrate
   ```

6. **Run the development server**:
   ```bash
   php artisan serve
   ```

## Usage

1. Navigate to `http://localhost:8000` to access the application.
2. Input the text or URL you want to generate a QR code for.
3. Customize the size or style (if applicable).
4. Click the **Generate** button and download the QR code.

## Contributing

If you wish to contribute to this project, feel free to submit a pull request or open an issue for discussion.

## License

This project is open-source and available under the [MIT License](LICENSE).

---
