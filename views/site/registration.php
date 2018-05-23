<?
    use yii\widgets\ActiveForm;
    $this->title = 'E-SHOP | Registration';
?>

<div class="registration-form">
    <div class="container">
        <div class="dreamcrub">
            <ul class="breadcrumbs">
                <li class="home">
                    <a href="index.html" title="Go to Home Page">Home</a>&nbsp;
                    <span>&gt;</span>
                </li>
                <li class="women">
                    Registration
                </li>
            </ul>
            <ul class="previous">
                <li><a href="index.html">Back to Previous Page</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <h2>Registration</h2>
        <div class="registration-grids">
            <div class="reg-form">
                <div class="reg">
                    <p>Welcome, please enter the following details to continue.</p>
                    <p>If you have previously registered with us, <a href="#">click here</a></p>

                    <? $f = ActiveForm::begin([
                        'enableClientValidation' => false,
                        'enableAjaxValidation' => true,
                        'validationUrl' => '/site/registration',
                        'options' => ['enctype' => 'multipart/form-data']
                    ]); ?>
                        <ul>
                            <li class="text-info">First Name: </li>
                            <li><?=$f->field($reg_model, 'first_name')->label(false)->textInput(['class' => ''])?></li>
                        </ul>
                        <ul>
                            <li class="text-info">Last Name: </li>
                            <li><?=$f->field($reg_model, 'last_name')->label(false)->textInput(['class' => ''])?></li>
                        </ul>
                        <ul>
                            <li class="text-info">Username: </li>
                            <li><?=$f->field($reg_model, 'username')->label(false)->textInput(['class' => ''])?></li>
                        </ul>
                        <ul>
                            <li class="text-info">Email: </li>
                            <li><?=$f->field($reg_model, 'email')->label(false)->textInput(['class' => ''])?></li>
                        </ul>
                        <ul>
                            <li class="text-info">Password: </li>
                            <li><?=$f->field($reg_model, 'password')->label(false)->textInput(['class' => ''])?></li>
                        </ul>
                        <ul>
                            <li class="text-info">Re-enter Password:</li>
                            <li><?=$f->field($reg_model, 'confirm_password')->label(false)->textInput(['class' => ''])?></li>
                        </ul>
                        <ul>
                            <li class="text-info">Mobile Number:</li>
                            <li><?=$f->field($reg_model, 'mobile_phone')->label(false)->textInput(['class' => ''])?></li>
                        </ul>
                        <ul>
                            <li class="text-info">Image File:</li>
                            <li><?=$f->field($reg_model, 'image')->fileInput()->label(false)?></li>
                        </ul>
                        <input class="" type="submit" value="REGISTER NOW">
                        <p class="click">By clicking this button, you are agree to my  <a href="#">Policy Terms and Conditions.</a></p>
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