<?php

/**
 * Template Name: Page de création de compte
 * Template Post Type: page
 */
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    if (!isset($_POST['registration_nonce']) || !wp_verify_nonce($_POST['registration_nonce'], 'user_registration')) {
        $errors[] = 'Erreur lors des vérifications des données du formulaire.';
    }
    if (!is_email($_POST['email'])) {
        $errors[] = 'L\'addresse email n\'est pas valide.';
    }
    if (strlen($_POST['firstname']) < 1 || preg_match('/[#$%^&*()+=\\[\];.\/{}|":<>?~\\\\]/', $_POST['firstname'])) {
        $errors[] = 'Le prénom n\'est pas valide.';
    }
    if (strlen($_POST['lastname']) < 1 || preg_match('/[#$%^&*()+=\\[\];.\/{}|":<>?~\\\\]/', $_POST['lastname'])) {
        $errors[] = 'Le nom n\'est pas valide.';
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
        !isset($_POST['firstname']) ||
        !isset($_POST['lastname'])
    ) {
        $errors[] = 'Veuillez remplir tous les champs obligatoires.';
    }
    if ($_POST['password1'] !== $_POST['password2']) {
        $errors[] = 'Les deux mots de passe entrés sont différents.';
    }
    if (!preg_match('@[0-9]@', $_POST['password1'])) {
        $errors[] = 'Le mot de passe doit contenir un chiffre.';
    }
    if (!preg_match('@[A-Z]@', $_POST['password1'])) {
        $errors[] = 'Le mot de passe doit contenir une majuscule.';
    }
    if (!preg_match('@[a-z]@', $_POST['password1'])) {
        $errors[] = 'Le mot de passe doit contenir une minuscule.';
    }
    if (strlen($_POST['password1']) < 7) {
        $errors[] = 'Le mot de passe doit contenir au moins huit caractères.';
    }

    $userdata = array(
        'user_pass'             => $_POST['password1'],
        'user_login'            => $_POST['firstname'].'-'.$_POST['lastname'].'-'.time(),
        'user_email'            => $_POST['email'],
        'display_name'          => $_POST['firstname'] . ' ' . strtoupper($_POST['lastname'][0]) . '.',
        'first_name'            => $_POST['firstname'],
        'last_name'             => $_POST['lastname'],
        'description'           => '',
        'comment_shortcuts'     => 'false',
        'user_registered'       => date('Y-m-d H:i:s'),
        'show_admin_bar_front'  => 'false',
        'role'                  => 'subscriber',
        'locale'                => '',
        'meta_input'            => array(
            'gender' => $_POST['gender'],
            'birthday' => $_POST['birthday'],
            'city' => $_POST['city'],
            'street' => $_POST['street'],
            'phone' => $_POST['phone'],
            'firstnameTrust' => $_POST['firstnameTrust'],
            'lastnameTrust' => $_POST['lastnameTrust'],
            'phoneTrust' => $_POST['phoneTrust'],
            'linkTrust' => $_POST['linkTrust'],
            'allowPhoto' => $_POST['allowPhoto'],
        )
    );
    $user_id = wp_insert_user(wp_slash($userdata));
}

if (is_user_logged_in()) {
    wp_safe_redirect(home_url());
}
get_header();

