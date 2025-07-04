@extends('layouts.main_layout')

@section('content')
    <section class="container py-5 pb-0">
        <div class="d-flex align-items-center mb-3">
            <h3 class="mb-0">Laravel <strong>NPR</strong></h3>
            <small class="text-muted ms-3" style="font-weight: normal; font-size: 0.875rem;">
                04/07/2025
            </small>
        </div>

        <p class="mb-3">
            Esta é uma versão reestruturada da aplicação <strong>NPR</strong>, originalmente desenvolvida em <em>React</em>
            e <em>Node.js</em>, optei por seguir com este projeto para testar e aprofundar meus conhecimentos com o
            <strong>Laravel</strong> e o <strong>Laravel Fortify</strong> para <strong>autenticação básica</strong>.
        </p>

        <p class="mb-3">
            Eu poderia ter optado por fazer uma autenticação do zero, mas acho que seria importante entender como usar uma
            ferramenta como o <strong>Fortify</strong>.
        </p>

        <p class="mb-3">
            Em geral eu foquei mais na <strong>modelagem das entidades</strong> e no <strong>desenvolvimento do
                backend</strong>, o frontend por ser algo que
            eu não quero focar muito será feito com o auxílio de uma <strong>IA</strong>, mas somente para auxílio na
            criação de
            <strong>componentes básicos</strong> para agilizar o desenvolvimento.
        </p>

        <hr>
    </section>

    <section class="container py-2">
        <div class="d-flex align-items-center mb-3">
            <h3 class="mb-0">Objetivo</h3>
            <small class="text-muted ms-3" style="font-weight: normal; font-size: 0.875rem;">
                04/07/2025
            </small>
        </div>

        <p class="mb-3">
            Meu objetivo com esse projeto, é ter no fim algo <strong>completo</strong> e <strong>bem fechado</strong> em
            relação ao seu desenvolvimento, ter
            um sistema simples onde <em>Usuários</em> podem registrar <em>Pontos de Coleta</em> de lixo e possam ver outros
            pontos existentes.
        </p>

        <p class="mb-3">
            Apesar de parecer simples, fui percebendo que cada passo que eu dou se torna mais <strong>complexo</strong>, uma
            relação mais
            complicada entre as <strong>entidades</strong> com <strong>tabelas pivôs</strong> ou dúvidas de como implementar
            <strong>determinado método</strong>.
        </p>

        <hr>
    </section>

    <section class="container py-2">
        <div class="d-flex align-items-center mb-3">
            <h3 class="mb-0">Sobre o <strong>Fortify</strong></h3>
            <small class="text-muted ms-3" style="font-weight: normal; font-size: 0.875rem;">
                04/07/2025
            </small>
        </div>


        <p class="mb-3">
            Seguindo a linha de estudos através do curso de desenvolvimento com <strong>Laravel</strong>, em dado momento
            foi apresentado a ferramenta <strong>Fortify</strong>. Achei bacana a ideia de um sistema de autenticação de
            rápida implementação e recursos poderosos. Também foi apresentado o <strong>Laravel Breeze</strong>, que é ainda
            mais simples, mas o fato dele já vir com as <em>views</em> prontas e ser de difícil personalização não me atraiu
            em relação a outras opções.
        </p>

        <p class="mb-3">
            Apesar disso, ficam visíveis algumas partes em que esses sistemas de autenticação falham em questão de
            segurança. Uma URL com informações em <em>plain text</em> e não em hash é uma preocupação quando se trata de
            sistemas que lidam com informações sensíveis.
        </p>
    </section>
@endsection
