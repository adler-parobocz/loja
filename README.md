# Funcionamento

- Autenticação e controle de acesso (Não finalizado)
- Cadastro de produto (OK)
- Cadastro de atributos (OK)
- Estoque (Não finalizado)
- Desafios
  - Exibir valores em dolares através de uma api (Não finalizado)
  - Texto para inglês (Não finalizado)
  - Dashboard (Não finalizado)


# Configuração

- ter o mysql na máquina
- alterar o .env, nas variáveis

DB_DATABASE=store
DB_USERNAME=user
DB_PASSWORD=passwd

- Gerar os comandos:
- php artisan migrate
- php artisan serve --port 8003

- acessar
http://localhost:8003/

# O que foi feito até agora
- Atributos de produto
 Criado a estrutura para gerar o visualizar, editar, cadastrar e excluir
 - Models para interação entre os atributos e os produtos
 - Controllers para gerenciar as atividades

- Produtos
Criado a estrutura para gerar o visualizar, editar, cadastrar e excluir
 - Models para interação entre os atributos e os produtos
 - Controllers para gerenciar as atividades

 - Estoque
 Iniciado a construção, e em andamento