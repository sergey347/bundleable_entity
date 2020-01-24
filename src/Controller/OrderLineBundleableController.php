<?php

namespace Drupal\be\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\be\Entity\OrderLineBundleableTypeInterface;

/**
 * Class OrderLineBundleableController.
 */
class OrderLineBundleableController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * OLB entity add callback.
   */
  public function add(OrderLineBundleableTypeInterface $advertiser_type) {
    $advertiser = $this->entityTypeManager()
      ->getStorage('olb')
      ->create([
        'type' => $advertiser_type->id(),
      ]);

    $form = $this->entityFormBuilder()->getForm($advertiser);

    return $form;
  }

  /**
   * OLB entity add page callback.
   */
  public function addPage() {
    $content = [];

    foreach ($this->entityTypeManager()->getStorage('olb_type')->loadMultiple() as $type) {
      $content[$type->id()] = $type;
    }

    return [
      '#theme' => 'be_add_list',
      '#content' => $content,
    ];
  }

}
