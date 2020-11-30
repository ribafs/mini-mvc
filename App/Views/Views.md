# Views

Neste diretório ficam todas as views do aplicativo

Para cada tabela teremos aqui 3 arquivos:
- add.phtml
- index.phtml
- edit.phtml

Também teremos uma pasta para o controller Error

- error
	- index.phtml
	
Temos uma pasta com os includes:
- footer.phtml	
- header.phtml
- menu.phtml

## # Views\clientes\add.phtml

Darei o exemplo apenas de clientes, pois vendedores é semelhante

```php
<div class="container">
    <h2 class="text-center">Clientes</h2>
    <div>
        <br>
        <form action="<?php echo URL; ?>clientes/add" method="POST">   
        <table class="table table-hover table-stripped">
            <tr><td><label>Nome</label></td>
            <td><input class="form-control" type="text" name="nome" value="" required /></td></tr>
            <td><label>E-mail</label></td>
            <td><input class="form-control" type="email" name="email" value="" required /></td></tr>
            <tr><td></td><td><input type="submit" name="submit_add_cliente" value="Add Cliente" class="btn btn-primary btn-sm"/></td></tr>
		</table>
        </form>
    </div>
</div>
```

Fique atento para o name do submit, no caso, submit_add_cliente, pois será usado no Core\Controller.
Sempre que mudar de tabela, adequadamente mude o name de cada submit, tanto do add.phtml, quanto do edit.phtml.

## # Views\clientes\edit.phtml

```php
<div class="container">
    <h2 class="text-center">Clientes</h2>
    <div>
		<br><br>
        <form action="<?php echo URL; ?>clientes/update" method="POST">   
        <table class="table table-hover table-stripped">
            <tr><td><label>Nome</label></td>
            <td><input class="form-control" type="text" name="nome" value="<?php echo htmlspecialchars($um->nome, ENT_QUOTES, 'UTF-8'); ?>" required autofocus/></td></tr>
            <td><label>E-mail</label></td>
            <td><input class="form-control" type="email" name="email" value="<?php echo htmlspecialchars($um->email, ENT_QUOTES, 'UTF-8'); ?>" required /></td></tr>
            <input type="hidden" name="field_id" value="<?php echo htmlspecialchars($um->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <tr><td></td><td><input type="submit" name="submit_update_cliente" value="Update Cliente" class="btn btn-primary btn-sm"/></td></tr>
		</table>
        </form>
    </div>
</div>
<br><br><br>
```

Observe novamente o name do submit, sendo que agora o do edit.phtml chama-se submit_update_cliente. Claro que você pode mudar estes nomes e usar o mesmo no Core\Controller, mas é importante manter um padrão, parar ajudar a lembrar e a manter.

Veja que a variável objeto aqui que vem do Core\Controller, é $um.

Outra informação importante aqui é o nome do campo hidden, que é field_id.

# Views\clientes\index.html

```php
<div class="container">
    <h2 class="text-center">Clientes</h2>
	<a class="btn btn-primary btn-sm" href="<?=URL . 'clientes/add'; ?>">Add Cliente</a>

    <div>
        <br>        
        <b>Lista de clientes (dados vindos do model)</b><div class="text-right"><b>Soma de clientes: <?php echo $soma; ?></b></div>
        <table class="table table-hover table-stripped">
            <thead>
            <tr class="bg-gray">
                <td><b>ID</b></td>
                <td><b>Nome</b></td>
                <td><b>E-mail</b></td>
                <td colspan="2" align="center">AÇÕES</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($todos as $cliente) { ?>
                <tr>
                    <td><?php if (isset($cliente->id)) echo htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->nome)) echo htmlspecialchars($cliente->nome, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->email)) echo htmlspecialchars($cliente->email, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'clientes/delete/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a></td>
                    <td><a href="<?php echo URL . 'clientes/edit/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
```

## Algumas informações importantes

Link para botão Add - <?=URL . 'clientes/add'; ?>

Variáveis objeto usadas aqui: $soma, $todos (usada no foreach)


# Views\error\index.phtml

```php
<?php
if($type == 1){
?>
<br><br>
<div class="container text-danger">
    <h3 align="center">Este action não existe: <?php echo $action; ?>.</h3>
</div>

<?php
}elseif($type==2){
?>
<br><br>
<div class="container text-danger">
    <h3 align="center">Este controller não existe: <?php echo $controller; ?>.</h3>
</div>
<?php
}
?>
<br><br><br><br>
```

Observe que $type, $controller e $action vem de Core\Router.php


## Views\_includes\footer.phtml

```php
<div class="container bg-gray">
    <div align="center">
        <a href="https://github.com/panique/mini3">MINI3 on GitHub</a>.<br>
        Caso tenha gostado do projeto mini3, suporte <a href="http://tracking.rackspace.com/SH1ES" target="_blank">usando Rackspace</a> como sua hospedagem [link afiliado].
    </div>
</div>
</body>
</html>
```

Aqui apenas HTML, um crétido ao autor do aplicativo (mini3) que deu origem a este e diversos outros.

## Views\_includes\header.phtml

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=APP_TITTLE?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS from BootStrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="<?php echo URL; ?>assets/css/custom.css" rel="stylesheet">                
</head>
<body>
    <div align="center"><h1><?=APP_TITTLE?></h1></div>
	<div class="container">
```

Esta constante APP_TITTLE, que é declarada no Core\config.php, é o nome/título do aplicativo

Observe que aqui tenho o link do BootStrap4 e do custom.css.


## Views\_includes\menu.phtml

```php
		<!-- MENU -->
		<nav class="navbar-expand bg-dark navbar-dark">
			<ul class="navbar-nav justify-content-center">
			  <li class="nav-item"><a class="nav-link" href="<?php echo URL; ?>clientes">Clientes</a></li>
				<li class="nav-itens"> <a class="nav-link" href="<?php echo URL; ?>vendedores">Vendedores</a></li>
			</ul>
		</nav>
	</div>
```
Aqui ficam os links das tabelas que formam o menu de topo em cada arquivo da view.

	

