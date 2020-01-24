<?php

namespace Drupal\be\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\my_common\Entity\MyEntityCreatedInterface;
use Drupal\my_common\Entity\MyEntityChangedInterface;
use Drupal\my_commerce\Entity\MyOrderInterface;

/**
 * Provides an interface for OLB entities.
 */
interface OrderLineBundleableInterface extends ContentEntityInterface, MyEntityCreatedInterface, MyEntityChangedInterface {

  /**
   * Get amount.
   *
   * @return float
   *   Amount.
   */
  public function getAmount(): float;

  /**
   * Get currency code.
   *
   * @return string
   *   Currency code.
   */
  public function getCurrency(): string;

  /**
   * Get order ID.
   *
   * @return string
   *   Order ID.
   */
  public function getOrderId(): ?string;

  /**
   * Get order entity.
   *
   * @return \Drupal\my_commerce\Entity\MyOrderInterface
   *   Order Entity.
   */
  public function getOrder(): ?MyOrderInterface;

}
