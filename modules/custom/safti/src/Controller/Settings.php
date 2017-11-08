<?php

namespace Drupal\safti\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Config\ConfigFactoryInterface;

class Settings extends ControllerBase {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  public function __construct(ConfigFactoryInterface $configFactory) {

    $this->configFactory = $configFactory;

  }

  public function getSettings() {

    $sid = $this->configFactory->get('safti.tpay_settings_page')->get('safti_sid');
    $cod = $this->configFactory->get('safti.tpay_settings_page')->get('safti_cod');
    $ip = $this->configFactory->get('safti.tpay_settings_page')->get('safti_ip');

    return [
      'sid' => $sid,
      'cod' => $cod,
      'ip' => $ip,
    ];

  }

}
