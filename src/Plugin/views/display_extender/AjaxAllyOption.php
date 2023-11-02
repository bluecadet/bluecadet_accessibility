<?php

namespace Drupal\bluecadet_accessibility\Plugin\views\display_extender;

use Drupal\views\Plugin\views\display_extender\DisplayExtenderPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Ajax AJAX A11y display extender plugin.
 *
 * @ingroup views_display_extender_plugins
 *
 * @ViewsDisplayExtender(
 *   id = "ajax_ally_option",
 *   title = @Translation("AJAX A11y Option"),
 *   help = @Translation("Enable better A11y handling of AJAX views."),
 *   no_ui = FALSE,
 * )
 */
class AjaxAllyOption extends DisplayExtenderPluginBase {

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {

    if ($form_state->get('section') == 'use_ajax') {
      // Add opportunity to enable view ajax history handler for this view.
      $form['enable_ally'] = [
        '#title' => $this->t('AJAX A11y'),
        '#type' => 'checkbox',
        '#description' => $this->t('Enable better A11y handling of AJAX views.'),
        '#default_value' => $this->options['enable_ally'] ?? 0,
        '#states' => [
          'visible' => [
            ':input[name="use_ajax"]' => ['checked' => TRUE],
          ],
        ],
      ];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function validateOptionsForm(&$form, FormStateInterface $form_state) {
    if ($form_state->hasValue('use_ajax') && $form_state->getValue('use_ajax') != TRUE) {
      // Prevent use ajax a11y when ajax for view are disabled.
      $form_state->setValue('enable_ally', FALSE);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitOptionsForm(&$form, FormStateInterface $form_state) {
    if ($form_state->get('section') == 'use_ajax') {
      $this->options['enable_ally'] = $form_state->getValue('enable_ally');
    }
  }

}
