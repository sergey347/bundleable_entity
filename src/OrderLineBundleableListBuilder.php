<?php

namespace Drupal\be;

use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityInterface;

/**
 * Defines a class to build a listing of node type entities.
 */
class OrderLineBundleableListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['title'] = t('Title');
    $header['type'] = t('Type');

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

    $row['type'] = [
      'data' => $entity->bundle(),
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

    $link = Url::fromRoute('olb.add_page');

    $add_link['add'] = [
      '#type' => 'link',
      '#title' => $this->t('+ Add new Order Line Bundleable entity'),
      '#url' => $link,
      '#options' => [
        'attributes' => [
          'class' => [],
          'style' => 'color:#0074bd; margin: 20px 0; display: inline-block;',
        ],
      ],
    ];

    return $add_link + $build;
  }

}
