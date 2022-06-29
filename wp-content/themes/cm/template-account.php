<?php

/**
 * Template Name: Page mes informations
 * Template Post Type: page
 */
?>

<?php
if (!is_user_logged_in()) {
    wp_safe_redirect(home_url());
}
get_header();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    if (!isset($_POST['account_nonce']) || !wp_verify_nonce($_POST['account_nonce'], 'user_account')) {
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

    if (email_exists($_POST['email']) !== get_current_user_id()) {
        $errors[] = 'L\'addresse email éxiste déjà.';
    }
    if (
        !isset($_POST['email']) ||
        !isset($_POST['firstname']) ||
        !isset($_POST['lastname'])
    ) {
        $errors[] = 'Veuillez remplir tous les champs obligatoires.';
    }

    $userdata = array(
        'ID'                    => get_current_user_id(),
        'user_email'            => $_POST['email'],
        'display_name'          => $_POST['firstname'] . ' ' . strtoupper($_POST['lastname'][0]) . '.',
        'first_name'            => $_POST['firstname'],
        'last_name'             => $_POST['lastname'],
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
            'allow-photo' => $_POST['allow-photo'],
        )
    );
    $update_user = wp_update_user($userdata);

    if (is_wp_error($update_user)) {
        echo 'Erreur lors de la mise à jour des informations.';
    } else {
        echo 'Informations correctement modifiées.';
    }
}

?>
<?php
$userId = get_userdata(get_current_user_id());

if (!empty($errors)) {
    echo '<ul class="alert alert-danger py-1 list-unstyled w-50 m-auto">';
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
}
?>
<div class="col-12 border my-3 mx-auto p-3 card">
    <h4 class="mb-3">Modifier les informations :</h4>
    <form class="needs-validation" method="post">
        <fieldset>
            <div class="row g-3">
                <div class="row g-2 mb-2">
                    <h6>Informations de compte (*) : </h6>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" value="<?= $userId->user_email ?>" name="email" id="email" required>
                            <div class="invalid-feedback">
                                L'email n'est pas valide.
                            </div>
                        </div>
                    </div>
                    <?php wp_nonce_field('user_account', 'account_nonce'); ?>
                </div>

                <div class="row g-2 mb-2">
                    <h6>Informations personelles (*) : </h6>
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label for="firstname" class="form-label">Prénom :</label>
                            <input type="text" value="<?= $userId->first_name ?>" class="form-control" name="firstname" id="firstname" required>
                            <div class="invalid-feedback">
                                Champ invalide : minimum 2 caractères alphabétiques.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="lastname" class="form-label">Nom :</label>
                            <input type="text" class="form-control" value="<?= $userId->last_name ?>" name="lastname" id="lastname" required>
                            <div class="invalid-feedback">
                                Champ invalide : minimum 2 caractères alphabétiques.
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-2">
                            <label for="gender" class="form-label">Genre :</label>
                            <select name="gender" class="form-select" id="gender" required>
                                <option value="M" <?= $userId->gender == 'M' ? 'selected' : '' ?>>Homme</option>
                                <option value="F" <?= $userId->gender == 'F' ? 'selected' : '' ?>>Femme</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-2">
                            <label for="birthday" class="form-label">Date de naissance :</label>
                            <input type="date" value="<?= $userId->birthday ?>" class="form-control" name="birthday" id="birthday" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <p class="mb-0 ">Adresse :</p>
                        <div class="col-md-3 ms-3">
                            <label for="city" class="form-label">Ville :</label>
                            <input type="text" value="<?= $userId->city ?>" class="form-control" name="city" id="city" required>
                        </div>
                        <div class="col-md-4 ms-3">
                            <label for="street" class="form-label">Rue :</label>
                            <input type="text" value="<?=$userId->street ?>" class="form-control" name="street" id="street" required>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-3">
                            <label for="phone" class="form-label">Numéro de téléphone :</label>
                            <input type="text" value="<?= $userId->phone ?>" class="form-control" name="phone" id="phone" required>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <h6>Personne à prévenir en cas de problème : </h6>
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label for="firstnameTrust" class="form-label">Prénom :</label>
                            <input type="text" value="<?= $userId->firstnameTrust ?>" class="form-control" name="firstnameTrust" id="firstnameTrust">
                        </div>

                        <div class="col-md-3">
                            <label for="lastnameTrust" class="form-label">Nom :</label>
                            <input type="text" value="<?= $userId->lastnameTrust ?>" class="form-control" name="lastnameTrust" id="lastnameTrust">
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-3">
                            <label for="phoneTrust" class="form-label">Numéro de téléphone :</label>
                            <input type="text" value="<?= $userId->phoneTrust ?>" class="form-control" name="phoneTrust" id="phoneTrust">
                        </div>

                        <div class="col-md-3">
                            <label for="linkTrust" class="form-label">Lien de parenté :</label>
                            <input type="text" value="<?= $userId->linkTrust ?>" class="form-control" name="linkTrust" id="linkTrust">
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <h6>Droit à l'image (*) :</h6>
                    <label for="allow-photo" class="form-label">J'autorise la publication de mon image sur ce site ainsi que sur les réseaux sociaux liés au club :</label>
                    <div class="col-md-1">
                        <select name="allow-photo" class="form-select" id="allow-photo" required>
                            <option value="1" <?= $userId->allowPhoto == '1' ? 'selected' : '' ?>>Oui</option>
                            <option value="0" <?= $userId->allowPhoto == '0' ? 'selected' : '' ?>>Non</option>
                        </select>
                    </div>
                </div>
            </div>
        </fieldset>
        <button class="btn btn-primary my-3" type="submit">Mettre à jour mes informations</button>
    </form>
</div>
<?php get_footer(); ?>