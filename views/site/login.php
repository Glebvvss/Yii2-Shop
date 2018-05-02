<?php

    $this->title = 'E-Shop | login';
    use yii\widgets\ActiveForm;

    var_dump ( Yii::$app->user->getId() );
?>

<div class="content">
    <div class="container">
        <div class="login-page">
            <div class="dreamcrub">
                <ul class="breadcrumbs">
                    <li class="home">
                        <a href="<?=Yii::$app->urlManager->createUrl('site/index')?>" title="Go to Home Page">Home</a>&nbsp;
                        <span>&gt;</span>
                    </li>
                    <li class="women">
                        Login
                    </li>
                </ul>
                <ul class="previous">
                    <li><a href="index.html">Back to Previous Page</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="account_grid">
                <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
                    <h2>NEW CUSTOMERS</h2>
                    <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                    <a class="acount-btn" href="<?=Yii::$app->urlManager->createUrl('site/registration')?>">Create an Account</a>
                </div>
                <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
                    <h3>REGISTERED CUSTOMERS</h3>
                    <p>If you have an account with us, please log in.</p>

                    <? $f = ActiveForm::begin(); ?>
                        <div>
                            <span>Email Address<label>*</label></span>
                            <?=$f->field($login_model, 'email')->label(false)->textInput(['class' => '']);?>
                        </div>
                        <div>
                            <span>Password<label>*</label></span>
                            <?=$f->field($login_model, 'password')->label(false)->textInput(['class' => '']);?>
                        </div>
                        <a class="forgot" href="#">Forgot Your Password?</a>
                        <input type="submit" value="Login">
                    <? ActiveForm::end(); ?>

                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>
