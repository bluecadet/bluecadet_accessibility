(function($, Drupal) {
  function _internalAnnounce(msg, type) {
    Drupal.announce(msg, type);
    // console.log(msg, type);
  }

  Drupal.behaviors.viewsAjaxA11y = {
    // eslint-disable-next-line no-unused-vars
    attach: function(context, settings) {
      // $(context).ajaxSuccess(function() {
      //   // Make Sure we are targeting the correct Ajax response.
      //   if (arguments[2].data) {
      //     const searchParams = new URLSearchParams(arguments[2].data);

      //     // console.log(searchParams, searchParams.get('view_name'));
      //     let view_name = searchParams.get('view_name');

      //     if (view_name) {
      //       // We have a view.
      //       let view_id_class = 'view-id-' + searchParams.get('view_name');
      //       let view_display_id_class =
      //         'view-display-id-' + searchParams.get('view_display_id');

      //       let view_selector =
      //         '.view.' + view_id_class + '.' + view_display_id_class;

      //       // Announce Results.
      //       let results = document.querySelectorAll(
      //         view_selector + ' .view-content ul li'
      //       );
      //       _internalAnnounce(results.length + ' results loaded.', 'assertive');

      //       // Set focus. First result or no results msg.
      //       if (results.length > 0) {
      //         results[0].querySelector('a').focus();
      //       } else {
      //         let no_result_msg = document.querySelectorAll(
      //           view_selector + ' .view-empty [tabindex="0"]'
      //         );
      //         if (no_result_msg.length > 0) {
      //           no_result_msg[0].focus();
      //         }
      //       }
      //     }
      //   }
      // });

      let btns = context.querySelectorAll(".view form button[type='submit']");
      btns.forEach(el => {
        el.addEventListener(
          'click',
          function() {
            let default_msg = 'Submitting the form';
            if (this.dataset.announceText) {
              default_msg = this.dataset.announceText;
            }

            _internalAnnounce(default_msg);
          },
          false
        );
      });

      let inputs = context.querySelectorAll(".view form input[type='submit']");
      inputs.forEach(el => {
        el.addEventListener(
          'click',
          function() {
            let default_msg = 'Submitting the form';
            if (this.dataset.announceText) {
              default_msg = this.dataset.announceText;
            }

            _internalAnnounce(default_msg);
          },
          false
        );
      });

      // Pagination.
      let pages = context.querySelectorAll(
        '.view .c-pagination li.c-pagination__item a'
      );
      pages.forEach(el => {
        el.addEventListener(
          'click',
          function() {
            let default_msg = 'Changing results page.';
            if (this.dataset.announceText) {
              default_msg = this.dataset.announceText;
            }
            _internalAnnounce(default_msg);
          },
          false
        );
      });
    },
  };
  // eslint-disable-next-line no-undef
})(jQuery, Drupal);
