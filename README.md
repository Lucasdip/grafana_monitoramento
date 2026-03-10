# 🚀 Agility Atendimento API

---

## 🏗️ Arquitetura do Sistema

O projeto utiliza uma **Arquitetura em Camadas (Layered Architecture)** para garantir escalabilidade e facilitar a manutenção:

* **Controllers:** Gerenciam a entrada e saída das requisições HTTP.
* **Services:** Centralizam a **Lógica de Negócio**, isolando regras complexas dos controllers.
* **Repositories:** Abstração da **Camada de Dados**, isolando as consultas ao banco de dados (Eloquent).
* **Requests:** Camada de validação de dados via FormRequests.
* **Enums:** Padronização de estados fixos (Status de protocolos e tipos).



---

## 🔐 Autenticação e Segurança

### Fluxo de Acesso
A API utiliza o **Laravel Sanctum**. Todas as rotas protegidas exigem o Header:
`Authorization: Bearer {seu_token}`

### Relatório de Vulnerabilidades Corrigidas (Março/2026)
O sistema foi auditado e atualizado para mitigar as seguintes falhas:
* **CVE-2025-64500:** Corrigido bypass de autorização no `symfony/http-foundation`.
* **CVE-2024-28859:** Migração concluída de `SwiftMailer` (abandonado) para `Symfony Mailer`.
* **CVE-2026-30838:** Proteção contra injeção de HTML no `league/commonmark`.

---

## 📡 Mapeamento de Endpoints

### 1. Autenticação (`AuthController`)
| Método | Endpoint | Proteção | Descrição |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/login` | Pública | Autentica e gera o token de acesso. |
| `POST` | `/api/refreshToken` | Token + Ability | Renova o token (Requer `refresh-token`). |
| `POST` | `/api/logout` | Token | Revoga o token atual e encerra sessão. |

### 2. Clientes e Parceiros
| Método | Endpoint | Descrição |
| :--- | :--- | :--- |
| `GET` | `/api/getInfoClient` | Retorna o perfil completo do cliente logado. |
| `GET` | `/api/getShopkeeper` | Retorna os lojistas vinculados ao acesso. |

### 3. Gestão de Protocolos (`ProtocolController`)
| Método | Endpoint | Descrição |
| :--- | :--- | :--- |
| `GET` | `/api/listCategoryProtocols` | Lista categorias (Suporte, Financeiro, etc). |
| `POST` | `/api/generateProtocol` | Registra um novo protocolo de atendimento. |
| `PUT` | `/api/editProtocol` | Atualiza status ou dados de um protocolo. |

### 4. Monitoramento
| Método | Endpoint | Descrição |
| :--- | :--- | :--- |
| `GET` | `/api/uptime` | Check de saúde do sistema (Sem rate-limit). |

---

## 📦 Exemplos de Uso (JSON)

### Criar Protocolo (`POST /api/generateProtocol`)
**Request Body:**
```json
{
  "category_id": 1,
  "description": "Dificuldade ao acessar o painel financeiro."
}
