<?php
namespace Drupal\ddc_scheduled_access\EntityWrapper\Node;

use \EntityDrupalWrapper;

/**
 * Class NodeWrapper
 *
 * @package Drupal\ddc_scheduled_access\EntityWrapper\Node
 */
class NodeWrapper extends EntityDrupalWrapper {

  const DDC_SCHEDULED_ACCESS_GRANT = 1;

  /**
   * NodeWrapper constructor.
   *
   * @param \stdClass|int $node
   */
  public function __construct($node) {
    parent::__construct('node', $node);
  }

  public function accessRecords() {
    // Ignore the node unless access is scheduled.
    if ($this->nodeAccessScheduled()) {
      return [
        [
          'realm' => 'ddc_scheduled_access_registered',
          'gid' => self::DDC_SCHEDULED_ACCESS_GRANT,
          // Only published nodes should be viewable.
          'grant_view' => $this->status->value(),
          'grant_update' => 0,
          'grant_delete' => 0,
          'priority' => 0,
        ],
      ];
    }
  }

  /**
   * Checks if the current node access is limited.
   *
   * @return bool
   */
  public function nodeAccessScheduled() {
    $limit = $this->field_limit_access->value();
    $date = $this->field_access_date->value();
    if ($limit && $date && time() < $date) {
      return TRUE;
    }
    return FALSE;
  }

}
