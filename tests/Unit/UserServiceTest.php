<?php

use App\Models\User;
use App\Services\UserService;

beforeEach(function () {
    $this->service = new UserService();
});

test('retorna true se o email existe', function () {
    User::shouldReceive('where->exists')
        ->once()
        ->andReturn(true);

        $result = $this->service->verifyIfEmailExists('email@gmail.com');

        expect($result)->toBeTrue();
});
