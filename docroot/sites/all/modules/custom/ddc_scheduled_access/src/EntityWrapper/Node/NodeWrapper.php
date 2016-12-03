<?php
namespace Drupal\ddc_scheduled_access\EntityWrapper\Node;

use \EntityDrupalWrapper;

/**
 * Class NodeWrapper
 *
 * @package Drupal\ddc_scheduled_access\EntityWrapper\Node
 */
class NodeWrapper extends EntityDrupalWrapper {

  /**
   * Grant ID.
   */
  const DDC_SCHEDULED_ACCESS_GRANT = 1;

  /**
   * Grant realm.
   */
  const DDC_SCHEDULED_ACCESS_REALM = 'ddc_scheduled_access_registered';

  /**
   * Content type/bundle of node.
   */
  const DDC_SCHEDULED_ACCESS_BUNDLE = 'article';

  /**
   * NodeWrapper constructor.
   *
   * @param \stdClass|int $node
   */
  public function __construct($node) {
    parent::__construct('node', $node);
  }

  /**
   * Sets the access record for the node.
   *
   * @return array|null
   */
  public function setAccessRecords() {
    // Ignore the node unless it's an article.
    if ($this->getBundle() != self::DDC_SCHEDULED_ACCESS_BUNDLE) {
      return NULL;
    }
    // Ignore the node unless it's access is scheduled.
    if (!$this->nodeAccessScheduled()) {
      return NULL;
    }
    return [
      [
        'realm' => self::DDC_SCHEDULED_ACCESS_REALM,
        'gid' => self::DDC_SCHEDULED_ACCESS_GRANT,
        // Only published nodes should be viewable.
        'grant_view' => $this->status->value(),
        'grant_update' => 0,
        'grant_delete' => 0,
        'priority' => 0,
      ],
    ];
  }

  /**
   * Checks if the current node access is scheduled.
   *
   * @return bool
   */
  public function nodeAccessScheduled() {
    $access = $this->field_limit_access->value();
    $date = $this->field_access_date->value();
    if ($access && $date && time() < $date) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Removes out-of-date schedule field values from the node.
   */
  public function removeScheduleFields() {
    $this->field_limit_access->set(0);
    $this->field_access_date->set(NULL);
    $this->save();
  }

  /**
   * Set the node access rebuild status.
   */
  public function needsRebuild() {
    if ($this->getBundle() == self::DDC_SCHEDULED_ACCESS_BUNDLE) {
      node_access_needs_rebuild(TRUE);
    }
  }

}
