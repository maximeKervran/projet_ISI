<!-- Vue compte_modifier_mot_de_passe.php -->
<h2>Modifier le mot de passe</h2>

<!-- Afficher les erreurs de validation -->
<?= \Config\Services::validation()->listErrors() ?>

<!-- Formulaire de modification du mot de passe -->
<?= form_open('compte/sauvegarder_mot_de_passe') ?>
    <label for="nouveau_mot_de_passe">Nouveau mot de passe :</label>
    <input type="password" name="nouveau_mot_de_passe" required minlength="8">

    <label for="confirmation_mot_de_passe">Confirmation du mot de passe :</label>
    <input type="password" name="confirmation_mot_de_passe" required>

    <button type="submit" class="btn btn-primary">Valider</button>
    <a href="<?= base_url('compte/afficher_profil') ?>" class="btn btn-secondary">Annuler</a>
<?= form_close() ?>
