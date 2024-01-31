<?php

namespace Drupal\bluecadet_accessibility\EventSubscriber;

use Drupal\Core\Ajax\AnnounceCommand;
use Drupal\Core\Ajax\FocusFirstCommand;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\views\Ajax\ViewAjaxResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Alter a Views Ajax Response.
 */
class ViewsAjaxResponseSubscriber implements EventSubscriberInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = ['onResponse'];
    return $events;
  }

  /**
   * Allows us to alter the Ajax response from a view.
   *
   * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
   *   The event process.
   */
  public function onResponse(FilterResponseEvent $event) {
    $response = $event->getResponse();

    // Only act on a Views Ajax Response.
    if ($response instanceof ViewAjaxResponse) {
      $view = $response->getView();
      // Assuming typical view classes here.
      $view_selector = '.view.view-id-' . $view->id() . '.view-display-id-' . $view->current_display;
      $commands = &$response->getCommands();

      $display_extenders_options = $view->display_handler->getOption('display_extenders');

      if (
        ($view->ajaxEnabled() && (isset($display_extenders_options['ajax_ally_option']['enable_ally'])
          && $display_extenders_options['ajax_ally_option']['enable_ally'] == TRUE)
        )
        && empty($view->is_attachment) && empty($view->live_preview)
      ) {
        // Disable the default behavior of visually scrolling
        // on view refreshes caused by form changes or pagination.
        foreach ($commands as &$command) {
          if (isset($command['command']) && $command['command'] === 'viewsScrollTop') {
            unset($command['command']);
          }
        }

        // Add in Announce for number of results.
        $result_count = count($view->result);
        // @todo variablise this in a settings page.
        $msg = $this->formatPlural($result_count, '1 result loaded.', '@count results loaded.');
        $response->addCommand(new AnnounceCommand($msg, 'assertive'));

        // Add in focus command.
        if ($result_count > 0) {
          // @todo variablise this in a settings page.
          $response->addCommand(new FocusFirstCommand($view_selector . ' .view-content ul li'));
        }
        else {
          // @todo variablise this in a settings page.
          $response->addCommand(new FocusFirstCommand($view_selector . ' .view-empty [tabindex="0"]'));
        }
      }
    }
  }

}
