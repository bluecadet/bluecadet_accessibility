<?php

namespace Drupal\bluecadet_accessibility\Ajax;

use Drupal\Core\Ajax\CommandInterface;
use Drupal\views\ViewExecutable;

/**
 * Adds in the custom after Ajax Command.
 */
class ViewsAjaxReFocusCommand implements CommandInterface {

  /**
   * Drupal view.
   *
   * @var Drupal\views\ViewExecutable
   */
  public $view;

  /**
   * {@inheritdoc}
   */
  public function __construct(ViewExecutable $view) {
    $this->view = $view;
  }

  /**
   * {@inheritdoc}
   */
  public function render() {

    // The JS function will take care of checking state.
    return [
      'command' => 'viewsAjaxReFocusCall',
      'view_dom_id' => $this->view->dom_id,
    ];
  }

}
