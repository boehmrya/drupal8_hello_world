<?php

namespace Drupal\hello_world;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;



/**
* Prepares the salutation to the world.
*/
class HelloWorldSalutation {
  use StringTranslationTrait;

  /**
  * @var \Drupal\Core\Config\ConfigFactoryInterface
  */
  protected $configFactory;

  /**
    * HelloWorldSalutation constructor.
    *
    * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
    */
    public function __construct(ConfigFactoryInterface $config_factory) {
      $this->configFactory = $config_factory;
    }

  /**
    * Returns the salutation
    */
    public function getSalutation() {
      $config = $this->configFactory->get('hello_world.custom_salutation');
      $salutation = $config->get('salutation');
      if ($salutation != "") {
        return $salutation;
      }

      $time = new \DateTime();
      $time->setTimezone(new \DateTimeZone('America/New_York'));
      if ((int) $time->format('G') >= 06 && (int) $time->format('G') < 12) {
        return $this->t('Good morning world');
      }
      if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
        return $this->t('Good afternoon world');
      }
      if ((int) $time->format('G') >= 18 || (int) $time->format('G') < 06) {
        return $this->t('Good evening world');
      }
    }
}
