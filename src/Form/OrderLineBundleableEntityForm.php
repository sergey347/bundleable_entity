<?php

namespace Drupal\be\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class OrderLineBundleableEntityForm.
 */
class OrderLineBundleableEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();

    if ($entity instanceof ContentEntityInterface) {
      $status = parent::save($form, $form_state);

      switch ($status) {
        case SAVED_NEW:
          $this->messenger()->addMessage($this->t('Created the %label.', [
            '%label' => $entity->label(),
          ]));
          break;

        case SAVED_UPDATED:
          $this->messenger()->addMessage($this->t('Saved the %label.', [
            '%label' => $entity->label(),
          ]));
          break;

        default:
          // Nothing.
      }

      $entity_type_id = $entity->getEntityTypeId();

      $form_state->setRedirect("entity.$entity_type_id.collection");
    }
  }

}
