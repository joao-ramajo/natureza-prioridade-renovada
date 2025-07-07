@extends('layouts.main_layout')
@section('head')
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 2rem;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 0.5rem;
            text-align: left;
        }

        table th {
            background-color: #f5f5f5;
        }

        h1,
        h2,
        h3,
        h4 {
            margin-top: 2rem;
            color: #222;
        }

        blockquote {
            border-left: 4px solid #ccc;
            padding-left: 1rem;
            margin: 1rem 0;
            color: #555;
            background-color: #f9f9f9;
        }

        hr {
            margin: 2rem 0;
            border: none;
            border-top: 1px solid #ddd;
        }
    </style>
@endsection
@section('content')
    <h1>NPR | Laravel</h1>

    <p>
        Este projeto é uma aplicação web com foco no auxílio às questões ambientais, com o objetivo de facilitar o
        compartilhamento de informações até a localização sobre pontos de coleta de diversos tipos de materiais.
    </p>

    <p>
        Acredito que seja um bom projeto para implementar e aprofundar meus conhecimentos no <strong>Laravel</strong>, de
        maneira a testar minhas habilidades nas funcionalidades essenciais e recursos extras do framework.
    </p>

    <hr>

    <h3>Tecnologias Implementadas</h3>

    <table>
        <thead>
            <tr>
                <th>Tecnologia</th>
                <th>Objetivo / Explicação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Laravel</td>
                <td>Foco de estudos deste projeto, framework PHP robusto para desenvolvimento web.</td>
            </tr>
            <tr>
                <td>Blade</td>
                <td>Template engine do Laravel utilizada para renderização de views e criação de componentes reutilizáveis.
                </td>
            </tr>
            <tr>
                <td>MySQL</td>
                <td>Banco de dados relacional, ideal para modelar relacionamentos entre entidades e manter integridade dos
                    dados.</td>
            </tr>
            <tr>
                <td>Fortify</td>
                <td>Sistema de autenticação e autorização, gerenciando o controle de acesso aos recursos do projeto.</td>
            </tr>
        </tbody>
    </table>

    <hr>

    <h2>Operações das Entidades do Sistema</h2>
    <p>O projeto se baseia em dois elementos principais: o <code>Usuário</code> e os <code>Pontos de Coleta</code>, cujas
        funcionalidades são direcionadas a essas duas entidades.</p>

    <h3>Usuário</h3>

    <ul>
        <li><strong>Guest (Usuário não logado)</strong>
            <ul>
                <li>Criar nova conta</li>
                <li>Realizar login</li>
                <li>Visualizar pontos de coleta cadastrados</li>
                <li>Acessar o mapa</li>
            </ul>
        </li>
        <li><strong>Usuário Logado</strong>
            <ul>
                <li>Registrar novo ponto de coleta</li>
                <li>Realizar logout</li>
                <li>Alterar senha</li>
            </ul>
        </li>
    </ul>

    <h4>Criação de nova conta</h4>
    <p>O usuário preenche um formulário com suas informações (nome, email, senha) e faz o envio para o sistema.</p>
    <p>O <strong>Fortify</strong> valida as informações e registra o usuário caso estejam corretas, redirecionando-o para a
        página de login.</p>
    <p>Após a criação, o sistema envia um email com instruções para validação do perfil.</p>
    <blockquote>
        <strong>Aviso:</strong> o usuário ainda poderá acessar alguns recursos do sistema sem essa validação, mas recursos
        como a criação de pontos de coleta exigem e-mail validado.
    </blockquote>

    <h4>Realizar login</h4>
    <p>O usuário preenche email e senha, e envia. O <strong>Fortify</strong> valida e autentica ou retorna mensagens de
        erro.</p>
    <p>Após logado, novas funcionalidades ficam disponíveis.</p>

    <h4>Recuperação de senha - <code>Fortify</code></h4>
    <p>Se esquecer a senha, o usuário pode preencher seu e-mail em um formulário.</p>
    <p>Será enviado um link de recuperação para preenchimento de nova senha e redefinição do acesso.</p>

    <hr>

    <h2>Pontos de Coleta</h2>

    <h4>Listar os pontos de coleta</h4>
    <p>Na página inicial, os pontos cadastrados são carregados do banco e exibidos como cards. Clicando em um card, o
        usuário acessa uma página com informações detalhadas do ponto de coleta.</p>

    <h4>Cadastrar um novo ponto de coleta</h4>
    <p>O usuário preenche um formulário com os seguintes dados:</p>
    <ul>
        <li>Nome do ponto de coleta</li>
        <li>Cep</li>
        <li>Estado</li>
        <li>Cidade</li>
        <li>Bairro</li>
        <li>Rua</li>
        <li>Número</li>
        <li>Complemento</li>
        <li>Tipo de coleta</li>
        <li>Horário de funcionamento</li>
        <li>Dias de funcionamento</li>
        <li>Descrição (opcional)</li>
    </ul>

    <p>Essas informações são validadas pela classe <code>Requests/CollectionPoint/StoreRequest</code>. Caso estejam
        corretas, seguem para o <code>CollectionPointController</code>, que trata da persistência no banco de dados.</p>

    <p>Validações adicionais incluem a consistência dos horários de funcionamento:</p>
    <blockquote>
        <strong>Exemplo:</strong> Se o local abre às 12:00 e fecha às 06:00, isso não será aceito como válido.
    </blockquote>

    <p>Em seguida:</p>
    <ul>
        <li>O array de dias da semana é formatado como string.</li>
        <li>O CEP tem seus caracteres especiais removidos.</li>
        <li>O ponto é salvo na tabela <code>collection_points</code>.</li>
        <li>As categorias relacionadas são salvas na tabela pivô com base no relacionamento.</li>
    </ul>
@endsection
