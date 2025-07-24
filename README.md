# Natureza Prioridade Renovada 
>Laravel | MySQL | Fortify | Consumo de api externas | 

Uma plataforma com o objetivo de aumentar a visibilidade de pontos de coleta de residuos, ofertando diversas categorias para os mais diversos estabelecimentos, facilitando o contato da população com locais que muitas vezes não são divulgados e possuem pouca visibilidade. 

--- 

## Tecnologias Utilizadas

- Laravel 11 
- MySQL 
- Laravel Fortify 
- Blade 


## Funcionalidades Principais 

O sistema permite o cadastro de usuários e pontos de coleta, com sistema de autenticação utilizando o *Laravel Fortify* para controle de acesso, onde somente usuário válidados podem criar novos pontos de coleta. 

Com validação de perfil com Email  e um mapa interativo para encontrar os pontos de coleta mais próximos do usuário

Entre outras funcionalidades estão

- Cadastro e autenticação de usuários com validação por e-mail 
- Cadastro de pontos de coleta com categorias personalizadas
- Mapa interativo com visualização dos pontos mais próximos do usuário
- Sistema de recuperação de senha
- Permissões e controle de acesso (via Fortify)

## Integração com Apis Externas 

- **ViaCEP**: consulta automática de endereço pelo CEP
- **OpenCage Geocoder**: obtenção de coordenadas geográficas dos pontos de coleta
- **Google My Maps**: exibição de um mapa interativo com todos os pontos cadastrados

>Este projeto possui uma documentação mais extensa que se aprofunda nas decisões técnicas e escolhas.
>Basta acessar [a documentação técnica](./doc-tecnica.md)