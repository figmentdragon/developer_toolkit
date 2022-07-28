jQuery(document).ready(function ($) {

    $('.padding-wrap .customize-control-padding-value').on('keyup change', function () {

        var parent = $(this).parents('.padding-wrap'),
            dbstore_cache = $('.padding-db', parent),
            dbstore = dbstore_cache.val(),
            device_type = $(this).data('area-type');

        dbstore = dbstore === '' ? {} : JSON.parse(dbstore);

        dbstore[device_type] = this.value;

        dbstore_cache.val(JSON.stringify(dbstore)).change();
    })

});
