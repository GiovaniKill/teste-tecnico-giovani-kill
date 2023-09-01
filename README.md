# Teste Técnico - Giovani Kill

Este é um teste técnico realizado para a empresa Gênesis.

## Rodando o Projeto

Siga os passos abaixo para executar o projeto localmente:

1. Clone o repositório:
`git clone git@github.com:GiovaniKill/teste-tecnico-giovani-kill.git`

2. Acesse o diretório do projeto:
`cd teste-tecnico-giovani-kill/`

3. Inicie os contêineres com Docker Compose:
`docker-compose up -d --build`
Caso algum container não funcione, use o seguinte comando para verificar o erro:
`docker logs <id-do-container>`

4. Defina as permissões corretas para o projeto:
`docker-compose exec php-apache chown -R www-data:www-data /var/www`

5. Acesse o terminal do contêiner php-apache:
`docker exec -it php-apache /bin/bash`

6. Dentro do contêiner, instale as dependências do Composer:
`composer install`

7. Em seguida, execute as migrações do banco de dados e preencha com dados iniciais:
`php artisan migrate --seed`

Após seguir esses passos, o site estará disponível em "http://localhost:8080".

## Criando um Novo Atendimento

Para criar um novo atendimento, siga estas etapas:

1. Vá para a seção "📋 Novo Atendimento".
2. Selecione um médico e uma data para verificar os horários disponíveis.
3. Clique em "Consultar Disponibilidade" , os horários disponíveis para aquele dia serão exibidos.
5. Você pode mudar o dia e/ou o médico na seção "Mudar Dia e/ou Médico".
6. Preencha os campos com os dados necessários.
7. Clique em "Marcar Atendimento".

Se houver algum erro com os dados, ele será exibido acima do formulário.

## Editando e Excluindo Atendimentos

- Para editar um atendimento, clique no botão "✍️" na coluna "Editar" na página principal.
O processo de preenchimento é similar ao de criar um novo atendimento.

- Para excluir um atendimento, clique no botão "❌" na coluna "Excluir".
