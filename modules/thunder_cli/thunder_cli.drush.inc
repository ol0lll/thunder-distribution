<?php

/**
 * @file
 * Drush commands for sampler module.
 */

/**
 * Implements hook_drush_command().
 */
function thunder_cli_drush_command() {
  $items = [];
  $items['thunder-migration'] = [
    'description' => dt('Migrate Thunder 2 to Thunder 3.'),
    'aliases' => ['thunder:migration'],
  ];
  return $items;
}

/**
 * Run the thunder migration.
 */
function drush_thunder_migration() {
  $migration = \Drupal::getContainer()
    ->get('thunder_cli.migration');

  $migration->migrate();
}
