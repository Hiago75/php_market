Para fazer a inicialização do projeto temos passos individuais para cada parte.

API:

- Acessar o arquivo de configuração, `config.php`, presente diretamente na pasta `api` substituir os valores com os dados de acesso da sua base de dados.
- No terminal, acessar o diretório `api/public_html` e rodar o comando `php -S localhost:8080 router.php`.
- Os testes podem ser rodados usando o comando `./vendor/bin/phpunit` dentro do diretório da API. Os devem ser rodados com o servidor já rodando para que os testes do servidor passem

Front-end:

- No terminal, acessar o diretório `frontend` e rodar o comando `npm install` (ou `yarn`).
- No mesmo diretório, rodar o comando `npx serve -s build`.
- Os testes podem ser rodados usando o comando `npm run test` ou `yarn test`.

Como foi solicitado, o build foi enviado em conjunto e sendo assim vai ser iniciado diretamente.
O dump está como `db.sql` na raiz do projeto.

Caso não tenha o PostgresSQL instalado no computador, deixei um docker-compose que usei durante o desenvolvimento. Para usa-lo basta usar o comando `docker-compose up -d`. Ele já possui uma base de dados que vai ser construida em conjunto com o container e que possui alguns dados populando a mesma.
