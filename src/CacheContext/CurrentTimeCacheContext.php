<?php

namespace Drupal\current_time_zone\CacheContext;

use Drupal\Core\Cache\Context\CacheContextInterface;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\current_time_zone\Services\TimeZoneService;

class CurrentTimeCacheContext implements CacheContextInterface
{
  /**
   * @var Drupal\current_time_zone\Services\TimeZoneService
   */
  protected $timeZoneService;

  public function __construct(TimeZoneService $time_zone_service)
  {
    $this->timeZoneService = $time_zone_service;
  }

  /**
   * @inheritDoc
   */
  public static function getLabel()
  {
    return t('Current time cache context');
  }

  /**
   * @inheritDoc
   */
  public function getContext()
  {
    $currentTime = $this->timeZoneService->getCurrentTimeBasedOnZone();
    return $currentTime;
  }

  /**
   * @inheritDoc
   */
  public function getCacheableMetadata()
  {
    return new CacheableMetadata();
  }
}
