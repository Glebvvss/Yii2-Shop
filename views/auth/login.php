<?php
  $this->title = 'E-Shop | login';
  use yii\widgets\ActiveForm;
?>

<div class="content">
  <div class="container">
    <div class="login-page">
      <div class="account_grid">
        <div class="col-md-6 col-sm-12 col-xs12 " style="margin-top: 20px;" data-wow-delay="0.4s"><!-- login-left wow fadeInLeft -->
          <h2>NEW CUSTOMERS</h2>
          <p style="color: #CAC9C9; margin-bottom: 20px;">By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
          <a class="acount-btn" style="margin-bottom: 30px;" href="<?=Yii::$app->urlManager->createUrl('auth/registration')?>">Create an Account</a>
        </div>
        <div class="col-md-6 col-sm-12 col-xs12 reg" data-wow-delay="0.4s"><!-- login-right -->
          <h3>REGISTERED CUSTOMERS</h3>
          <p>If you have an account with us, please log in.</p>
          
          <? $login_form = ActiveForm::begin(['errorCssClass' => '']); ?>
            <span>Email Address<label>*</label></span>
            <?= $login_form->field($login_model, 'email')->label(false)->textInput(['class' => '']); ?>
            <span>Password<label>*</label></span>
            <?= $login_form->field($login_model, 'password')->label(false)->passwordInput(['class' => '']); ?>
            <a class="forgot" id="passwprd-forgot" href="<?= Yii::$app->urlManager->createUrl('auth/forget-password') ?>">Forgot Your Password?</a>
            <input type="submit" value="Login">
          <? ActiveForm::end(); ?>

        </div>
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
</div>

<!-- модальное окно -->
<div id="modal-forgot-password">
  <div><!-- id="modal-order-user" -->
    <? $email_form = ActiveForm::begin([
      'enableClientValidation' => false,
      'enableAjaxValidation' => true,
      'validationUrl' => '/auth/forget-password',
      'action' => Yii::$app->urlManager->createUrl('auth/forget-password')
    ]); ?>
    <?= $email_form->field($forget_password_model, 'email') ?>
    <div class="flex"><input class="submit-button" type="submit" value="Get Password"></div>
    <? ActiveForm::end(); ?>
  </div>
</div>
<div id="overlay"></div>
