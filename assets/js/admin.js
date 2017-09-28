/**
 * Alka Facebook Saving process
 */
jQuery( document ).ready( function () {

    jQuery( document ).on( 'click', '#alkaweb-facebook-details', function ( e ) {

        e.preventDefault();

        var _app_id = jQuery( '#alka-fb-app-id' ).val(),
            _app_seccret = jQuery( '#alka-fb-app-secret' ).val();

        jQuery.ajax( {
            url: alka_facebook_admin.ajax_url,
            type: 'post',
            data: {
                action: 'alka_store_admin_creeds',
                security: alka_facebook_admin._nonce,
                app_id: _app_id,
                app_secret: _app_seccret
            },
            success: function ( response ) {
                alert(response);
            }
        } );

    } );

} );