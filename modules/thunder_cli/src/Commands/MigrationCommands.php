<?php

namespace Drupal\thunder_cli\Commands;

use Drupal\thunder_cli\Migration;
use Drush\Commands\DrushCommands;

/**
 * A Drush command file.
 */
class MigrationCommands extends DrushCommands {

  /**
   * The reporter instance.
   *
   * @var \Drupal\thunder_cli\Migration
   */
  protected $migration;

  /**
   * MigrationCommands constructor.
   *
   * @param \Drupal\thunder_cli\Migration $migration
   *   The migration service.
   */
  public function __construct(Migration $migration) {
    $this->migration = $migration;
  }

  /**
   * Migrate to Thunder 3.
   *
   * @command thunder:migration
   */
  public function report() {
    $this->migration->migrate();
  }

}
