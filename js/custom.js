//client section owl carousel
jQuery(document).ready(function ($) {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});


// Service Icon Uploader JS
let mediaUploader;

    $('#upload-service-icon').click(function (e) {
        e.preventDefault();

        // If the uploader object has already been created, reopen it
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Extend the wp.media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Select SVG Icon',
            button: { text: 'Use This Icon' },
            library: { type: 'image/svg+xml' }, // Restrict to SVG
            multiple: false
        });

        // When a file is selected, run this callback
        mediaUploader.on('select', function () {
            let attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#service-icon-url').val(attachment.url);
            $('#service-icon-preview').attr('src', attachment.url).show();
            $('#remove-service-icon').show();
        });

        // Open the uploader dialog
        mediaUploader.open();
    });

    $('#remove-service-icon').click(function () {
        $('#service-icon-url').val('');
        $('#service-icon-preview').hide();
        $(this).hide();
    });