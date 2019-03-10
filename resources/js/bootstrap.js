import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageValidateSize from 'filepond-plugin-image-validate-size';
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/** Tooltip */

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginImageValidateSize,
        FilePondPluginFileValidateType
    );
    FilePond.setOptions({
        maxFiles: 10,
        server: {
            url: '/images',
            ...['process', 'revert', 'restore', 'load'].reduce((obj, item) => {
                obj[item] = { headers: { 'X-CSRF-TOKEN': token.content }};
                return obj;
            }, {})
        }
    });
    let dropzones = document.querySelector('.dropzone');
    let options = {
        acceptedFileTypes: [
            'image/jpeg',
            'image/png',
            'image/webp'
        ],
        imageValidateSizeMinWidth: 640,
        imageValidateSizeMinHeight: 480
    };
    if (imagesData) {
        options.files = imagesData;
    }
    const fp = FilePond.create(dropzones, options);
}


/** Tooltip logo */
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

/** Scrollspy */
if ($('#features')) {
    $('body').scrollspy({
        target: '#features'
    });
}
