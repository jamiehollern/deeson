<?php
namespace Drupal\ddc_scheduled_access\EntityWrapper\User;

use \EntityDrupalWrapper;
use Drupal\ddc_scheduled_access\EntityWrapper\Node\NodeWrapper;

/**
 * Class UserWrapper
 *
 * @package Drupal\ddc_scheduled_access\EntityWrapper\User
 */
class UserWrapper extends EntityDrupalWrapper {

  /**
   * UserWrapper constructor.
   *
   * @param \stdClass $user
   */
  public function __construct($user) {
    parent::__construct('user', $user);
  }

  /**
   * Returns an array of grants based on the user ID and the operation.
   *
   * @param string $op
   *   User action on the node.
   * @return array
   *   Array of UIDs keyed by grant IDs.
   */
  public function nodeGrants($op) {
    $grants = [];
    $uid = $this->uid->value();
    // Give grant if the user is not anonymous and the operation is "view".
    if ($uid && $op == 'view') {
      $grants[NodeWrapper::DDC_SCHEDULED_ACCESS_REALM] = [NodeWrapper::DDC_SCHEDULED_ACCESS_GRANT];
    }
    return $grants;
  }

}
