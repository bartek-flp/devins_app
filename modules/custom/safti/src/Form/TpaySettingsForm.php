<?php

namespace Drupal\safti\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class TpaySettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'TpaySettings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'safti.tpay_settings_page',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('safti.tpay_settings_page');

    $form['safti_description'] = [
      '#markup' => $this->t('Settings for Tpay gateway'),
    ];

    $form['safti_sid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Client sid number'),
      '#default_value' => $config->get('safti_sid'),
    ];

    $form['safti_cod'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Client secret code'),
      '#default_value' => $config->get('safti_cod'),
    ];

    $form['safti_ip'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Tpay IP'),
      '#default_value' => $config->get('safti_ip'),
    ];

    $form['safti_url_fail'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Fail return url'),
      '#default_value' => $config->get('safti_url_fail'),
    ];

    $form['safti_url_success'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Success return url'),
      '#default_value' => $config->get('safti_url_success'),
    ];


    $form['safti_url_verify'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Verify return url'),
      '#default_value' => $config->get('safti_url_verify'),
    ];



    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->config('safti.tpay_settings_page')
      ->set('safti_sid', $form_state->getValue('safti_sid'))
      ->set('safti_cod', $form_state->getValue('safti_cod'))
      ->set('safti_ip', $form_state->getValue('safti_ip'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
