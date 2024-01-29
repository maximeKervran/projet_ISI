<div class='card border-warning mx-auto text-center mt-5 d-flex flex-column align-items-center' style='max-width: 80rem;'>

    <h2>Accueil</h2>
    <br />
    <h2>Session ouverte ! Bienvenue
        
    <?php
    $session=session();
    echo $session->get('user');
    ?> !
    </h2>
</div>



