const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const login = urlParams.get('login')

if (login) {
    let myAlert = document.querySelector('.toast');
    let bsAlert = new bootstrap.Toast(myAlert);
    bsAlert.show();
}

jQuery('.needs-validation input').on('blur', function() {
    if(this.id == 'firstname' || this.id == 'lastname') {
        if (validator.isAlpha(this.value, 'fr-FR', {ignore:' \'-,'}) && validator.isLength(this.value, {min:2, max: 30})) {
            jQuery(this).addClass('is-valid')
            jQuery(this).removeClass('is-invalid')
        }
        else {
            jQuery(this).addClass('is-invalid')
            jQuery(this).removeClass('is-valid')
        }
    }
    if(this.id == 'username') {
        if (validator.isAlphanumeric(this.value, 'fr-FR') && validator.isLength(this.value, {min:2, max: 30})) {
            jQuery(this).addClass('is-valid')
            jQuery(this).removeClass('is-invalid')
        }
        else {
            jQuery(this).addClass('is-invalid')
            jQuery(this).removeClass('is-valid')
        }
    }
    if(this.id == 'password1') {
        if (validator.isStrongPassword(this.value, {minLowercase: 1, minUppercase: 1, minNumbers: 1, minSymbols: 0})) {
            jQuery(this).addClass('is-valid')
            jQuery(this).removeClass('is-invalid')
            console.log(this.value);
        }
        else {
            jQuery(this).addClass('is-invalid')
            jQuery(this).removeClass('is-valid')
            console.log(this.value);
        }
    }
    if(this.id == 'password2') {
        if (jQuery(this).val() === jQuery('#password1').val() && validator.isStrongPassword(this.value, {minLowercase: 1, minUppercase: 1, minNumbers: 1, minSymbols: 0})) {
            jQuery(this).addClass('is-valid')
            jQuery(this).removeClass('is-invalid')
        }
        else {
            jQuery(this).addClass('is-invalid')
            jQuery(this).removeClass('is-valid')
        }
    }
    if(this.id == 'email') {
        if (validator.isEmail(this.value, { allow_display_name: false, require_display_name: false, allow_utf8_local_part: true, require_tld: true, allow_ip_domain: false, domain_specific_validation: false, blacklisted_chars: '', host_blacklist: [] })) {
            jQuery(this).addClass('is-valid')
            jQuery(this).removeClass('is-invalid')
        }
        else {
            jQuery(this).addClass('is-invalid')
            jQuery(this).removeClass('is-valid')
        }
    }
});
