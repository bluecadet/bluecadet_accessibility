<?php

namespace Drupal\Tests\bluecadet_accessibility\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests update status alter behavior.
 *
 * @group bluecadet_accessibility
 */
class UpdateStatusAlterTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['system', 'views', 'views_ajax_history', 'bluecadet_accessibility'];

  /**
   * Tests projects that are not targeted remain unchanged.
   */
  public function testNonTargetProjectUnchanged(): void {
    $projects = [
      'example_module' => [
        'name' => 'example_module',
        'project_type' => 'module',
        'status' => 1,
      ],
    ];

    $expected = $projects;

    bluecadet_accessibility_update_status_alter($projects);

    $this->assertSame($expected, $projects);
  }

}
