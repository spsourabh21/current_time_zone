<?php

namespace Drupal\current_time_zone\Services;

use DateTime;
use DateTimeZone;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Class TimeZoneService
 * @package Drupal\current_time_zone\Services
 */
class TimeZoneService
{
  /**
   * The config factory object.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  public function __construct(ConfigFactoryInterface $config_factory)
  {
    $this->configFactory = $config_factory;
  }

  public function getCurrentTimeBasedOnZone() {
    $currentTimeArray = [];

    $timeZoneConfig = $this->configFactory->get('current_time_zone.settings');
    $currentTime = new DateTime("now", new DateTimeZone($timeZoneConfig->get('time_zone')));
    $currentTime = $currentTime->format('dS M Y H:i A');

    return $currentTime;
  }
}
