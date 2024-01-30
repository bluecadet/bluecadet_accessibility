(function($, Drupal) {
  function _internalAnnounce(msg, type) {
    Drupal.announce(msg, type);
    // console.log(msg, type);
  }

  Drupal.behaviors.viewsAjaxA11y = {
    // eslint-disable-next-line no-unused-vars
    attach: function(context, settings) {

      // todo: how do we know these buttons should be under our control?
      // Should we add a class to the main view?
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

      // todo: how do we know these inputs should be under our control?
      // Should we add a class to the main view?
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
      // todo: these queries need to be variablezed, I think.
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
