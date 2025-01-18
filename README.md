# Como rodar na sua máquina:

1. Clone o repositório na sua máquina
2. Dentro do diretório do projeto faça uma copia do arquivo `.env.example` e renomeie para `.env`
3. Dentro do arquivo `.env` substitua os valores de `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`,`PUSHER_APP_ID`, `PUSHER_APP_KEY`, `PUSHER_APP_SECRET` e `PUSHER_APP_CLUSTER` de modo que entre de acordo com seu banco de dados e suas credenciais do PUSHER
4. No terminal, dentro do diretório do projeto execute o comando para baixar todas as dependências:
   ```   
    composer install
   ```
5. Gere a chave da aplicação:
   ```
    php artisan key:generate
   ```

6. Execute as migrações:
    ```
    php artisan migrate
    ```
7. Inicie o servidor local:
    ```
    php artisan serve --port=8000
    ```
8. Agora basta acessar o sistema em: `localhost:8000`

## Rotas da API
Enquetes
   ```
       GET / -> Lista todas as enquetes
       GET /poll/create -> Exibe o formulário de criação de enquete
       POST /poll -> Armazena uma enquete e suas opções
       GET /poll/{id}/edit -> Exibe o formulario de edição de uma enquete especificado pelo ID
       PUT /poll/{id} -> Atualiza uma enquete e suas opções
       GET /poll/{id} -> Exibe uma enquete (e opções) especificado pelo ID
       DELETE /poll/{id} -> Remove um registro de uma enquete e suas opções especificado pelo ID
       POST /poll/{id}/vote -> Atualiza o registro de votos de uma opção de enquete e ativa o evento de atualização de votos para o PUSHER
   ```
