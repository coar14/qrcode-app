
---

# QR Code Generator

This is a simple QR code generator built using Laravel. The application allows users to create, download, and manage QR codes for various types of data.

## Features

- Generate QR codes for URLs, text, or any string data.
- Download the generated QR codes in CSV format.
- Delete previously generated QR codes.
- Easy and intuitive web interface.

## Tech Stack

- **Laravel**: PHP framework used for the backend.
- **Composer**: Dependency manager for PHP.
- **Endroid QR Code**: A package used for generating QR codes.

## Routes

- **Display QR Code Generator Page**:  
  `GET /qrcode`  
  Loads the main page where users can input data to generate a QR code.

- **Generate QR Code**:  
  `POST /qrcode/generate`  
  Generates a QR code based on the provided data (URL, text, etc.).

- **Download CSV of Generated QR Codes**:  
  `GET /qrcode/download-csv`  
  Allows users to download a CSV file containing the generated QR codes and their associated data.

- **Delete Generated QR Code**:  
  `DELETE /qrcode/delete`  
  Removes a generated QR code from the system.

## Installation

Follow the steps below to install and set up the project:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/qrcode-generator.git
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

1. Navigate to `http://localhost:8000/qrcode` to access the application.
2. Input the text or URL you want to generate a QR code for.
3. Click the **Generate** button to generate the QR code.
4. You can download all generated QR codes in CSV format or delete them as needed.

## Contributing

If you wish to contribute to this project, feel free to submit a pull request or open an issue for discussion.

## License

This project is open-source and available under the [MIT License](LICENSE).

---
