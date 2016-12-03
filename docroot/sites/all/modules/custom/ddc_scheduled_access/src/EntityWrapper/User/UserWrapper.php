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
   * @param $user
   */
  public function __construct($user) {
    parent::__construct('user', $user);
  }

  /**
   * Returns an array of grants based on the user ID and the operation.
   *
   * @param string $op
   *
   * @return array
   *   Array of UIDs keyed by grant IDs.
   */
  public function nodeGrants($op) {
    $grants = [];
    $uid = $this->uid->value();
    $node_wrapper = $this->getNodeWrapper();
    if ($node_wrapper) {
      $restricted = $node_wrapper->nodeAccessScheduled();
      // Give grant if the user is not anonymous and the operation is "view".
      if ((!$restricted) || ($restricted && $uid && $op == 'view')) {
        $grants['ddc_scheduled_access_registered'] = [NodeWrapper::DDC_SCHEDULED_ACCESS_GRANT];
      }
    }
    return $grants;
  }

  public function getNodeWrapper() {
    if (arg(0) == 'node' && is_numeric(arg(1))) {
      $nid = arg(1);
      return new NodeWrapper($nid);
    }
  }

}
