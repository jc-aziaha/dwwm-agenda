<?php
session_start();

    // Si le paramètre du nom de "contact_id" n'a pas été envoyé via la méthode "GET" du protocole HTTP 
    // ou qu'il est vide, 
    if ( !isset($_GET['contact_id']) || empty($_GET['contact_id']) ) 
    {
        // Redirigeons l'utilisateur vers la page de laquelle proviennent les informations
        // Puis arrêtons l'exécution du script
        return header("Location: index.php");
    }

    $contact_id = (int) htmlspecialchars($_GET['contact_id']);

    // Appelons le manager
    require __DIR__ . "/functions/manager.php";

    // Demandons lui de vérifier si l'identifiant récupéré de la barre l'url 
    // correspond l'identifiant d'un enregistrement de la table "contact"
    $contact = contact_find_by($contact_id);

    // Si le contact n'existe pas,
    if ( ! $contact ) 
    {
        // Redirigeons l'utilisateur vers la page de laquelle proviennent les informations
        // Puis arrêtons l'exécution du script
        return header("Location: index.php");
    }

?>
<?php // ------------------------------------------View------------------------------------------------ ?>
<?php $title = "Modifier ce contact"; ?>
<?php $description = "Hello! Accédez au formulaire de modification d'un contact via le formulaire."; ?>
<?php $keywords = "Agenda, Contacts, php, php8, Projet, DWWM"; ?>
<?php require __DIR__ . "/partials/head.php"; ?>

    <?php require __DIR__ . "/partials/nav.php"; ?>

    <!-- Le contenu spécifique à cette page -->
    <main class="container">
        <h1 class="text-center my-3 display-5">Modifer ce contact</h1>

        
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-7 mx-auto p-4 shadow bg-white">

                    <?php if( isset($_SESSION['create_form_errors']) && !empty($_SESSION['create_form_errors']) ) : ?>
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                <?php foreach($_SESSION['create_form_errors'] as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php unset($_SESSION['create_form_errors']); ?>
                    <?php endif ?>

                    <form method="POST">

                        <div class="row">
                            <div class="col md-6">
                                <div class="mb-3">
                                    <label for="create_form_first_name">Prénom</label>
                                    <input type="text" name="first_name" id="create_form_first_name" class="form-control" value="<?= isset($_SESSION['create_form_old_values']['first_name']) ? $_SESSION['create_form_old_values']['first_name'] : '' ; unset($_SESSION['create_form_old_values']['first_name']); ?>">
                                </div>
                            </div>
                            <div class="col md-6">
                                <div class="mb-3">
                                    <label for="create_form_last_name">Nom</label>
                                    <input type="text" name="last_name" id="create_form_last_name" class="form-control" value="<?= isset($_SESSION['create_form_old_values']['last_name']) ? $_SESSION['create_form_old_values']['last_name'] : '' ; unset($_SESSION['create_form_old_values']['last_name']); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="create_form_email">Email</label>
                                    <input type="email" name="email" id="create_form_email" class="form-control" value="<?= isset($_SESSION['create_form_old_values']['email']) ? $_SESSION['create_form_old_values']['email'] : '' ; unset($_SESSION['create_form_old_values']['email']); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="create_form_age">Age</label>
                                    <input type="number" name="age" id="create_form_age" class="form-control" value="<?= isset($_SESSION['create_form_old_values']['age']) ? $_SESSION['create_form_old_values']['age'] : '' ; unset($_SESSION['create_form_old_values']['age']); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="create_form_phone">Numéro de téléphone</label>
                            <input type="tel" name="phone" id="create_form_phone" class="form-control" value="<?= isset($_SESSION['create_form_old_values']['phone']) ? $_SESSION['create_form_old_values']['phone'] : '' ; unset($_SESSION['create_form_old_values']['phone']); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="create_form_comment">Commentaires</label>
                            <textarea name="comment" id="create_form_comment" class="form-control" rows="4"><?= isset($_SESSION['create_form_old_values']['comment']) ? $_SESSION['create_form_old_values']['comment'] : '' ; unset($_SESSION['create_form_old_values']['comment']); ?></textarea>
                        </div>

                        <div class="mb-3 d-none">
                            <input type="hidden" name="create_form_csrf_token" value="<?= $_SESSION['create_form_csrf_token'] ?>">
                        </div>

                        <div class="mb-3 d-none">
                            <input type="hidden" name="create_form_honey_pot" value="">
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary shadow" value="Ajouter" formnovalidate>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <?php require __DIR__ . "/partials/footer.php"; ?>

<?php require __DIR__ . "/partials/foot.php"; ?>


    

