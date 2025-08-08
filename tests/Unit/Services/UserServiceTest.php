<?php

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;

beforeEach(function() {
    $this->service = new UserService();
    $this->user = Mockery::mock('alias:' . User::class);
    $this->queryException = new \Illuminate\Database\QueryException('name',
        'select * from users where id = ?',
        [1],
        new Exception('Erro')
    );

    Log::spy();
    Log::shouldReceive('channel')
        ->with('npr')
        ->andReturnSelf(); // retorna um objeto válido
});


describe('UserService@verifyIfEmailExists', function() {
    test('Retorna true se o email existir', function() {
        $this->user
            ->shouldReceive('where')
            ->once()
            ->with('email', 'email.valido@gmail.com')
            ->andReturnSelf();

        $this->user
            ->shouldReceive('exists')
            ->once()
            ->andReturn(true);

        expect($this->service->verifyIfEmailExists('email.valido@gmail.com'))
            ->toBeTrue();
    });

    test('Retorna false se o email não existir', function() {
        $this->user
            ->shouldReceive('where')
            ->once()
            ->with('email', 'email.inexistente@gmail.com')
            ->andReturnSelf();

        $this->user
            ->shouldReceive('exists')
            ->once()
            ->andReturn(false);

        expect($this->service->verifyIfEmailExists('email.inexistente@gmail.com'))
            ->toBeFalse();
    });
});

describe('UserService@findUserById', function() {
    test('Deve retornar um modelo do User', function(){
        $this->user
            ->shouldReceive('findOrFail')
            ->once()
            ->with(1)
            ->andReturn(new User());

        expect($this->service->findUserById(1))
            ->toBeInstanceOf(User::class);
    });

    test('Deve lançar uma exceção e retornar nulo caso de erro de conexão com o banco', function(){
        $this->user
            ->shouldReceive('findOrFail')
            ->once()
            ->with(1)
            ->andThrow($this->queryException);

        expect($this->service->findUserById(1))
            ->toBeNull();
    });

    test('Lança uma exceção se não enviar parâmetros', function() {
        $this->user->shouldNotReceive('findOrFail');

        expect(fn() => $this->service->findUserById())
            ->toThrow(\ArgumentCountError::class);
    });
});

describe('UserService@findUserByEmail', function() {
    test('Retorna modelo User ao buscar um email existente', function() {
        $validEmail = 'email.existente@gmail.com';
        $this->user
            ->shouldReceive('where')
            ->once()
            ->with('email', $validEmail)
            ->andReturnSelf();

        $this->user
            ->shouldReceive('first')
            ->once()
            ->andReturn(new User());

        $user = $this->service->findUserByEmail('email.existente@gmail.com');

        expect($user)
            ->toBeInstanceOf(User::class);
    });
});