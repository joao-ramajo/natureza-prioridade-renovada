<?php

use App\Services\CollectionPointService;

beforeEach(function() {
    $this->service = new CollectionPointService();
});

describe('CollectionPointService@timeInputIsValid', function(){
    test('Horário de abertura é menor que o horário de fechamento deve ser válido', function(){
        expect($this->service->timeInputIsValid('08:00', '15:00'))
            ->toBeFalse();
    });

    test('Horário de abertura é maior que o horário de fechamento deve ser inválido', function() {
        expect($this->service->timeInputIsValid('15:00', '08:00'))
            ->toBeTrue();
    });

    test('E se o horário de abertura for igual ao horário de fechamento', function() {
        expect($this->service->timeInputIsValid('15:00', '15:00'))
            ->toBeTrue();
    });
});