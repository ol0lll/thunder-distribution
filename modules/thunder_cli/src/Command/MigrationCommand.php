<?php

namespace Drupal\thunder_cli\Command;

use Drupal\thunder_cli\Migration;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\ContainerAwareCommand;
// phpcs:disable
use Drupal\Console\Annotations\DrupalCommand;
// phpcs:enable

/**
 * Class ReportCommand.
 *
 * @DrupalCommand (
 *     extension="sampler",
 *     extensionType="module"
 * )
 */
class MigrationCommand extends ContainerAwareCommand {

  /**
   * The migration instance.
   *
   * @var \Drupal\thunder_cli\Migration
   */
  protected $migration;

  /**
   * MigrationCommand constructor.
   *
   * @param \Drupal\thunder_cli\Migration $migration
   *   The migration service
   */
  public function __construct($migration) {
    $this->migration = $migration;
    parent::__construct();
  }

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('thunder:migration')
      ->setDescription($this->trans('commands.thunder_cli.migration.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->migration->migrate();
  }

}
