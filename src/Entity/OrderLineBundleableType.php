<?php

namespace Drupal\be\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Order Line Bundleable Type.
 *
 * @ConfigEntityType(
 *   id = "olb_type",
 *   label = @Translation("Order Line Bundleable Type"),
 *   bundle_of = "olb",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "olb_type",
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   handlers = {
 *     "form" = {
 *       "default" = "Drupal\be\Form\OrderLineBundleableTypeEntityForm",
 *       "add" = "Drupal\be\Form\OrderLineBundleableTypeEntityForm",
 *       "edit" = "Drupal\be\Form\OrderLineBundleableTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *     "list_builder" = "Drupal\be\OrderLineBundleableTypeListBuilder",
 *     "access" = "Drupal\my_common\Access\MyEntityAccessControlHandler",
 *     "permission_provider" = "Drupal\my_common\MyEntityPermissionProvider",
 *   },
 *   admin_permission = "administer site configuration",
 *   links = {
 *     "canonical" = "/admin/structure/olb_type/{olb_type}",
 *     "add-form" = "/admin/structure/olb_type/add",
 *     "edit-form" = "/admin/structure/olb_type/{olb_type}/edit",
 *     "delete-form" = "/admin/structure/olb_type/{olb_type}/delete",
 *     "collection" = "/admin/structure/olb_type",
 *   }
 * )
 */
class OrderLineBundleableType extends ConfigEntityBundleBase implements OrderLineBundleableTypeInterface {}
