<?php

namespace App\Services;

use App\Jobs\GetGeoInfoJob;
use App\Models\CollectionPoint;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CollectionPointService extends Service
{
    public function timeInputIsNotValid(string $input_1, string $input_2): bool
    {
        if (strtotime($input_1) >= strtotime($input_2)) {
            return true;
        } else {
            return false;
        }
    }

    public function findCollectionPointById(string|int $id)
    {
        try {
            return CollectionPoint::findOrFail($id);
        } catch (QueryException $e) {
            $this->handleCriticalException($e, 'Erro ao buscar ponto de coleta por ID');
            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function verifyIfUserCreateThePoint(string|int $user_id, string|int $user_point_id): bool
    {
        if ($user_id == $user_point_id) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllWithSearchIndex(Request $request): LengthAwarePaginator
    {
        try {
            $query = CollectionPoint::query();

            if ($request->filled('category')) {
                $categoryId = $request->input('category');

                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            }

            $points = $query->with('user')->orderBy('created_at', 'desc')->paginate(3)->withQueryString();

            return $points;
        } catch (QueryException $e) {
            $this->handleCriticalException($e, 'Erro ao buscar pontos de coleta e categorias.');
            return new LengthAwarePaginator([], 0, 10);
        } catch (Exception $e) {
            Log::channel('npr')->error("Erro ao buscar categorias para esquema de buscas", ['exception' => $e->getMessage()]);

            return new LengthAwarePaginator([], 0, 10);
        }
    }

    public function getGeoInfo(string $cep, string $bairro, string $cidade, string $estado, string $rua): array
    {
        try {
            $cepFormatado = preg_replace('/\D/', '', $cep); // só números
            $q = "{$rua}, {$bairro}, {$cidade}, {$estado}, Brasil, {$cepFormatado}";

            $response = Http::withoutVerifying()->get('https://api.opencagedata.com/geocode/v1/json', [
                'q' => $q,
                'key' => env('OPENCAGE_API_KEY'),
                'language' => 'pt-BR',
                'limit' => 1
            ]);
            $data = $response->json();


            $lat = $data['results'][0]['geometry']['lat'];
            $lng = $data['results'][0]['geometry']['lng'];
            $geo = [
                'latitude' => $lat,
                'longitude' =>  $lng
            ];

            return $geo;
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao buscar latitude e longitude', ['exception' => $e->getMessage()]);
            return [];
        }
    }


    public function update(Request $request, CollectionPoint $point)
    {

        $days_open = implode(' - ', $request->days_open);


        $point->name = $request->input('name');

        $point->street = $request->street;
        $point->neighborhood = $request->neighborhood;
        $point->city = $request->city;
        $point->state = $request->state;
        $point->complement = $request->complement;

        if ($point->cep !== str_replace('-', '', $request->input('cep'))) {
            $cep = str_replace('-', '', $request->input('cep'));
            $geo = $this->getGeoInfo($cep, $point->neighborhood, $point->city, $point->state, $point->street);

            $data = $request->only(['cep', 'neighborhood', 'city', 'state', 'street']);
            GetGeoInfoJob::dispatch($this, $data, $point->id);
        };

        $point->cep = str_replace('-', '', $request->input('cep'));



        $point->open_from = $request->input('open_from');
        $point->open_to = $request->input('open_to');
        $point->days_open = $days_open;
        $point->description = $request->input('description');

        $categories_id = $request->input('categories-id', []);

        $point->updated_at = now();

        $point->save();
        $point->categories()->sync($categories_id);

        return true;
    }
}
