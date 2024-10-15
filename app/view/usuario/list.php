<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/list.css">

<a class="btn btn-custom mt-2 voltar"
    href="<?= HOME_PAGE ?>">
    <i class="fs-4 bi bi-arrow-left-square"></i></a>

<h3 class="text-center">Listagem Usuários</h3>

<div class="container">

    <div class="row" style="margin-top: 10px;">
        <div class="col-12 tableUser">
            <table id="tabUsuarios">
                <tr>
                    <th>ID</th>
                    <th>Nome completo</th>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Tipo de usuário</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
                <?php foreach ($dados['lista'] as $usu): ?>
                    <tr>
                        <td><?php echo $usu->getId(); ?></td>
                        <td><?= $usu->getNomeSobrenome(); ?></td>
                        <td><?= $usu->getNomeUsuario(); ?></td>
                        <td><?= $usu->getEmail(); ?></td>
                        <td><?= $usu->getTipoUsuario(); ?></td>
                        <td><a class="btn btn-primary"
                                href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $usu->getId() ?>">
                                Alterar</a>
                        </td>
                        <td><a class="btn btn-danger"
                                onclick="return confirm('Confirma a exclusão do usuário?');"
                                href="<?= BASEURL ?>/controller/UsuarioController.php?action=delete&id=<?= $usu->getId() ?>">
                                Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>


<?php
require_once(__DIR__ . "/../include/footer.php");
?>