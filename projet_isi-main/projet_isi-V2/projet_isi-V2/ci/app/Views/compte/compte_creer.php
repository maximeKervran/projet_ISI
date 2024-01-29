
<?= session()->getFlashdata('error') ?>

<div class='card border-warning mx-auto text-center mt-5 d-flex flex-column align-items-center' style='max-width: 50rem; border: 2px solid #ffc451;'>
    </br>

    <form class='form-inline' action="<?php echo base_url();?>index.php/compte/creer" method="post">
        <?= csrf_field() ?>
        <h2><?= $titre ?></h2>
        </br></br>
        <h5 class='card-title'>
        <div>
            <label for="pseudo">Pseudo : </label>
            <input type="input" name="pseudo" value="<?= set_value('pseudo'); ?>">
        </div>
        </h5>

        </br>
        <h5 class='card-title'>
        <div>
            <label for="mdp">Mot de passe : </label>
            <input type="password" name="mdp">
        </div>
        </h5>
        </br>
        <h5 class='card-title'>
        <div>
            <label for="mdp2"> Vérification Mot de passe : </label>
            <input type="password" name="mdp2">
        </div>
        </h5>
        </br>
        <h5>
        <div>
            <label for="statut">Statut : </label>
            <select name="statut">
            <option value="">Sélectionner un statut</option>
            <option value="Administrateur">Administrateur</option>
            <option value="Organisateur">Organisateur</option>
            </select>
        </div>
        </h5>
        </br>
        <div>
        <input type="submit" name="submit" value="Créer un nouveau compte">
        </div>
        </br>

    </form>

</div>

</br>

<?php if (isset($validation)) : ?>
    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif; ?>
