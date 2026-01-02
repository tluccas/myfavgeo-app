# 🗺️ MyFavGeo - Frontend

![Next.js](https://img.shields.io/badge/Next.js-000000?style=for-the-badge&logo=next.js&logoColor=white)
![React](https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB)
![TypeScript](https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Leaflet](https://img.shields.io/badge/Leaflet-199900?style=for-the-badge&logo=leaflet&logoColor=white)

Interface moderna e responsiva para o ecossistema MyFavGeo, construída com **Next.js 14 (App Router)**. Oferece uma experiência fluida e confortável para criação de mapas e gerenciamento de pontos de interesse.

---

## ✨ Funcionalidades Principais

- **Mapas Interativos:** Integração com **Leaflet** para visualização e manipulação de mapas.
- **Autenticação Segura:** Login e Registro integrados com a API Laravel (JWT via HttpOnly Cookies).
- **Design Responsivo:** Interface construída com **Tailwind CSS** e componentes **Shadcn/ui**.
- **Gerenciamento de Estado:** Uso eficiente de Server Components e Client Components.

---

## 🚀 Como Rodar

### Via Docker (Recomendado)

O frontend sobe automaticamente junto com o backend via Docker Compose na raiz do projeto.

```bash
# Na raiz do projeto (MyFavGeo-App)
docker-compose up
```

Acesse: [http://localhost:3000](http://localhost:3000)

### Localmente (Desenvolvimento)

Caso queira rodar fora do Docker:

```bash
# Instalar dependências
npm install

# Rodar servidor de desenvolvimento
npm run dev
```

---

## 📂 Estrutura do Projeto

- **`app/`**: Rotas e páginas da aplicação (App Router).
  - `(auth)/`: Rotas de Login e Registro.
  - `mapas/`: Dashboard e visualização de mapas.
- **`components/`**: Componentes reutilizáveis (Botões, Inputs, Mapas).
- **`lib/`**: Utilitários, configurações de API (Axios) e definições de tipos.
- **`public/`**: Assets estáticos (imagens, ícones).

---

## 🔧 Configuração de Ambiente

O arquivo `.env.local` (ou variáveis de ambiente do Docker) deve apontar para a API Backend:

```env
NEXT_PUBLIC_API_URL=http://localhost:8000/api
```

> [!NOTE]
> Atualmente já está tudo configurado para rodar perfeitamente com `docker-compose up`, apenas clone e execute ;)
