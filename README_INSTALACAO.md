# MetaAgenda — Guia de Instalação

## Pré-requisitos
- PHP 8.2+
- MySQL 8+
- Composer
- Node.js (opcional, apenas se quiser compilar assets)

## Passo a Passo

### 1. Configurar o banco de dados
Crie o banco no MySQL:
```sql
CREATE DATABASE meta_agenda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Configurar o .env
Edite o arquivo `.env` com seus dados:
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=meta_agenda
DB_USERNAME=root
DB_PASSWORD=sua_senha_aqui
```

### 3. Instalar dependências
```bash
composer install
```

### 4. Gerar chave da aplicação
```bash
php artisan key:generate
```

### 5. Executar migrations + seeders
```bash
php artisan migrate --seed
```

### 6. Iniciar o servidor
```bash
php artisan serve
```

Acesse: http://localhost:8000

---

## Credenciais de Acesso

### Administrador (Coordenador com is_admin=true)
- **URL:** http://localhost:8000/login/coordenador
- **CPF:** `03395672280`
- **Senha:** `123456`

### Coordenador Normal
- **URL:** http://localhost:8000/login/coordenador
- **CPF:** `12345678900`
- **Senha:** `123456`

### Aluno (sem senha, só matrícula)
- **URL:** http://localhost:8000/aluno
- **Matrícula:** `2024001` (criada pelo seeder)

### Professor (sem senha, só CPF)
- **URL:** http://localhost:8000/professor
- **CPF do professor criado pelo seeder** (ver tabela professores)

---

## Estrutura de Perfis

| Perfil | Acesso |
|--------|--------|
| Administrador (`is_admin=true`) | Gerencia cursos e coordenadores |
| Coordenador | Gerencia tudo acadêmico (turmas, alocações, etc.) |
| Professor | Consulta horários pelo CPF |
| Aluno | Consulta horários pela matrícula |

---

## Funcionalidades Implementadas

✅ Login/Logout coordenador e admin  
✅ Dashboard admin com CRUD de cursos e coordenadores  
✅ Dashboard coordenador com estatísticas  
✅ CRUD completo: turmas, professores, alunos, disciplinas, salas  
✅ Criação de alocações com múltiplas turmas  
✅ Verificação de conflitos de horário (professor, sala, turma)  
✅ Envio de notificações por turma  
✅ Dashboard do aluno (consulta por matrícula)  
✅ Dashboard do professor (consulta por CPF)  
✅ Proteção de rotas admin com middleware  
✅ Separação de permissões por cursos vinculados  
