<?php

namespace App\Http\Controllers;

use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function exportDataToCSV()
    {
        $this->exportCSV();
    }

    public function exportCsv()
    {
        $data = CollectionPoint::with('categories:id,name')
            ->select('id', 'name', 'description', 'latitude', 'longitude')
            ->get();

        $filename = "collection_points_" . date('Ymd_His') . ".csv";

        $handle = fopen('php://memory', 'w+');

        // Cabeçalho CSV
        fputcsv($handle, ['name', 'description', 'latitude', 'longitude', 'categories']);

        foreach ($data as $item) {
            // Pega nomes das categorias e junta numa string separada por "; "
            $categories = $item->categories->pluck('name')->join('; ');

            fputcsv($handle, [
                $item->name,
                $item->description,
                $item->latitude,
                $item->longitude,
                $categories,
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
