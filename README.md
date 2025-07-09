# NPR | Laravel


Este projeto é uma aplicação web com foco no auxílio as questões ambienteis, com o objetivo de facilitar o compartilhamento de informações até a localização sobre pontos de coleta de diversos tipos de materiais. 

Acredito que seja um bom projeto para implementar e aprofundar meus conhecimentos no **Laravel** de maneira a testar meu conhecimento nas suas funcionalidades essenciais e recursos extras.
## 📑 Sumário

- [Tecnologias](#tecnologias-implementadas)
- [Operações de Usuário](#operações-das-entidades-do-sistema)
- [Pontos de Coleta](#pontos-de-coleta)
- [Níveis de Acesso](#níveis-de-acesso)
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
Está opção está disponível na página de perfil do usuário, onde será encontrada em um botão cuja rota seguira para as operações necessárias para apagar a conta.

A operação está protegida por um *middleware* que solicita a senha atual do perfil para garantir que seja uma operação válida.
 
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
> O formúlario disponibiliza um autopreencher das informações com o CEP fornecido, onde após o preenchimento do campo, será buscado as informações a partir da *api* da [ViaCEP](https://viacep.com.br/)

Após preencher e realizar o envio, o sistema irá validar as informações usando a classe `Requests/CollectionPoint/StoreRequest` para realizar a verificação dos campos com base em regras especificas para cada campo, caso não tenha problemas seguira o fluxo até o `CollectionPointController` para realizar a inserção no banco de dados.

Neste ponto, será válidade primeiro se os hórarios de funcionamento são coerentes, evitando assim que um horário de abertura seja maior que o hórario de fechamento 

**Exemplo:** Se o local abre as 12:00 e fecha as 06:00 não será uma informação válida para o sistema e irá retornar para a página de cadastro com um aviso.

Após isso, o `array` de informações sobre os dias da semana que abre, será formatado como string.

O CEP irá ser formatado para remover a pontuação.

Após isso é realizado o registro das informações no banco de dados na entidade `collection_points` e após isso com base nas informações das categorias será registrado na tabela pivô entre os pontos de coleta e as categorias suas respectivas categorias.
>⚠️ *Aviso sobre permissões* <br>
>Somente usuários que validaram sua conta atrâves da verificação por email podem reaalizar realizar está tarefa 

#### APAGAR PONTO DE COLETA
Para apagar um ponto de coleta o usuário deve estar na página de visualização do ponto e deve ser o **mesmo usuário que cadastrou o ponto de coleta**, caso contrário nenhuma opção sera mostrada.

O mesmo se aplica a questão de *Editar* as informações do ponto de coleta

#### EDITAR INFORMAÇÕES DO PONTO DE COLETA
A alteração de informações de um ponto de coleta está disponivel a partir de um modal com um formúlario com as informações atuais do ponto de coleta, onde **somente o usuário que registrou o ponto de coleta** terá acesso a estas informações e funcionalidades.

O mesmo se aplica a questão de *Apagar* um ponto de coleta do banco de dados.

---
## NÍVEIS DE ACESSO
O projeto está disponivel a partir de 3 níveis de acesso, sendo eles:
 *guest*, *usuário* e *usuário verificado* 

#### GUEST
Usuário não logado, acesso restrito as funcionalidades básicas, sendo necessário realizar *Login* para acessar qualquer rota da aplicação.

>*Nota*
> Não acredito que sejá o ideal, pretendo mudar este modelo de permissões, um usuário não logado poderia no mínimo ver os pontos de coleta cadastrados para facilitar o compartilhamento destas informações.


#### USUÁRIO
Mesmo após criar uma conta e realizar o *Login* o usuário deve válidar sua conta atravês do link enviado para o seu *email* sem isso ele não pode cadastrar novos pontos de coletas.
Apesar disso ele pode acessar o restante das opções do projeto como as páginas de perfil e dos pontos de coleta já cadastrados.

#### USUÁRIO VERIFICADO
Após a validação do perfil atravês do link enviado para o *email* do usuário, ele terá total acesso às funcionalidades do projeto, podendo criar e editar novos pontos de coleta.


<!-- 
❌
💡
⚠️
 -->