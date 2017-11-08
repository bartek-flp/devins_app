<?php

namespace Drupal\cke_youtube\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginInterface;
use Drupal\ckeditor\CKEditorPluginButtonsInterface;
use Drupal\Component\Plugin\PluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "Youtube" plugin, with a CKEditor.
 *
 * @CKEditorPlugin(
 *   id = "youtube",
 *   label = @Translation("Youtube Plugin")
 * )
 */
class Youtube extends PluginBase implements CKEditorPluginInterface, CKEditorPluginButtonsInterface {

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return drupal_get_path('module', 'cke_youtube') . '/js/plugins/youtube/plugin.js';
  }

  /**
   * @return array
   */
  public function getButtons() {
    $iconImage = drupal_get_path('module', 'cke_youtube') . '/js/plugins/youtube/images/icon.png';

    return [
      'Youtube' => [
        'label' => t('Add Youtube Video'),
        'image' => $iconImage,
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

}
