<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QrCodeController extends Controller
{
    public function index()
    {
        // Get all the QR codes stored in the public/qr_codes directory
        $qrCodes = Storage::files('qr_codes');

        return view('qrcode', compact('qrCodes'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'start' => 'required|integer|min:1',
            'end' => 'required|integer|gte:start',
            'batch_size' => 'nullable|integer|min:1', // Optional batch size
            'label' => 'nullable|string'
        ]);
        ini_set('max_execution_time', 1200);

        $start = (int) $request->input('start');
        $end = (int) $request->input('end');
        $label = $request->input('label', 'Code');
        $batchSize = $request->input('batch_size', 100); // Default batch size

        $currentBatchStart = $start;

        while ($currentBatchStart <= $end) {
            $currentBatchEnd = min($currentBatchStart + $batchSize - 1, $end);

            for ($i = $currentBatchStart; $i <= $currentBatchEnd; $i++) {
                $code = sprintf("{$label}-%03d", $i);
                $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=40x40&data={$code}";

                $fileName = $code . '.jpg';
                $filePath = "qr_codes/{$fileName}";

                if (!Storage::exists($filePath)) {
                    $imageContent = file_get_contents($qrCodeUrl);
                    Storage::put($filePath, $imageContent);
                }
            }

            $currentBatchStart += $batchSize;

            // Optional: Sleep between batches to give the server a break
            sleep(1);
        }

        return redirect()->route('qrcode.index')->with('success', 'QR Codes generated successfully.');
    }




    public function downloadCsv(Request $request)
    {
        // Ensure start and end inputs are provided by the user
        $request->validate([
            'start' => 'required|integer|min:1',
            'end' => 'required|integer|gte:start',
            'label' => 'nullable|string'
        ]);

        $start = (int) $request->input('start');
        $end = (int) $request->input('end');
        $label = $request->input('label', 'Code');

        // Ensure the CSV file is stored in the public/qr_codes directory
        $fileName = 'qrcodes_' . $start . '_to_' . $end . '.csv';
        $filePath = "qr_codes/{$fileName}";

        // Open the file for writing in the specified directory
        $file = fopen(Storage::path($filePath), 'w');
        fputcsv($file, ['QR Code', 'Base64 Image']);

        // Loop through the specified range and write each QR code to the CSV
        for ($i = $start; $i <= $end; $i++) {
            $code = sprintf("{$label}-%03d", $i);
            $fileName = $code . '.png';
            $imagePath = Storage::path("qr_codes/{$fileName}");

            // Read the image and convert it to base64
            $imageData = base64_encode(file_get_contents($imagePath));
            $base64Image = "data:image/png;base64," . $imageData;

            // Write the code and base64 image to the CSV
            fputcsv($file, [$code, $base64Image]);
        }

        fclose($file);

        // Return the CSV file as a downloadable response
        return response()->download(Storage::path($filePath));
    }

    public function delete()
    {
        // Delete the entire qr_codes directory from the public disk
        $directory = 'qr_codes/';
        Storage::deleteDirectory($directory);

        return redirect()->route('qrcode.index')->with('success', 'All QR Codes deleted successfully.');
    }
}
