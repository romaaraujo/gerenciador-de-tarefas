## API Gerenciador de Tarefas - Laravel

<h2>Modelos</h3>
<hr/>
<h3 dir="auto">Tarefa</h3>
<table>
  <thead>
    <tr>
      <th>Dado</th>
      <th>Descrição</th>
      <th>Valor padrão</th>
      <th>Obrigatório</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>id</td>
      <td>ID da tarefa. Pode ser incremental ou UUID.</td>
      <td>Automático (UUID ou AUTOINCREMENT)</td>
      <td>SIM</td>
    </tr>
    <tr>
      <td>name</td>
      <td>Nome da tarefa.</td>
      <td>Não possui valor padrão.</td>
      <td>SIM</td>
    </tr>
    <tr>
      <td>description</td>
      <td>Descrição da tarefa.</td>
      <td>Não possui valor padrão.</td>
      <td>NÃO</td>
    </tr>
    <tr>
      <td>status</td>
      <td>Status da tarefa. Pode ter os valores <i>backlog</i>, <i>in_progress</i>, <i>waiting_customer_approval</i>, <i>approved</i>.</td>
      <td><i>backlog</i></td>
      <td>SIM</td>
    </tr>
    <tr>
      <td>file_url</td>
      <td>Link com material aprovado pelo cliente (dado fictício).</td>
      <td>Não possui valor padrão.</td>
      <td>SIM</td>
    </tr>
    <tr>
      <td>created_at</td>
      <td>Data da criação do registro.</td>
      <td>NOW()</td>
      <td>NÃO</td>
    </tr>
    <tr>
      <td>updated_at</td>
      <td>Data da última atualização do registro.</td>
      <td>NOW()</td>
      <td>NÃO</td>
    </tr>
  </tbody>
</table>
<h3 dir="auto">Tags das tarefas</h3>
<table>
  <thead>
    <tr>
      <th>Dado</th>
      <th>Descrição</th>
      <th>Valor padrão</th>
      <th>Obrigatório</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>id</td>
      <td>ID do registro. Pode ser incremental ou UUID.</td>
      <td>Automático (UUID ou AUTOINCREMENT)</td>
      <td>SIM</td>
    </tr>
    <tr>
      <td>tag_name</td>
      <td>Nome da tag.</td>
      <td>Não possui valor padrão.</td>
      <td>SIM</td>
    </tr>
    <tr>
      <td>task_id</td>
      <td>ID da tarefa.</td>
      <td>Não possui valor padrão.</td>
      <td>SIM</td>
    </tr>
    <tr>
      <td>created_at</td>
      <td>Data da criação do registro.</td>
      <td>NOW()</td>
      <td>NÃO</td>
    </tr>
    <tr>
      <td>updated_at</td>
      <td>Data da última atualização do registro.</td>
      <td>NOW()</td>
      <td>NÃO</td>
    </tr>
  </tbody>
</table>

<h2>Ambiente</h2>
<hr/>
<h3>Docker</h3>
```bash
# Renomeie .env.example para .env
# Execute o comando na raiz do projeto

$ docker-compose up -d
```
<h3>Servidor Embutido PHP</h3>
```bash
# Renomeie .env.example para .env
# Execute os comandos a seguir na raiz do projeto
# Lembre-se de configurar o  banco de dados e editar o .env

$ composer install

$ php artisan migrate

# Você pode popular o modelo Task, se preferir
$ php artisan db:seed

$ php artisan serve --port=8080
```

<h2>Teste</h2>
<hr/>

<h3>Unidade</h3>
```bash
# Execute o comando na raiz do projeto

$ vendor/bin/phpunit
```

<h2>Rotas</h2>
<hr/>

- ```/task [POST]:``` - Rota para cadastrar uma tarefa.
- ```/task/:id [PUT]:``` - Rota para editar uma tarefa.
- ```/task/:id/status [PATCH]:``` - Rota para alterar o status de uma tarefa.
- ```/task/:id/tag [POST]:``` - Rota para criar e adicionar uma tag para uma tarefa.
- ```/task [GET]:``` - Rota para listar todas as tarefas.
- ```/task/:id/file_url [GET]:``` - Rota para devolver o link com o material aprovado pelo cliente.

<hr/>

Um arquivo de importação do Postman Collection (```Desafio PHP.postman_collection.json```) também foi disponibilizado na pasta do projeto para maior facilidade nos testes e consumos da API.