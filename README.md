# Top 100 Instagram Brasil

Ranking dos 100 perfis do Instagram com mais seguidores no Brasil. Site com foco em SEO orgânico, tráfego diário e painel administrativo para gerenciar os dados.

**URL local:** http://top100instagram.test  
**Stack:** Laravel 12 · MySQL 8 · Tailwind CSS (CDN) · Alpine.js (CDN)

---

## Funcionalidades

- Ranking completo dos 100 perfis com mais seguidores
- Filtro por categoria (Atleta, Músico, Influencer, etc.)
- Páginas individuais por perfil com histórico de posições
- Páginas por categoria
- Painel admin com CRUD completo e importação CSV
- SEO: meta tags, JSON-LD, sitemap.xml, robots.txt, canonical
- AI-friendly: llms.txt, estrutura semântica

---

## Requisitos

- PHP 8.2+ com extensões: mbstring, pdo_mysql, openssl, fileinfo, intl, curl
- MySQL 8.0+
- Composer 2.x

---

## Instalação

```bash
# 1. Instalar dependências
composer install

# 2. Copiar e configurar .env
cp .env.example .env
php artisan key:generate

# 3. Configurar banco de dados no .env
# DB_DATABASE=top100instagram
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Criar banco e executar migrations + seeders
php artisan migrate --seed
```

---

## Banco de Dados

| Tabela | Descrição |
|--------|-----------|
| `categories` | Categorias (Atleta, Músico, etc.) |
| `instagram_profiles` | Perfis do ranking com métricas |
| `ranking_histories` | Histórico de posições por data |
| `admin_users` | Usuários do painel administrativo |

---

## Acesso Admin

Após rodar os seeders:

- **URL:** `/admin`
- **Email:** `admin@top100.com.br`
- **Senha:** `password`

---

## Rotas Principais

| Rota | Descrição |
|------|-----------|
| `/` | Homepage com ranking completo |
| `/perfil/{username}` | Página individual do perfil |
| `/categoria/{slug}` | Ranking por categoria |
| `/sobre` | Sobre o projeto e metodologia |
| `/sitemap.xml` | Sitemap dinâmico |
| `/robots.txt` | Robots.txt |
| `/admin` | Painel administrativo |

---

## Importação CSV

No painel admin, é possível importar perfis em lote via CSV com as colunas:

```
rank,username,full_name,bio,followers_count,following_count,posts_count,avatar_url,is_verified,category,rank_change
```

---

## Estrutura do Projeto

```
app/
  Http/Controllers/        # Controllers públicos e admin
  Http/Middleware/         # AdminAuth middleware
  Models/                  # InstagramProfile, Category, RankingHistory, AdminUser
database/
  migrations/              # 4 migrations
  seeders/                 # CategorySeeder, InstagramProfileSeeder, AdminUserSeeder
resources/views/
  layouts/                 # app.blade.php, admin.blade.php
  home.blade.php
  profile/show.blade.php
  category/show.blade.php
  about.blade.php
  admin/                   # Dashboard, CRUD de perfis e categorias
public/
  llms.txt                 # Descrição para crawlers de IA
```

---

## SEO & Dados Estruturados

- **JSON-LD** em todas as páginas: ItemList, Person, BreadcrumbList, FAQPage
- **Open Graph** e **Twitter Card** em todas as páginas
- **Sitemap.xml** dinâmico com todos os perfis
- **robots.txt** bloqueando /admin
- **llms.txt** descrevendo o conteúdo para LLMs

---

## Licença

MIT