if (!empty($errors)) {
    echo '<ul class="alert alert-danger py-1 list-unstyled w-50 m-auto">';
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
}
?>
<div class="col-12 border my-3 mx-auto p-3 card">
    <h4 class="mb-3">Créer un compte :</h4>
    <form class="needs-validation" method="post">
        <fieldset>
            <div class="row g-3">
                <div class="row g-2 mb-2">
                    <h6>Informations de compte (*) : </h6>

                    <div class="row g-2">
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" value="<?= $_POST['email'] ?>" name="email" id="email" required>
                            <div class="invalid-feedback">
                                L'email n'est pas valide.
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-3">
                            <label for="password1" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" autocomplete="off" value="<?= $_POST['password1'] ?>" name="password1" id="password1" required>
                            <div class="invalid-feedback">
                                Le mot de passe doit contenir au minimum 8 caractères, une minuscule, une majuscule et un chiffre.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="password2" class="form-label">Vétification du mot de passe :</label>
                            <input type="password" class="form-control" autocomplete="off" value="<?= $_POST['password2'] ?>" name="password2" id="password2" required>
                            <div class="invalid-feedback">
                                Les mots de passe doivent être identiques.
                            </div>
                        </div>
                    </div>

                    <?php wp_nonce_field('user_registration', 'registration_nonce'); ?>
                </div>

                <div class="row g-2 mb-2">
                    <h6>Informations personelles (*) : </h6>

                    <div class="row g-2">
                        <div class="col-md-3">
                            <label for="firstname" class="form-label">Prénom :</label>
                            <input type="text" value="<?= $_POST['firstname'] ?>" class="form-control" name="firstname" id="firstname" required>
                            <div class="invalid-feedback">
                                Champ invalide : minimum 2 caractères alphabétiques.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="lastname" class="form-label">Nom :</label>
                            <input type="text" class="form-control" value="<?= $_POST['lastname'] ?>" name="lastname" id="lastname" required>
                            <div class="invalid-feedback">
                                Champ invalide : minimum 2 caractères alphabétiques.
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-2">
                            <label for="gender" class="form-label">Genre :</label>
                            <select name="gender" class="form-select" id="gender" required>
                                <option value="M" <?= $_POST['gender'] == 'M' ? 'selected' : '' ?>>Homme</option>
                                <option value="F" <?= $_POST['gender'] == 'F' ? 'selected' : '' ?>>Femme</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-2">
                            <label for="birthday" class="form-label">Date de naissance :</label>
                            <input type="date" value="<?= $_POST['birthday'] ?>" class="form-control" name="birthday" id="birthday" required>
                        </div>

                    </div>
                    <div class="row g-2">
                        <p class="mb-0 ">Adresse :</p>
                            <div class="col-md-3 ms-3">
                                <label for="city" class="form-label">Ville :</label>
                                <input type="text" value="<?= $_POST['city'] ?>" class="form-control" name="city" id="city" required>
                            </div>
                            <div class="col-md-4 ms-3">
                                <label for="street" class="form-label">Rue :</label>
                                <input type="text" value="<?= $_POST['street'] ?>" class="form-control" name="street" id="street" required>
                            </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-3">
                            <label for="phone" class="form-label">Numéro de téléphone :</label>
                            <input type="text" value="<?= $_POST['phone'] ?>" class="form-control" name="phone" id="phone" required>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <h6>Personne à prévenir en cas de problème : </h6>
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label for="firstnameTrust" class="form-label">Prénom :</label>
                            <input type="text" value="<?= $_POST['firstnameTrust'] ?>" class="form-control" name="firstnameTrust" id="firstnameTrust">
                        </div>

                        <div class="col-md-3">
                            <label for="lastnameTrust" class="form-label">Nom :</label>
                            <input type="text" value="<?= $_POST['lastnameTrust'] ?>" class="form-control" name="lastnameTrust" id="lastnameTrust">
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-3">
                            <label for="phoneTrust" class="form-label">Numéro de téléphone :</label>
                            <input type="text" value="<?= $_POST['phoneTrust'] ?>" class="form-control" name="phoneTrust" id="phoneTrust">
                        </div>

                        <div class="col-md-3">
                            <label for="linkTrust" class="form-label">Lien de parenté :</label>
                            <input type="text" value="<?= $_POST['linkTrust'] ?>" class="form-control" name="linkTrust" id="linkTrust">
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <h6>Droit à l'image (*) :</h6>
                    <label for="allowPhoto" class="form-label">J'autorise la publication de mon image sur ce site ainsi que sur les réseaux sociaux liés au club :</label>
                    <div class="col-md-1">
                        <select name="allowPhoto" class="form-select" id="allowPhoto" required>
                            <option value="1" <?= $_POST['allowPhoto'] == '1' ? 'selected' : '' ?>>Oui</option>
                            <option value="0" <?= $_POST['allowPhoto'] == '0' ? 'selected' : '' ?>>Non</option>
                        </select>
                    </div>
                </div>
            </div>
        </fieldset>

        <button class="btn btn-primary my-3" type="submit">Créer le compte</button>
    </form>
</div>
<?php get_footer(); ?>