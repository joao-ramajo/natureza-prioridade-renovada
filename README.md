# NPR | Laravel


Este projeto é uma aplicação web com foco no auxílio as questões ambienteis, com o objetivo de facilitar o compartilhamento de informações até a localização sobre pontos de coleta de diversos tipos de materiais. 

Acredito que seja um bom projeto para implementar e aprofundar meus conhecimentos no **Laravel** de maneira a testar meu conhecimento nas suas funcionalidades essenciais e recursos extras.
## SUMÁRIO

- [Tecnologias](#tecnologias-implementadas)
- [Operações de Usuário](#operações-das-entidades-do-sistema)
- [Pontos de Coleta](#pontos-de-coleta)
- [Níveis de Acesso](#níveis-de-acesso)
- [Como Rodar o Projeto](#como-rodar-o-projeto-localmente)
- [Rotas](#rotas)
- [Observabilidade](#observabilidade)
- [Entidades e Banco e Dados](#entidades-e-banco-de-dados)
    - [Relacionamentos](#relacionamentos)
---

### TECNOLOGIAS IMPLEMENTADAS

| Tecnologia | Objetivo / Explicação                                                                                      |
|------------|-----------------------------------------------------------------------------------------------------------|
| Laravel    | Foco de estudos deste projeto, framework PHP robusto para desenvolvimento web.                             |
| Blade      | Template engine do Laravel utilizada para renderização de views e criação de componentes reutilizáveis.    |
| MySQL      | Banco de dados relacional, ideal para modelar relacionamentos entre entidades e manter integridade dos dados. |
| Fortify    | Sistema de autenticação e autorização, gerenciando o controle de acesso aos recursos do projeto.           |

---

## OPERAÇÕES DAS ENTIDADES DO SISTEMA
O projeto se baseia em dois elementos principais: o `Usuário` e os `Pontos de Coleta`, cujas funcionalidades são direcionadas a essas duas entidades.

### USUÁRIO

#### CRIAÇÃO DE UMA NOVA CONTA
O usuário preenche um formulário com suas informações(nome, email, senha) e faz o envio para o sistema.

O **Fortify** valida as  informações e registra o usuário caso esteja com as informações corretas e assim cria um novo usuário, após isso o usuário é redirecionado para a página de login.

Após a criação do usuário o sistema 2 *emails* sendo um referente a válidação da conta e outro com uma mensagem personalizada de boas vindas.

> ⚠️*Aviso* 
>o usuário ainda poderá acessar alguns recursos do sistema sem essa validação mas outros recursos como a criação de novos pontos de coleta é permitida somente para *Usuários Verificados*.

#### APAGAR CONTA
Esta opção esta disponível na página de perfil do usuário, onde será encontrada em um botão cuja rota seguira para as operações necessárias para apagar a conta.

A operação esta protegida por um *middleware* que solicita a senha atual do perfil para garantir que seja uma operação válida.
 
#### LOGIN - `Fortify`
O usuário preenche as informações para login(email, senha) e faz o envio.

Novamente o **Fortify** válida as informações assim realizando o login ou retornando o usuário para a página de login com mais informações.

Após logado, o usuário tem acesso a novas funcionalidades como a criação de um novo ponto de coleta.

#### LOGOUT - `Fortify`  
O logout é realizado atrâves de um botão encontrado no *header*  da aplicação.

Nada mais é de que um formulário com **POST** com design de um botão para realizar o logout atravês do `Fortify`.

Após isso o usuário será redirecionado a área de login e suas informações da sessão serão removidas.


#### RECUPERAÇÃO DE SENHA - `Fortify`

Caso o usuário esqueça sua senha, a recuperação da informação segue o seguinte fluxo: 

O usuário acessa a view responsável por exibir um formulário onde será preenchido `email` da conta a ser recuperada.

Após isso é enviado um email para ela, com as informações sobre a recuperação da senha.

Seguindo as orientações o usuário irá ser redirecionado a um formulário para preencher a nova senha e após isso é efetuado a troca de senhas do perfil.

---
### PONTOS DE COLETA

Os pontos de coleta são locais/organizações que estão a disposição para o recolhimento de materiais que serão descartados com o objetivo de garantir o melhor destino aos resíduos.

O projeto disponibiliza as seguintes operações.

#### LISTAR PONTOS 

Acessando a home é carregado as informações dos pontos de coletas registrados no banco de dados e renderizado como cards para a visualização. 

Ao clicar em qualquer card sobre um ponto, o usuário é redirecionado para uma página com mais detalhes e informações sobre o ponto.

#### CADASTRAR UM NOVO PONTO DE COLETA
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

>:bulb:*Dica sobre o Formulário*
> O formulário disponibiliza um autopreencher das informações com o CEP fornecido, onde após o preenchimento do campo, será buscado as informações a partir da *api* da [ViaCEP](https://viacep.com.br/)

Após preencher e realizar o envio, o sistema irá validar as informações usando a classe `Requests/CollectionPoint/StoreRequest` para realizar a verificação dos campos com base em regras especificas para cada campo, caso não tenha problemas seguira o fluxo até o `CollectionPointController` para realizar a inserção no banco de dados.

Neste ponto, será válidade primeiro se os hórarios de funcionamento são coerentes, evitando assim que um horário de abertura seja maior que o hórario de fechamento 

**Exemplo:** Se o local abre as 12:00 e fecha as 06:00 não será uma informação válida para o sistema e irá retornar para a página de cadastro com um aviso.

Após isso, o `array` de informações sobre os dias da semana que abre, será formatado como string.

O CEP irá ser formatado para remover a pontuação.

Após isso é realizado o registro das informações no banco de dados na entidade `collection_points` e após isso com base nas informações das categorias será registrado na tabela pivô entre os pontos de coleta e as categorias suas respectivas categorias.

**Integração com a *api* da [ViaCEP](https://viacep.com.br/)**
O uso da api é feito a partir de uma requisição *fetch* em javascript que se encontrar resultados válidos irá substituir os campos rua, bairro, cidade e estado, automaticamente, facilitando assim o preenchimento das informações.

A requisição acontece apartir de uma chamada de função assíncrona que espera uma resposta *json* com as informações de endereço.

Caso aconteça algum erro ou não encontre as informações, o usuário será informado que deve verificar o cep ou preencher as informações a mão caso tenha certeza.   
>⚠️ *Aviso sobre permissões*
>Somente usuários que validaram sua conta atrâves da verificação por email podem reaalizar realizar esta tarefa 

#### APAGAR PONTO DE COLETA
Para apagar um ponto de coleta o usuário deve estar na página de visualização do ponto e deve ser o **mesmo usuário que cadastrou o ponto de coleta**, caso contrário nenhuma opção sera mostrada.

O mesmo se aplica a questão de *Editar* as informações do ponto de coleta

#### EDITAR INFORMAÇÕES DO PONTO DE COLETA
A alteração de informações de um ponto de coleta esta disponivel a partir de um modal com um formulário com as informações atuais do ponto de coleta, onde **somente o usuário que registrou o ponto de coleta** terá acesso a estas informações e funcionalidades.

O mesmo se aplica a questão de *Apagar* um ponto de coleta do banco de dados.

---
## NÍVEIS DE ACESSO
O projeto esta disponivel a partir de 3 níveis de acesso, sendo eles:
 *guest*, *usuário* e *usuário verificado* 

#### GUEST
Usuário não logado, acesso restrito as funcionalidades básicas, sendo necessário realizar *Login* para acessar qualquer rota da aplicação.

>*Nota*
> Não acredito que sejá o ideal, pretendo mudar este modelo de permissões, um usuário não logado poderia no mínimo ver os pontos de coleta cadastrados para facilitar o compartilhamento destas informações.


#### USUÁRIO
Mesmo após criar uma conta e realizar o *Login* o usuário deve validar sua conta atravês do link enviado para o seu *email* sem isso ele não pode cadastrar novos pontos de coletas.
Apesar disso ele pode acessar o restante das opções do projeto como as páginas de perfil e dos pontos de coleta já cadastrados.

#### USUÁRIO VERIFICADO
Após a validação do perfil atravês do link enviado para o *email* do usuário, ele terá total acesso às funcionalidades do projeto, podendo criar e editar novos pontos de coleta.

--- 

## COMO RODAR O PROJETO LOCALMENTE

1. Clone o repositório
```bash
    git clone https://github.com/seu-usuario/npr.git
    cd npr
```

Após isso use o comando `cd` para acessar a pasta do projeto

2. Instale as dependências
```bash
    composer update
```
Com isso o *composer* irá carregar todos os arquivos necessários para o projeto funcionar

3. Configure o arquivo de configurações `.env`
```
    cp .env.example .env
    php artisan key:generate    
```
Altere as informações do `.env` com base nas informações de configurações do seu banco de dados para poder acessa-lo.

4. Rode as migrações e seeders
```bash
    php artisan migrate --seed
```
Com este comando o artisan será encarregado de realizar a criaçao de todas as tabelas necessárias e junto do `--seed` irá criar alguns registros para poder testar as funcionalidades básicas

5. Inicie o servidor local
```bash
    php artisan serve
```

Após estas etapas se tudo ocorrer bem, a aplicação estara disponível localmente atravês da rota `http://localhost:8000/`
Se a porta `8000` estiver ocupada será informado uma nova rota para acesso.

#### SEEDER

Seguindo o passo 4 será inserido no banco de dados as seguintes informações

- USUÁRIOS (2 registros)
    Serão inseridos dois usuários base, um com todas as verificações e outro com a necessidade de validar o email

| nome | email | senha | observação |
|-------|------|------|-----|
| Admin| admin@gmail.com | 123456| Acesso total a todas as funcionalidades |
| John Doe | john_doe@gmail.com  | 123456 | Acesso restrito, necessário válidação do email |

Também será criado as categorias base e alguns registros de pontos de coleta que serão renderizados na home page do projeto para visualização.
        
---

## ROTAS

A seguir esta as rotas disponiveis pelo projeto, para um melhor contexto aqui esta uma breve explicação dos middlewares.

auth: Usuários logados
verified: Contas que válidas(validação via email)
password.confirm: para acessar é necessário inserir a senha do usuário

### ROTAS PÚBLICAS

| Método | Rota    | Nome (alias) | Controller / Ação | Descrição                                     | Middlewares |
|--------|---------|--------------|-------------------|-----------------------------------------------|-------------|
| GET    | /       | –            | (Closure)         | Verifica conexão com o BD e redireciona login ou erro | Nenhum     |
| GET    | /notes  | notes        | (Closure)         | Exibe view de notas                            | Nenhum     |


### ROTAS AUTENTICADAS (auth)

| Método | Rota                  | Nome (alias)             | Controller / Ação              | Descrição                                           | Middlewares          |
|--------|-----------------------|--------------------------|-------------------------------|-----------------------------------------------------|----------------------|
| GET    | /home                 | home                     | MainController@index           | Página inicial do sistema após login                | auth                 |
| GET    | /ponto-de-coleta/{id} | collection_point.view    | MainController@view            | Exibe detalhes de um ponto de coleta específico     | auth                 |
| GET    | /perfil/{id}          | user.profile             | MainController@profile         | Exibe perfil do usuário                              | auth                 |

### ROTAS AUTENTICADAS E VERIFICADAS (auth + verified)

| Método | Rota                | Nome (alias)           | Controller / Ação               | Descrição                                         | Middlewares          |
|--------|---------------------|------------------------|-------------------------------|---------------------------------------------------|----------------------|
| GET    | /ponto-de-coleta    | collection_point.index | MainController@collectionPoint | Lista todos os pontos de coleta                    | auth, verified       |
| GET    | /mapa               | map                    | MainController@map             | Exibe mapa com pontos de coleta                    | auth, verified       |
| POST   | /ponto-de-coleta    | collection_point.store | CollectionPointController@store | Cadastra um novo ponto de coleta                   | auth, verified       |


### ROTAS DE AÇÃO DO USUÁRIO (auth + verified + password.confirm)

| Método | Rota                  | Nome (alias)           | Controller / Ação               | Descrição                                          | Middlewares                    |
|--------|-----------------------|------------------------|-------------------------------|----------------------------------------------------|-------------------------------|
| PUT    | /user/{id}            | user.update            | UserController@update          | Atualiza dados do usuário                           | auth, verified, password.confirm |
| DELETE | /user/{id}            | user.destroy           | UserController@destroy         | Apaga conta do usuário                              | auth, verified, password.confirm |


### ROTAS DE AÇÃO DOS PONTOS DE COLETA (auth + verified + password.confirm)

| Método | Rota                  | Nome (alias)             | Controller / Ação               | Descrição                                          | Middlewares                    |
|--------|-----------------------|--------------------------|-------------------------------|----------------------------------------------------|-------------------------------|
| PUT    | /ponto-de-coleta/{id} | collection_point.update  | CollectionPointController@update | Atualiza dados de ponto de coleta                   | auth, verified, password.confirm |
| DELETE | /ponto-de-coleta/{id} | collection_point.destroy | CollectionPointController@destroy | Remove ponto de coleta                              | auth, verified, password.confirm |

---

## OBSERVABILIDADE
Com o crescimento do projeto e aumento de métodos que podem lançar exceções, é necessário pensar em implementar soluções para se preparar e entender que problemas estão acontecendo no código sem que isso fique exposto para os usuários. 

Imagine que deu um erro em uma chamada interna de serviços e que a mensagem de erro traga alguma informação sensível sobre o sistema, seria um erro terrível de observabilidade e arquitetura do sistema.

Para isso, em métodos que podem lançar exceções (principalmente uso de Models) foi implementado um *handler* para fazer o `Log` dos erros e mensagens genéricas para o usuário, e junto disso um envio automático de um *email* onde hipoteticamente iria para o responsável do sistema(no caso eu) as informações do erro.

Para garantir o fluxo de informações, acabei por criar uma camada de Service da qual sempre irá logar tanto o erro quanto o envio do email se foi enviado com sucesso ou caso tenha dado algum problema. Em ambos os casos o `Log` acontece ao mesmo tempo. 

###### TRATAMENTO DE EXCEÇÔES
Um dos pontos essenciais para que um projeto não tenha encerramentos repentinos em seu fluxo, é o tratamento de exceções durante o desenvolvimento.

Com o uso de blocos `try-catch` em operações que podem lidar com exceções como o uso de pacotes, comunicação com serviços externos e comunicação com o banco de dados, a ocorrência de erros não cause quebras no sistema, apenas retorna para o usuário mensagens genéricas e retorno para páginas anteriores. 

Enquanto isso os erros são guardados em arquivos de logs usando um canal personalizado para o projeto.

Para erros críticos em funcionalidades essenciais como um erro de conexão de banco de dados, além deo `Log` implementei um handler com o envio de email para no momento em que algum problema acontecer o tempo de reação seja o rápido possível.

###### COMO FUNCIONA ? 

Ao ser lançado uma exceção do tipo `QueryException` será interpretada como um erro de conexão com o banco de dados que deve ser verificado o quanto antes, com isso é chamado a `Facade` de envio de emails do laravel, executa o envio de email. 

Caso aconteça de o envio de email também falhar, é logado junto do erro crítico uma mensagem informando que o email não foi enviado.

Se não acontecer e ocorrer tudo bem também é guardado uma mensagem informando que o email foi enviado com sucesso.

## ENTIDADES E BANCO DE DADOS
O uso de um banco de dados relacional como o *MySQL* parece uma escolha certa quando vou pensar no escopo do projeto, estrutura de dados fixos e relacionamentos entre entidades trazem muitos benefícios com a estrutura do projeto, a partir do momento em que as informações que vão ser utilizadas são fixas e possuem relacionamentos com um certo nivel de complexidade.

Com isso o uso de um banco de dados relacional se mostra uma ótima escolha, seja por estrutura ou por escalabilidade.

#### ESTRUTURA DAS TABELAS

1. Tabela `users` (Usuários)

| Campo                        | Tipo                    | Observações                      |
| ---------------------------- | ----------------------- | -------------------------------- |
| id                           | bigint (auto-increment) | Chave primária                      |
| name                         | string(100)             | –                                |
| email                        | string(100)             | Valor único                         |
| email\_verified\_at          | timestamp               | opcional                       |
| password                     | string(200)             | –                                |
| two\_factor\_secret          | text                    | opcional                       |
| two\_factor\_recovery\_codes | text                    | opcional                       |
| two\_factor\_confirmed\_at   | timestamp               | opcional                       |
| remember\_token              | string (100)            | Token de sessão automática       |
| created\_at                  | timestamp               |            |
| updated\_at                  | timestamp               | –                                |
| deleted\_at                  | timestamp               |  |

2. Tabela `password_reset_tokens` - `Fortify`

| Campo       | Tipo      | Observações   |
| ----------- | --------- | ------------- |
| email       | string    | Chave primária |
| token       | string    | –             |
| created\_at | timestamp | opcional    |

3. Tabela `categories` (Categorias)

| Campo | Tipo                    | Observações |
| ----- | ----------------------- | ----------- |
| id    | bigint (auto-increment) | Chave primária |
| name  | string(30)              | Valor único    |

4. Tabela `collection_points` (Pontos de Coleta) 

| Campo        | Tipo                    | Observações                                       |
| ------------ | ----------------------- | ------------------------------------------------- |
| id           | bigint (auto-increment) | Chave primária                                       |
| name         | string(60)              | Valor único                                          |
| cep          | string(8)               | –                                                 |
| score        | integer                 |                                       |
| user\_id     | foreignId               | ID do usuário que registrou |
| street       | string                  | –                                                 |
| number       | string                  | opcional                                        |
| complement   | string                  | opcional                                        |
| neighborhood | string                  | –                                                 |
| city         | string                  | –                                                 |
| state        | string(2)               | –                                                 |
| latitude     | decimal(10, 7)          | opcional                                        |
| longitude    | decimal(10, 7)          | opcional                                        |
| open\_from   | time                    | Horário de abertura                               |
| open\_to     | time                    | Horário de fechamento                             |
| days\_open   | string                  | Dias de funcionamento (ex: seg-sex)               |
| description  | text                    | opcional                                        |
| created\_at  | timestamp               |                                     |
| updated\_at  | timestamp               | –                                                 |
| deleted\_at  | timestamp               |                   |

5. Tabela Pivô `collection_point_category`

| Campo                 | Tipo                    | Observações                                                   |
| --------------------- | ----------------------- | ------------------------------------------------------------- |
| id                    | bigint (auto-increment) | Chave primária                                                   |
| collection\_point\_id | foreignId               | ID do ponto de coleta |
| category\_id          | foreignId               | ID da categoria        |

###### RELACIONAMENTOS
Explicação sobre os relacionamentos entre as tabelas

*users 1 ------ n collection_points*
*(OneToMany)*

Relacionamento de um para muitos, um usuário pode ter vários pontos de coleta registrados, e um ponto de coleta tem apenas um usuário como "dono".

*collection_points n ------ n categories* 
*(ManyToMany)*

Relacionamento muitos para muitos, onde um ponto de coleta pode estar relacionado a diversas categorias, e uma categoria pode estar ligada com vários pontos de coleta. 

Neste caso foi necessário a criação de uma tabela pivô para o gerenciamento entre este relacionamento. 


<!-- 
❌
💡
⚠️
 -->