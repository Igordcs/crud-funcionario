# CRUD de Funcionários

Este projeto é um sistema CRUD (Create, Read, Update, Delete) para gerenciamento de funcionários, desenvolvido em PHP com Laravel, utilizando o Breeze para autenticação e Tailwind para estilização.

---

## Requisitos

- PHP >= 8.x
- Composer
- SQLITE
- VITE
- TAILWIND

---

## Instalação

- Instale as dependências: 
```bash
  composer install
  npm run dev
```
- Copie o .env.example e altere pra .env

## Configuração do banco
- Crie um arquivo database.sqlite na pasta "/database"
- Execute os comando:
```bash
  php artisan migrate:fresh
  php artisan db:seed
```

## Senha de ADMIN
Caso tenha executado o comando:
```bash
  php artisan db:seed
```
O script vai gerar uma conta padrão:

- Email: admin@admin.com
- Senha: 123456

## Rodar o servidor

Caso consiga rodar bash, execute esse comando:
```bash
  ./start.sh
```
Senão, execute esses comandos:
```bash
  npm run dev
  php artisan serve
```
