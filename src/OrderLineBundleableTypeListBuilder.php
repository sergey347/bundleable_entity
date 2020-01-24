<?php

namespace Drupal\be;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityInterface;

/**
 * Defines a class to build a listing of node type entities.
 */
class OrderLineBundleableTypeListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['title'] = t('Name');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['title'] = [
      'data' => $entity->label(),
      'class' => ['menu-label'],
    ];

    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultOperations(EntityInterface $entity) {
    $operations = parent::getDefaultOperations($entity);

    if (isset($operations['edit'])) {
      $operations['edit']['weight'] = 30;
    }

    return $operations;
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build = parent::render();

    $link = Url::fromRoute('olb.type_add');

    $add_type_link['add_type'] = [
      '#type' => 'link',
      '#title' => $this->t('+ Add new Order Line Bundleable Type'),
      '#url' => $link,
      '#options' => [
        'attributes' => [
          'class' => [],
          'style' => 'color:#0074bd; margin: 20px 0; display: inline-block;',
        ],
      ],
    ];

    return $add_type_link + $build;
  }

}
