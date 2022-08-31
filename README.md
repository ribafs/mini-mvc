# Mini MVC

## Aplicativo simples em PHP usando MVC com PDO e BootStrap

## Requisito

Precisa ter o Apache com mod_rewrite ativado para fundionar. Ou outro servidor web.
Não funciona com apenas o servidor web nativo do PHP.
Caso não tenha o apache rodando e com mod_rewuite ativo conseguirá abrir o index.php normalmente mas nenhum link funcionará.

## Continuando este projeto criei o
[simplest-mvc](simplest-mvc), que é um repositório onde desenvolvo uma aplicação em PHP, com MVC em 13 fases, da forma mais simples que conheço.

## Criar um aplicativo com a arquitetura MVC usando o mini3 
https://github.com/panique/mini3

## Este repositório

https://github.com/ribafs/mini-mvc

## Instalação

- Faça o download e descompacte para mini3
- Cope para seu diretório web e acesse a pasta mini3
- Execute

composer install

- Crie o banco de dados e o configure em 

Core/config.php

- Recomendado usar na primeira vez o script do raiz

db.sql

## Chame pelo navegador

http://localhost/minit


## Motivação

Por algum tempo eu tentei entender a arquitetura MVC de forma a poder criar um aplicativo com as pastas com controllers, models e views separadas e também as rotas. E então fiz diversas pesquisas e experimentei diversos pequenos aplicativos e mini frameworks. Usei grandes frameworks como CakePHP e Laravel que usam MVC e gostei de como implementam, especialmente o CakePHP, que faz isso de forma bem organinzada. Mas entender como eles usam é uma coisa e reproduzir em um aplicativo seu, criado do zero, é outra coisa bem diferente.

