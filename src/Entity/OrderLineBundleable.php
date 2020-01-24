<?php

namespace Drupal\be\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\my_commerce\Entity\GemsOrderInterface;
use Drupal\my_common\Entity\GemsEntityChangedTrait;
use Drupal\my_common\Entity\GemsEntityCreatedTrait;

/**
 * Defines the OLB entity.
 *
 * @ContentEntityType(
 *   id = "olb",
 *   label = @Translation("Order Line Bundleable"),
 *   base_table = "order_line_bundleable",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "bundle" = "type",
 *     "label" = "title"
 *   },
 *   handlers = {
 *     "form" = {
 *       "default" = "Drupal\be\Form\OrderLineBundleableEntityForm",
 *       "add" = "Drupal\be\Form\OrderLineBundleableEntityForm",
 *       "edit" = "Drupal\be\Form\OrderLineBundleableEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *     "list_builder" = "Drupal\be\OrderLineBundleableListBuilder",
 *     "access" = "Drupal\my_common\Access\MyEntityAccessControlHandler",
 *     "permission_provider" = "Drupal\my_common\MyEntityPermissionProvider",
 *   },
 *   links = {
 *     "canonical" = "/olb/{olb}",
 *     "add-page" = "/olb/add",
 *     "add-form" = "/olb/add/{olb_type}",
 *     "edit-form" = "/olb/{olb}/edit",
 *     "delete-form" = "/olb/{olb}/delete",
 *     "collection" = "/admin/content/olb",
 *   },
 *   admin_permission = "administer site configuration",
 *   bundle_entity_type = "olb_type",
 *   field_ui_base_route = "entity.olb_type.edit_form",
 * )
 */
class OrderLineBundleable extends ContentEntityBase implements OrderLineBundleableInterface {

  use MyEntityCreatedTrait;
  use MyEntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields += static::createdBaseFieldDefinitions($entity_type);
    $fields += static::changedBaseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Title'))
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['author'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(new TranslatableMarkup('Author'))
      ->setSetting('target_type', 'user')
      ->setDefaultValueCallback(static::class . '::getDefaultEntityAuthor');

    $fields['amount'] = BaseFieldDefinition::create('commerce_price')
      ->setLabel(new TranslatableMarkup('Amount'))
      ->setDescription(new TranslatableMarkup('The total price.'))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['order'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(new TranslatableMarkup('Order'))
      ->setSetting('target_type', 'gems_order')
      ->setSetting('handler', 'default')
      ->setCardinality(1)
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

  /**
   * Default value callback for 'author' base field.
   *
   * @return mixed
   *   A default value for the author field.
   */
  public static function getDefaultEntityAuthor() {
    return \Drupal::currentUser()->id();
  }

  /**
   * {@inheritdoc}
   */
  public function getAmount(): float {
    if (!empty($this->get('amount')->number)) {
      return round($this->get('amount')->number, 2);
    }
    return 0;
  }

  /**
   * {@inheritdoc}
   */
  public function getCurrency(): string {
    return $this->get('amount')->currency_code ?? '';
  }

  /**
   * {@inheritdoc}
   */
  public function getOrderId(): ?string {
    return $this->get('order')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function getOrder(): ?GemsOrderInterface {
    return $this->get('order')->entity;
  }

}
