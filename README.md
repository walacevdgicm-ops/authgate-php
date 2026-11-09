# AuthGate PHP

Cadastro, login e área restrita em PHP com MySQL. Foi o projeto que usei para estudar autenticação do jeito certo: senha com hash, consultas preparadas e controle de sessão.

![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white) ![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?logo=bootstrap&logoColor=white)

## O que tem

- Cadastro com nome, CPF, e-mail, senha e data de nascimento, com validação no servidor
- Senha salva com `password_hash()` e conferida com `password_verify()`
- PDO com prepared statements em todas as consultas
- Cadastro dentro de uma transação (usuário e sessão são gravados juntos)
- Aviso de e-mail ou CPF já cadastrado (erro 1062 do MySQL)
- Login com `session_regenerate_id()`, painel protegido e logout

## Rodando localmente

1. Copie a pasta para o `htdocs` do XAMPP
2. Rode o `schema.sql` no MySQL
3. Ajuste o `config.php` com o seu usuário, senha e nome do banco (os valores que estão lá são só de exemplo)
4. Acesse `http://localhost/authgate-php`

## Próximos passos

- Trocar o campo de senha do cadastro para `type="password"`
- Usar `type="text"` no CPF (com `type="number"` o zero da frente é perdido)
- Não mostrar a mensagem de erro do banco para o usuário no cadastro
- Adicionar token CSRF nos formulários

---
Walace Soares Vidigal Junior · Licença MIT
