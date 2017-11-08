<?php

namespace Drupal\safti\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\safti\Controller\Settings;

class PaymentForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'PaymentForm';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'safti.payment_form',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $orderId = NULL) {
    $config = $this->config('safti.payment_form');

    $tpaySettings = $this->config('safti.tpay_settings_page');

    $urlFail = $tpaySettings->get('safti_url_fail');
    $urlSuccess = $tpaySettings->get('safti_url_success');
    $urlVerify = $tpaySettings->get('safti_url_verify');

    $toPay = 1;

    $data = array(
      'id'           => $tpaySettings->get('safti_sid'),
      'crc'          => $orderId,
      'kwota'        => $toPay,
      'opis'         => 'Opis',
      'imie'         => '',
      'nazwisko'     => '',
      'ulica'        => '',
      'miasto'       => '',
      'kod'          => '',
      'kraj'         => '',
      'email'        => 'filipiuk.bartek@gmail.com',
      'telefon'      => '',
      'pow_url'      => $urlSuccess,
      'pow_url_blad' => $urlFail,
      'wyn_url'      => $urlVerify,
    );

    $data['md5sum'] = md5($tpaySettings->get('safti_sid') . $toPay . $orderId . $tpaySettings->get('safti_cod'));

    $form['#action'] = 'https://secure.transferuj.pl';

    foreach ($data as $name => $value) {
      if (!empty($value)) {
        $form[$name] = [
          '#type' => 'hidden',
          '#value' => $value,
        ];
      }
    }

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Show me the money!'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->config('safti.payment_form');

    parent::submitForm($form, $form_state);
  }

}
