        <section class="block-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1><?php echo display('login_and_registration')?></h1>
                        <div class="breadcrumbs">
                            <ul>
                                <li><i class="pe-7s-home"></i> <a href="home-style-one.html" title=""><?php echo display('home')?></a></li>
                                <li><a href="" title=""><?php echo display('login_and_registration')?></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="login-reg-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                    <?php
                     if(validation_errors()){?>
                       <div class="alert alert-danger ">
                            <a href="" class="text-center close" data-dismiss="alert" aria-label="close">&times;</a> <strong><?php  echo validation_errors(); ?></strong>
                       </div>
                    <?php } ?>  
                    <?php 
                        $msg = $this->session->flashdata('msg');
                         if(!empty($msg)){
                            echo $msg;
                        }
                    ?>
                    <?php 
                        if($this->session->flashdata('message')){
                            echo '<div class="alert alert-success ">
                           <a href="#" class="text-center close" data-dismiss="alert" aria-label="close">&times;</a> <strong>'.$this->session->flashdata('message').'</strong>
                           </div>';
                        }
                        if($this->session->flashdata('exception')){
                            echo '<div class="alert alert-danger ">
                           <a href="#" class="text-center close" data-dismiss="alert" aria-label="close">&times;</a> <strong>'.$this->session->flashdata('exception').'</strong>
                           </div>';
                        }
                    ?>
                    </div>


                    <div class="col-sm-6">
                        <div class="login-form-inner">
                            <h3 class="category-headding "><?php echo display('login_to_your_account')?></h3>
                            <div class="headding-border bg-color-1"></div>
                           <?php echo form_open('check_user'); ?>
                                <label><?php echo display('email')?> <sup>*</sup></label>
                                <input type="text" class="form-control" id="name_email" name="email" placeholder="<?php echo display('email')?>">
                                <label><?php echo display('password')?> <sup>*</sup></label>
                                <input type="password" class="form-control" id="pass" name="password" placeholder="*******">
                                <label class="checkbox-inline"><input type="checkbox" value=""><?php echo display('remember_me')?></label>
                                <button type="submit" class="btn btn-style"><?php echo display('login')?></button>
                                <div class="foeget"><a href="#"><?php echo display('forget_username_password')?></a></div>
                             <!--   <div class="row">
                                    <div class="col-sm-6">
                                        <div class="social_icon">
                                            <div class="social_icon_box social_icon_box_1">
                                                <div class="icon facebook-icon"></div>
                                                <a href="<?php echo $this->facebook->login_url(); ?>" class="social_info"><?php echo display('login_with_facebook')?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="social_icon">
                                            <div class="social_icon_box social_icon_box_2">
                                                <div class="icon google-plus-icon"></div>
                                                <a href="<?php echo $login_url?>" class="social_info"><?php echo display('login_with_google')?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            <?php echo form_close();?>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="register-form-inner">
                            <h3 class="category-headding "><?php echo display('registration')?></h3>
                            <div class="headding-border bg-color-1"></div>

                            <?php echo form_open('registration')?>
                                <label><?php echo display('full_name')?> <sup>*</sup></label>
                                <input type="text" class="form-control" value="<?php echo set_value('name'); ?>" id="name" name="name" placeholder="<?php echo display('full_name')?>">
                                <label><?php echo display('email')?> <sup>*</sup></label>
                                <input type="text" class="form-control" value="<?php echo set_value('email'); ?>" id="name_email_2" name="email" placeholder="<?php echo display('email')?>">
                                <label><?php echo display('password')?> <sup>*</sup></label>
                                <input type="password" class="form-control" value="<?php echo set_value('password'); ?>" id="pass_2" name="password" placeholder="<?php echo display('password')?>">
                                <button type="submit" class="btn btn-style"><?php echo display('registration')?></button>
                            <?php echo form_close();?>
                        </div>
                    </div>

                </div>
            </div>
        </section>