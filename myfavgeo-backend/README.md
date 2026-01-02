# 🐘 MyFavGeo - Backend API

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-000000?style=for-the-badge&logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![Swagger](https://img.shields.io/badge/-Swagger-%23Clojure?style=for-the-badge&logo=swagger&logoColor=white)

API REST desenvolvida em **Laravel 12** responsável por gerenciar toda a lógica de negócio, autenticação e persistência de dados do ecossistema MyFavGeo.

---

## 🏗️ Arquitetura e Padrões

O projeto segue uma arquitetura em **Camadas** com **DTOs** para garantir desacoplamento e testabilidade.

- **Controllers:** Seguindo padrões de projeto são responsáveis apenas por receber a requisição, validar (via FormRequest) e devolver a resposta (via Resource).
- **Services:** Concentram toda a regra de negócio (criação de mapas, lógica de pontos, transações de banco).
- **DTOs (Data Transfer Objects):** Objetos imutáveis para trafegar dados entre Controller e Service, evitando arrays associativos não tipados.
- **Policies:** Controle de acesso (Autorização) para garantir que usuários só mexam em seus próprios dados.

---

## 🧪 Testes Automatizados

A aplicação possui uma suíte de **Feature Tests** configurada para rodar em um banco **SQLite em memória**, garantindo velocidade e isolamento.

### Como rodar os testes

```bash
# Via Docker (Recomendado)
docker-compose exec backend php artisan test

# Localmente (se tiver PHP instalado)
php artisan test
```

**Cobertura:**

- Autenticação (Registro/Login)
- CRUD de Mapas
- CRUD de Pontos
- Segurança (Proteção contra IDOR)

---

## 📚 Documentação da API (Swagger)

A documentação interativa está disponível e é gerada automaticamente baseada nas anotações do código.

- **URL Local:** [http://localhost:8000/api/doc](http://localhost:8000/api/doc)
- **Arquivo JSON:** `storage/api-docs/api-docs.json`

Para regenerar a documentação após alterações:

```bash
php artisan l5-swagger:generate
```

---

## 🛠️ Comandos Úteis

```bash
# Rodar Migrations
php artisan migrate

# Rodar Seeders (Popula o banco)
php artisan db:seed

# Limpar Cache
php artisan optimize:clear

# Criar novo Controller
php artisan make:controller NomeController
```

**APENAS se for rodar localente sem docker:** Edite o arquivo `.env` e ajuste as configurações de banco de dados (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. **Gere a chave da aplicação:**

   ```bash
   php artisan key:generate
   ```

5. **Gere o segredo JWT:**

   ```bash
   php artisan jwt:secret
   ```

6. **Execute as migrações do banco de dados:**

   ```bash
   php artisan migrate
   ```

7. **Gere a documentação do Swagger:**
   ```bash
   php artisan l5-swagger:generate
   ```

## 🚀 Como Rodar

### Via Docker (Recomendado)

O frontend sobe automaticamente junto com o backend via Docker Compose com todas as variáveis de ambiente configuradas na raiz do projeto.

```bash
# Na raiz do projeto (MyFavGeo-App)
docker-compose up
```
### Localmente (Desenvolvimento)

Para iniciar o servidor de desenvolvimento:

```bash
php artisan serve
```

Ou, se preferir usar o servidor embutido do PHP (caso tenha problemas com o artisan serve):

```bash
php -S 127.0.0.1:8000 -t public
```

A API estará acessível em `http://127.0.0.1:8000`.

> [!NOTE]
> Atualmente já está tudo configurado para rodar perfeitamente com `docker-compose up`

## 📂 Estrutura do Projeto

- **app/DTOs**: Objetos de Transferência de Dados para padronizar a entrada/saída.
- **app/Services**: Contém a lógica de negócio (MapaService, PontoService, UserService).
- **app/Http/Controllers**: Controladores que lidam com as requisições HTTP.
- **app/Models**: Modelos Eloquent (Mapa, Ponto, User).
- **app/Policies**: Políticas de autorização (ex: verificar se o usuário é dono do mapa).

