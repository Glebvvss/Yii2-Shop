<?
use yii\widgets\ActiveForm;
$this->title = 'E-SHOP | Account';
?>

<div class="registration-form">
    <div class="container">
        <div class="dreamcrub">
            <ul class="breadcrumbs">
                <li class="home">
                    <a href="<?=Yii::$app->urlManager->createUrl('site/index')?>" title="Go to Home Page">Home</a>&nbsp;
                    <span>&gt;</span>
                </li>
                <li class="women">
                    Registration
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <h2>Registration</h2>
        <div class="registration-grids">
            <div class="reg-form">
                <div class="reg">
                    <p>On this page you can update information about you!</p>

                    <? $f = ActiveForm::begin([
                        'enableClientValidation' => false,
                        'enableAjaxValidation' => true,
                        'validationUrl' => '/site/account',
                        'options' => ['enctype' => 'multipart/form-data']
                    ]); ?>
                    <ul>
                        <li class="text-info">First Name: </li>
                        <li><?=$f->field($account_model, 'first_name')->label(false)->textInput(['class' => '', 'value' => $user->first_name])?></li>
                    </ul>
                    <ul>
                        <li class="text-info">Last Name: </li>
                        <li><?=$f->field($account_model, 'last_name')->label(false)->textInput(['class' => '', 'value' => $user->last_name])?></li>
                    </ul>
                    <ul>
                        <li class="text-info">Mobile Number:</li>
                        <li><?=$f->field($account_model, 'mobile_phone')->label(false)->textInput(['class' => '', 'value' => $user->mobile_phone])?></li>
                    </ul>
                    <ul>
                        <li class="text-info">Image File:</li>
                        <li><?=$f->field($account_model, 'image')->fileInput()->label(false)?></li>
                    </ul>
                    <input class="" type="submit" value="CONFIRM UPDATES">
                    <? ActiveForm::end(); ?>

                </div>
            </div>
            <div class="reg-right">
                <h3>Completely Free Account</h3>
                <div class="strip"></div>
                <p>Pellentesque neque leo, dictum sit amet accumsan non, dignissim ac mauris. Mauris rhoncus, lectus tincidunt tempus aliquam, odio
                    libero tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
                <h3 class="lorem">Lorem ipsum dolor.</h3>
                <div class="strip"></div>
                <p>Tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>