Recentemente encontrei um pequeno aplicativo que o autor (https://github.com/panique) chamou de mini3 e que tem uma estrutura MVC com rotas e o PSR-4 com composer e sem nenhuma dependência externa. Com este aplicativo eu consegui finalmente entender, mexer e extender o uso do MVC. 

## Alterações principais que fiz:

- Renomeei a pasta application para app e também no composer.json
- Renomeei os métodos nos Controllers, Models  views (exemplo):
    - addCliente - add
    - editCliente - edit
    - deleteCliente - delete
    - updateCliente - update
- Removi os métodos exampleOne e exampleTwo do HomeController e da respectiva view

## Recomendação

Como o autor alerta, o objetivo não é de tornar o mesmo seu framework de uso diário, mas apenas o de permitir um melhor entendimento do MVC. Para uso no dia a dia indica-se um dos grandes frameworks como CakePHP, Laravel ou outro.

## Faça o download
https://github.com/ribafs/mini-mvc

## Descompacte no diretório web
Exemplo: cadastro

## Crie o banco e importe o script do raiz ou use um banco existente.

## Execute o composer

Acessar a pasta cadastro e executar:
```bash
composer dump-autoload
```

## Configurar o banco
Configurar o banco em application/config/config.php

## Estrutura MVC

MVC é uma arquitetura de software, muito confundido com um padrão de projeto, cujo principal objetivo é separar o código de um aplicativo em 3 camadas: Model, View e Controller, assim deixando o código mais organizado e de fácil manutenção.

- Alguém clica no botão CLIENTES na view clientes/index, que chama o método com o mesmo nome, que é o index do controle cm o mesmo nome, Clientes
- Então o método index do ClientesController é chamado
- O método index do controller cria uma instância do model Cliente e através desta instância chama o  método getAllClientes do model Cliente
- O método getAllClientes do model faz uma consulta ao banco para que devolva todos os registros da tabela clientes, então retorna todos os clientes para o método index do ClientesController
- O método index então carrega a view clientes/index já com todos os registros de clientes

## Resumindo

View chama Controller, Controller passa apra o Model, Model devolve ao Controller e o Controller devolve para a View

## Veja trechos

Controller
```
class ClientesController
{
    /**
     * Action: index
     * Este método manipula o que acontece quando acessa http://localhost/clientes/index
     */
    public function index()
    {
        // Instanciar novo Model (Cliente)
        $Cliente = new Cliente();
        // receber todos os clientes e a quantidade de clientes
        $clientes = $Cliente->getAllClientes();// Esta propriedade é recebida na view: view/clientes/index.php em forma de array
        $amount_of_clientes = $Cliente->getAmountOfClientes(); // Esta propriedade também é recebida na view: view/clientes/index.php

       // Carregar views. Com as views nós podemos mostrar os $clientes e a $amount_of_clientes facilmente
        require APP . 'view/_templates/header.php';
        require APP . 'view/clientes/index.php';
        require APP . 'view/_templates/footer.php';
    }
```

Model
```
class Cliente extends Model
{
    /**
     * Get all clientes from database
     */
    public function getAllClientes()
    {
        $sql = "SELECT id, nome, email, data_nasc, cpf FROM clientes";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
```
View
```
        <h3>Lista de clientes (dados do model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Nascimento</td>
                <td>CPF</td>
                <td>Excluir</td>
                <td>Editar</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clientes as $cliente) { ?>
                <tr>
                    <td><?php if (isset($cliente->id)) echo htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->nome)) echo htmlspecialchars($cliente->nome, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->email)) echo htmlspecialchars($cliente->email, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->data_nasc)) echo htmlspecialchars($cliente->data_nasc, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->cpf)) echo htmlspecialchars($cliente->cpf, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'clientes/deletecliente/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>">Excluir</a></td>
                    <td><a href="<?php echo URL . 'clientes/editcliente/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>">Editar</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
```
## Classes básicas

Core/Application.php - interage com os Controllers para controlar as rotas, juntamente com os .htaccess do raiz e da pasta public
Core/Model.php - classe básica das classes Model


O MVC no framework CakePHP funciona de forma semelhante.

## Como adicionar um novo CRUD para outra tabela

- Adiciona a tabela no banco atual
- Adicione o model para esta tabela
- Adicione o controller
- Adicione a view para a tabela
- Adicione o link para a nova tabela em app/view/_templates/header.php

## Alguns recursos

- extremamente simples e fácil de entender
- estrutura simples e limpa
- Cria URLs limpas e "bonitas"
- Demo de actions de um CRUD: Create, Read, Update e Delete entradas de banco de dados facilmente
- demo de chamadas AJAX
- tenta seguir as diretrizes de codificação do PSR
- usa PDO para qualquer solicitação de banco de dados, vem com uma ferramenta de depuração PDO adicional para emular suas instruções SQL
- código comentado
- usa apenas código PHP nativo, portanto você não precisa aprender um framework para entender MVC
- usa o autoloader do PSR-4 com composer

## Requisitos

- PHP 5.6 ou PHP 7.0
- MySQL
- mod_rewrite habilitado
- conhecimento básico do Composer

## Segurança

O script usa o mod_rewrite e bloqueia todo o acesso de fora da pasta/public.
Sua pasta/arquivos.git, arquivos temporários do sistema operacional, a pasta do aplicativo e tudo o mais não está acessível (quando configurado corretamente). Para solicitações de banco de dados, o PDO é usado, portanto, não é necessário se preocupar com injeção de SQL.

## PSR-4

Como usa-se o PSR-4 então não precisamos ficar incluindo os arquivos com
include ou require pois as classes em application/Model são automaticamente incluidas e basta usar:

use Mini\Model\Cliente;

Por exemplo, como é feito em application/Controller/ClientesController.php, na linha 10, mas antes adicionando
namespace Mini\Controller;
Logo na primeira linha do arquivo, abaixo de <?php

## Recurso Extra
Usa o software https://github.com/panique/pdo-debug para melhorar as mensagens de erro do PDO.

## Roteamento - URL traduzem para controllers

http://localhost/cadastro   - abre o controller default, que é o Home
http://localhost/cadastro/clientes - abre o controller Clientes/index
http://backup/mini-mvc2/clientes/edit/2 - abre o cliente 2 para edição
http://backup/mini-mvc2/clientes/add - abre o clientes/index por que o form add está no clientes/index
http://backup/mini-mvc2/clientes/delete/2 - exclui o cliente cm id 2
http://localhost/cadastro/funcionarios - abre o controller Funcionarios
http://localhost/cadastro/produtos - abre o Produtos

## Esta versão

Este aplicativo é oriundo basicamente de 3 outros:

- https://github.com/tjgweb/micro-framework
- https://bitbucket.org/parhamcurtis/ruahmvcyoutubecourse/src
- https://github.com/ribafs/mini-framework. Este é oriundo deste https://github.com/ribafs/mini3

## Esta versão usa algumas dependências/pacotes de terceitos

## Versão usando Singleton na conexão com o banco de dados

## Estrutura de diretórios

- App
- Core
- public
- vendor

- Detalhando:
- .htaccess - redireciona todas as requisições que chegam ao aplicativo a pasta /public
- App - aqui ficam as classes e views do aplicativo: controllers, models e views
- Core - aqui ficam arquivos de classe base para os da pasta App e outros que geralmente não são alterados
- public - aqui ficam o .htaccess, index.php e a pasta assets, contendo css, js, img, fonts
	- .htaccess - redireciona tudo que chega na pasta /public para /public/index.php
	- index.php - Front Controller, única entrada permitida para o aplicativo, tornando o mesmo mais seguro
- vendor - geralmente aqui ficam todos os pacotes de terceiros (referidos nas seções require e require-dev do composer.json), mas que em nosso caso	

Nesta versão criei duas classes base: Core/Model e Core/Controller, que são extendidas pelos models e controllers do aplicativo.
Assim economizo código e o tenho organizado, em cada classe criada tenho 2 métodos que são apenas executados nas classes filhas.

Criar classes base é uma boa prática para evitar estar digitando código de forma repetida.

Aqui continuei usando muita coisa do mini-framework, mas com algumas alterações:
- Estrutura de diretórios agora com
- /App - classes e arquivos do aplicativo
- /Core - classes e arquivos do núcleo
- Que também mudou o composer.json
- Classes base agora são abstract, para impedir o instanciamento, permitir somente extender
- Views agora incorporaram os templates e todos os seus arquivos tem extensão .phtml
- Usei parte do micro-framework, mas não usei o eloquent. Preferi o PDO, por ter mais documentação disponível
- bootstrap ficou em Core e config em App

Adicionei ao config
```
if(DEBUG) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
} else {
  error_reporting(0);
  ini_set('display_errors', 0);
  ini_set('log_errors', 1);
  ini_set('error_log', ROOT . DS .'tmp' . DS . 'logs' . DS . 'errors.log');
}
```
DEBUG por padrão é true, por estar em micro de testes

## Herança

Nesta versão foi dada ênfase à herança:

ClientesModel extends Model que extends Connection

Com isso há um maior reaproveitamento de código e uma maior modularidade e organização.

## Licença

Este projeto está sob a licença MIT.
Isto significa que você pode usar e modificar ele livremente para projetos pessoais e comerciais, apenas preservando o crédito dos autores.

## Original

Detalhes no repositório original:

https://github.com/panique/mini3
