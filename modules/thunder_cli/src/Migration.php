<?php

namespace Drupal\thunder_cli;

use Symfony\Component\Process\Process;
use DrupalFinder\DrupalFinder;

/**
 * The Migration service.
 *
 * @package Drupal\thunder_cli
 */
class Migration {

  /**
   * The drupal directory finder object.
   *
   * @var DrupalFinder
   */
  private $drupalFinder;

  /**
   * The process object.
   *
   * @var Process
   */
  private $process;

  /**
   * Migration constructor.
   */
  public function __construct() {
    $this->process = new Process('', NULL, NULL, NULL, 0);
    $this->drupalFinder = new DrupalFinder();
    $this->drupalFinder->locateRoot(DRUPAL_ROOT);
  }

  /**
   * Migrate Thunder 2 to 3
   *
   * @return bool
   */
  public function prepare() {
    if (!$this->requirements()) {
      return FALSE;
    }
    $this->process->setWorkingDirectory($this->drupalFinder->getComposerRoot());

    $this->process->setCommandLine('composer update');
    $this->process->run();

    $this->process->setCommandLine('composer require "drupal/media_entity:^2.0-beta4" "drupal/media_entity_image" "drupal/riddle_marketplace:^3.0-beta2" --no-update');
    $this->process->run();
  }


  /**
   * Check if requirements for migration are fulfilled.
   *
   * @return bool
   */
  protected function requirements() {
    $this->process->setCommandLine('drush version --format=php');
    $this->process->run();

    if (!$this->process->isSuccessful()) {
      return FALSE;
    }
    #$output = $this->process->getOutput();
    print_r('kjhkjhk');die;
    return TRUE;
  }

  public function migrate() {
    $this->process->setCommandLine('composer install');
    $this->process->run();

    $this->process->setWorkingDirectory($this->drupalFinder->getDrupalRoot());
    $this->process->setCommandLine('drush updb');
  }

}
