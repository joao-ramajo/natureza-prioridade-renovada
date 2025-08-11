<?php

use App\Http\Requests\CollectionPoint\StoreRequest;
use App\Models\User;
use App\Services\CollectionPointService;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

beforeEach(function() {

    $this->service = new CollectionPointService();
});

describe('CollectionPointService@timeInputIsValid', function(){

    test('Horários válidos',  function($open_from, $open_to) {
        expect($this->service->timeInputIsValid($open_from, $open_to))
            ->toBeTrue();
    })->with([
        ['08:00', '18:00'],
        ['10:30', '11:00'],
    ]);

    test('Horários inválidos', function($open_from, $open_to) {
        expect($this->service->timeInputIsValid($open_from, $open_to))
            ->toBeFalse();
    })->with([
        [
            '18:00', '08:00'
        ],
        [
            '15:00', '15:00'
        ],
        [
            '00:00', '00:00'
        ],
        [
            '12:00', '10:00'
        ],
        [
            'Aa:bB', 'Aa:bB'
        ]
    ]);
});