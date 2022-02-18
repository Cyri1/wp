<?php

/**
 * Template Name: Page de création de compte
 * Template Post Type: page
 */
?>

<?php
if (is_user_logged_in()) {
    wp_safe_redirect(home_url());
}
get_header();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['registration_nonce']) || !wp_verify_nonce($_POST['registration_nonce'], 'user_registration')) {
        $errors[] = 'Erreur lors des vérifications des données du formulaire.';
    }
    if (!is_email($_POST['email'])) {
        $errors[] = 'L\'addresse email n\'est pas valide.';
    }
    if (!validate_username($_POST['username']) || strlen($_POST['username']) > 1) {
        $errors[] = 'L\'identifiant n\'est pas valide.';
    }
    if (email_exists($_POST['email'])) {
        $errors[] = 'L\'addresse email éxiste déjà.';
    }
    if (username_exists($_POST['username'])) {
        $errors[] = 'L\'identifiant éxiste déjà.';
    }
    if (
        !isset($_POST['email']) ||
        !isset($_POST['password1']) ||
        !isset($_POST['password2']) ||
        !isset($_POST['username']) ||
        !isset($_POST['firstname']) ||
        !isset($_POST['lastname'])
    ) {
        $errors[] = 'Veuillez remplir tous les champs obligatoires.';
    }
    if ($_POST['password1'] !== $_POST['password2']) {
        $errors[] = 'Les deux mots de passe entrés sont différents.';
    }
    if (preg_match('@[0-9]@', $_POST['password1'])) {
        $errors[] = 'Le mot de passe doit contenir un chiffre.';
    }
    if (preg_match('@[A-Z]@', $_POST['password1'])) {
        $errors[] = 'Le mot de passe doit contenir une majuscule.';
    }
    if (preg_match('@[a-z]@', $_POST['password1'])) {
        $errors[] = 'Le mot de passe doit contenir une minuscule.';
    }
    if (strlen($_POST['password1']) < 7) {
        $errors[] = 'Le mot de passe doit contenir au moins huit caractères.';
    }

    // $userdata = array(
    //     'user_pass'             => $_POST['password1'],
    //     'user_login'            => $_POST['username'],
    //     'user_email'            => $_POST['email'],
    //     'display_name'          => $_POST['firstname'] . ' ' . strtoupper($_POST['firstname'][0]) . '.',
    //     'first_name'            => $_POST['firstname'],
    //     'last_name'             => $_POST['lastname'],
    //     'description'           => '',
    //     'comment_shortcuts'     => 'false',
    //     'user_registered'       => date('Y-m-d H:i:s'),
    //     'show_admin_bar_front'  => 'false',
    //     'role'                  => 'subscriber',
    //     'locale'                => '',
    //     'meta_input'            => array(
    //         'city' => 'Brest',
    //     )
    // );
    // $user_id = wp_insert_user(wp_slash($userdata));
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger" >' . $error . '</div>';
        }
    }
}




?>
<div class="col-md-6 col-lg-6 border my-3 mx-auto p-3 card">
    <h4 class="mb-3">Créer un compte :</h4>
    <form class="needs-validation" method="post" novalidate>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Prénom :</label>
                <input type="text" class="form-control" name="firstname" id="firstname" required>
                <div class="invalid-feedback">
                    Champ invalide.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Nom :</label>
                <input type="text" class="form-control" name="lastname" id="lastname" required>
                <div class="invalid-feedback">
                Champ invalide.
                </div>
            </div>

            <div class="col-12">
                <label for="username" class="form-label">Identifiant :</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" name="username" id="username" required>
                    <div class="invalid-feedback">
                    Champ invalide.
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <label for="firstName" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" autocomplete="off" name="password1" id="password1" required>
                <div class="invalid-feedback">
                Champ invalide.
                </div>
            </div>
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Retaper votre mot de passe :</label>
                <input type="password" class="form-control" autocomplete="off" name="password2" id="password2" required>
                <div class="invalid-feedback">
                Champ invalide.
                </div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" name="email" id="email" required>
                <div class="invalid-feedback">
                Champ invalide.
                </div>
            </div>
        </div>
        <?php wp_nonce_field('user_registration', 'registration_nonce'); ?>
</div>
<button class="btn btn-primary mt-3" type="submit">Créer le compte</button>
</form>
</div>
<script>

// validator.isEmail('foo@bar.com')
</script>
<?php get_footer(); ?>