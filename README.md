#  NPR - Laravel

Este projeto é uma reestruturação da aplicação **NPR**, originalmente desenvolvida com **React** e **Node.js**, agora recriada com **Laravel** como parte de um estudo focado no uso do framework, especialmente com **Laravel Fortify** para autenticação.

---

## 📚 Sobre o Projeto

A aplicação **NPR (Natureza Prioridade Renovada)** tem como objetivo auxiliar na **coleta de lixo reciclável** e **combater o descarte irregular de resíduos**, promovendo um ambiente digital para **registrar e localizar pontos de coleta**.

---

## 🎯 Objetivos

- Recriar o projeto NPR com **Laravel Blade**.
- Estudar o uso de **Laravel Fortify** como sistema de autenticação.
- Praticar **estruturação de rotas, models, controllers e views**.


---

## 🔧 Tecnologias Utilizadas

- **Laravel 11**
- **Laravel Fortify** – autenticação
- **Bootstrap 5** – estilização
<!-- - **MySQL** (opcional) – usado para testes com banco separado (notas) -->
- **Blade Templates**

---

## 🚧 Status

🟢 **Em desenvolvimento** – este projeto está em constante evolução e serve como base de estudo. Algumas funcionalidades podem ser simplificadas ou descartadas propositalmente para manter o foco no aprendizado.

---

## 📁 Instalação (opcional)

Se desejar rodar o projeto localmente:

```bash
git clone https://github.com/seu-usuario/npr-laravel.git
cd npr-laravel

# Instalar dependências
composer install

# Criar arquivo .env e configurar o banco
cp .env.example .env

# Rodar migrations junto dos seeders
php artisan migrate --seed

# Iniciar servidor de desenvolvimento local
php artisan server

```

---

## Seeders

Após realizar as etapas acima, já serão inseridos alguns registros no banco de dados para utilizar a aplicação.
Alguns usuários para login e outras informações como categorias e pontos de coleta.

```bash
# usuarios 

name: 'Admin'
email: 'admin@gmail.com'
password: '123456'

name: 'John Doe'
email: 'john_doe@gmail.com'
password: '123456'


```