(function ($) {
    wp.customize('header_background', function (value) {
        value.bind(function (newVal) {
            console.log('change ', newVal);
        })
    })
})(jQuery)