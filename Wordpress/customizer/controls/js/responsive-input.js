jQuery(document).ready(function ($) {

    $('.responsive-input-wrap .customize-control-input-value').on('keyup', function () {

        var parent = $(this).parents('.responsive-input-wrap'),
            dbstore_cache = $('.responsive-input-db', parent),
            dbstore = dbstore_cache.val(),
            device_type = $(this).data('device-type');

        dbstore = dbstore === '' ? {} : JSON.parse(dbstore);

        dbstore[device_type] = this.value;

        dbstore_cache.val(JSON.stringify(dbstore)).change();
    })

});
