<?php

namespace Drupal\ddc_scheduled_access\EntityWrapper\Node;

use \EntityDrupalWrapper;

/**
 * Class NodeWrapper.
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
   * Property to store the raw node object.
   *
   * @var \stdClass
   */
  protected $nodeObject;

  /**
   * NodeWrapper constructor.
   *
   * @param \stdClass $node
   *   Drupal node object.
   */
  public function __construct(\stdClass $node) {
    parent::__construct('node', $node);
    if (is_object($node)) {
      $this->nodeObject = $node;
    }
  }

  /**
   * Sets the access record for the node.
   *
   * @return array|null
   *   Returns an array of grants or null.
   */
  public function setAccessRecords() {
    // Ignore the node unless it's an article.
    if ($this->getBundle() != self::DDC_SCHEDULED_ACCESS_BUNDLE) {
      return NULL;
    }
    // Ignore the node unless it's access is scheduled.
    if (!$this->hasScheduledAccess()) {
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
   * Checks if the node has scheduled field values.
   *
   * @return int
   *   Timestamp of the scheduled access date or 0 if it has no values.
   */
  public function hasScheduledValues() {
    $access = $this->field_limit_access->value();
    $date = $this->field_access_date->value();
    if ($access && $date) {
      return $date;
    }
    return 0;
  }

  /**
   * Checks if the current node access is scheduled in the future.
   *
   * @return bool
   *   True if the node has scheduled access, otherwise false.
   */
  public function hasScheduledAccess() {
    $scheduled = $this->hasScheduledValues();
    if ($scheduled && time() < $scheduled) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Checks if the scheduled access date has expired, if the node has one.
   *
   * @return bool
   *   Returns true if the node has scheduled access but it has now expired.
   */
  public function scheduledAccessExpired() {
    $scheduled = $this->hasScheduledValues();
    if ($scheduled && time() >= $scheduled) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Checks the grants on the node and updates them.
   */
  public function verifyGrants() {
    if ($this->getBundle() != self::DDC_SCHEDULED_ACCESS_BUNDLE) {
      return NULL;
    }
    if ($this->scheduledAccessExpired()) {
      node_access_acquire_grants($this->nodeObject);
    }
  }

}
