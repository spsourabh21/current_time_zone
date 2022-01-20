<?php

namespace Drupal\current_time_zone\Plugin\Block;

use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\current_time_zone\Services\TimeZoneService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Cache\Cache;

/**
 * DisplayTimeZone Block.
 *
 * @Block(
 *   id = "diaplay_time_zone",
 *   admin_label = @Translation("Display Time Zone"),
 *   category= @Translation("Custom"),
 * )
 */
class DisplayTimeZone extends BlockBase implements ContainerFactoryPluginInterface
{
  /**
   * The time zone service.
   *
   * @var Drupal\current_time_zone\Services\TimeZoneService
   */
  protected $timeZoneService;

  /**
   * @var Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * DisplayTimeZone constructor.
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param TimeZoneService $time_zone_service
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimeZoneService $time_zone_service, ConfigFactoryInterface $config_factory)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timeZoneService = $time_zone_service;
    $this->configFactory = $config_factory;
  }

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_time_zone.time_zone_service'),
      $container->get('config.factory')
    );
  }

  /**
   * @inheritDoc
   */
  public function build()
  {
    $timeZoneConfig = $this->configFactory->get('current_time_zone.settings');
    $currentTimeArray['country'] = $timeZoneConfig->get('country');
    $currentTimeArray['city'] = $timeZoneConfig->get('city');
    $currentTime = $this->timeZoneService->getCurrentTimeBasedOnZone();

    return [
      '#theme' => 'display_time_zone',
      '#data' => $currentTimeArray,
      '#current_time' => $currentTime,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return Cache::mergeContexts(
      parent::getCacheContexts(),
      ['current_time']
    );
  }

}
