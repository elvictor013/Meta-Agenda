# MetaAgenda — README de Instalação

## Tecnologias Utilizadas
- PHP 8.2 / Laravel 11
- MySQL 8 (via XAMPP)
- Tailwind CSS, Material Symbols, JavaScript

---

## Pré-requisitos

- [XAMPP](https://www.apachefriends.org/) instalado
- [Composer](https://getcomposer.org/) instalado
- Terminal (CMD, PowerShell ou Git Bash)

---

## Passo a Passo

### 1. Clonar ou extrair o projeto

Coloque a pasta do projeto dentro de:
```
C:/xampp/htdocs/Meta-Agenda
```

---

### 2. Iniciar o XAMPP

Abra o **XAMPP Control Panel** e inicie:
- ✅ Apache
- ✅ MySQL

---

### 3. Criar o banco de dados

Acesse [http://localhost/phpmyadmin](http://localhost/phpmyadmin) e execute:
```sql
CREATE DATABASE meta_agenda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### 4. Configurar o `.env`

Na pasta do projeto, abra o arquivo `.env` e ajuste:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=meta_agenda
DB_USERNAME=root
DB_PASSWORD=
```
> Se você definiu senha no MySQL do XAMPP, preencha em `DB_PASSWORD`.

---

### 5. Instalar dependências

Abra o terminal na pasta do projeto e rode:
```bash
composer install
```

---

### 6. Gerar a chave da aplicação

```bash
php artisan key:generate
```

---

### 7. Executar as migrations e seeders

```bash
php artisan migrate --seed
```

> Isso cria todas as tabelas e popula com dados de teste.

---

### 8. Iniciar o servidor

```bash
php artisan serve
```

Acesse no navegador: [http://localhost:8000](http://localhost:8000)

---

## Credenciais de Teste

### Administrador
| Campo | Valor |
|-------|-------|
| URL | http://localhost:8000/login/coordenador |
| CPF | `03395672280` |
| Senha | `123456` |

### Coordenador
| Campo | Valor |
|-------|-------|
| URL | http://localhost:8000/login/coordenador |
| CPF | `12345678900` |
| Senha | `123456` |

### Aluno
| Campo | Valor |
|-------|-------|
| URL | http://localhost:8000/aluno |
| Matrícula | `2024001` |

### Professor
| Campo | Valor |
|-------|-------|
| URL | http://localhost:8000/professor |
| CPF | CPF cadastrado pelo seeder (ver tabela `professores` no phpMyAdmin) |

---

## Fluxo de Teste Recomendado

1. **Admin** — acesse, crie um curso e um coordenador, vincule-os
2. **Coordenador** — acesse, crie turmas, disciplinas, professores, salas e alocações
3. **Aluno** — acesse com a matrícula e veja o cronograma da turma
4. **Professor** — acesse com o CPF e veja a grade semanal

---

## Problemas Comuns

**Erro de permissão no storage:**
```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

**Página em branco:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

**Erro de chave:**
```bash
php artisan key:generate
```