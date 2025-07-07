# NPR | Laravel

Este projeto é uma aplicação web com foco no auxílio as questões ambienteis, com o objetivo de facilitar o compartilhamento de informações até a localização sobre pontos de coleta de diversos tipos de materiais. 

Acredito que seja um bom projeto para implementar e aprofundar meus conhecimentos no **Laravel** de maneira a testar meu conhecimento nas suas funcionalidades essenciais e recursos extras.

---

### Tecnologias Implementadas

| Tecnologia | Objetivo / Explicação                                                                                      |
|------------|-----------------------------------------------------------------------------------------------------------|
| Laravel    | Foco de estudos deste projeto, framework PHP robusto para desenvolvimento web.                             |
| Blade      | Template engine do Laravel utilizada para renderização de views e criação de componentes reutilizáveis.    |
| MySQL      | Banco de dados relacional, ideal para modelar relacionamentos entre entidades e manter integridade dos dados. |
| Fortify    | Sistema de autenticação e autorização, gerenciando o controle de acesso aos recursos do projeto.           |

---

## Operações das Entidades do Sistema
O projeto se baseia em dois elementos principais: o `Usuário` e os `Pontos de Coleta`, cujas funcionalidades são direcionadas a essas duas entidades.

### Usuário'

- **Guest (Usuário não logado)**
    - Criar nova conta
    - Realizar login
    - Visualizar pontos de coleta cadastrados
    - Acessar o mapa
- **Usuário Logado**
    - Registrar novo ponto de coleta
    - Realizar logout
    - Alterar senha


#### Criação de nova conta
O usuário preenche um formulário com suas informações(nome, email, senha) e faz o envio para o sistema.

O **Fortify** valida as  informações e registra o usuário caso esteja com as informações corretas e assim cria um novo usuário, após isso o usuário é redirecionado para a página de login.

Após a criação de um novo usuário o sistema envia um email para o usuário com informações para válidar o seu perfil.

> **Aviso:** o usuário ainda poderá acessar alguns recursos do sistema sem essa validação, mas outros recursos como a criação de novos pontos de coleta é permitida somente para usuários validados.

#### Realizar login
O usuário preenche as informações para login(email, senha) e faz o envio.

Novamente o **Fortify** válida as informações assim realizando o login ou retornando o usuário para a página de login com mais informações.

Após logado, o usuário tem acesso a novas funcionalidades como a criação de um novo ponto de coleta.

#### Recuperação de senha - `Fortify`

Caso o usuário esqueça sua senha, a recuperação da informação segue o seguinte fluxo: 

O usuário acessa a view responsável por exibir um formulário onde será preenchido `email` da conta a ser recuperada.

Após isso é enviado um email para ela, com as informações sobre a recuperação da senha.

Seguindo as orientações o usuário irá ser redirecionado a um formulário para preencher a nova senha e após isso é efetuado a troca de senhas do perfil.

---
## Pontos de Coleta

#### Listar os pontos de coleta

Acessando a home é carregado as informações dos pontos de coletas registrados no banco de dados e renderizado como cards para a visualização. 

Ao clicar em qualquer card sobre um ponto, o usuário é redirecionado para uma página com mais detalhes e informações sobre o ponto.

#### Cadastrar um novo ponto de coleta
Para cadastrar um novo ponto de coleta, é realizar o preenchimento do formulário com as seguintes informações

- Nome do ponto de coleta
- Cep
- Estado
- Cidade 
- Bairro
- Rua
- Número
- Complemento
- Tipo de coleta
- Horario de funcionamento
- Dias de funcionamento
- Descrição (opcional)

Apesar de extensas, acredito serem informações importantes para o registro de novas informações.

Após preencher e realizar o envio, o sistema irá validar as informações usando a classe `Requests/CollectionPoint/StoreRequest` para realizar a verificação dos campos com base em regras especificas para cada campo, caso não tenha problemas seguira o fluxo até o `CollectionPointController` para realizar a inserção no banco de dados.

Neste ponto, será válidade primeiro se os hórarios de funcionamento são coerentes, evitando assim que um horário de abertura seja maior que o hórario de fechamento 
>**Exemplo:** Se o local abre as 12:00 e fecha as 06:00 não será uma informação válida para o sistema e irá retornar para a página de cadastro com um aviso.

Após isso, o `array` de informações sobre os dias da semana que abre, será formatado como string.

O CEP irá ser formatado para remover a pontuação.

Após isso é realizado o registro das informações no banco de dados na entidade `collection_points` e após isso com base nas informações das categorias será registrado na tabela pivô entre os pontos de coleta e as categorias suas respectivas categorias.