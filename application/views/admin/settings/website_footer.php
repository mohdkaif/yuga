<?php
$this->load->view('admin/view_left_menu.php');
?>
<aside class="right-side">
    <?php
    if ($previous_settings != false) {
        extract((array) json_decode($previous_settings));
    }
    ?>
    <section class="content col-sm-8">    
        <div class="page_heading"><i class="glyphicon glyphicon-cog"></i>&nbsp; Website Footer </div>
       
       <?php
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><b>';
            echo $this->session->flashdata('message');
            echo '</b></div>';
        }
        if ($this->session->flashdata('exception')) {
            echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><b>';
            echo $this->session->flashdata('exception');
            echo '</b></div>';
        }
        $attributs = array('method' =>'post' );
        echo form_open('admin/View_setup/save_website_footer',$attributs);
        ?>
        <div class="form-group">
                <div class="row single_field">
                    <div class="col-sm-3"><label>Email: </label></div>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" required="1" id="per_page_view" value="<?php echo @$email; ?>">
                    </div>
                </div> 
                <div class="row single_field">
                    <div class="col-sm-3"><label>Phone: </label></div>
                    <div class="col-sm-9">
                        <input type="text" name="phone" class="form-control" required="1" id="per_page_view" value="<?php echo @$phone; ?>">
                    </div>
                </div> 
                <div class="row single_field">
                    <div class="col-sm-3"><label>Address: </label></div>
                    <div class="col-sm-9">
                        <input type="text" name="address" class="form-control" required="1" id="per_page_view" value="<?php echo @$address; ?>">
                    </div>
                </div> 
<!--                 <div class="row single_field">
                    <div class="col-sm-3"><label><?php echo display('website_footer')?></label></div>
                    <div class="col-sm-9">
                        <input type="text" name="website_footer" class="form-control" required="1" id="per_page_view" value="<?php echo @$website_footer; ?>">
                    </div>
                </div>  -->
                <div class="row single_field">
                    <div class="col-sm-3"><label><?php echo display('copy_right')?></label></div>
                    <div class="col-sm-9">
                        <input type="text" name="copy_right" class="form-control" required="1" value="<?php echo @$copy_right; ?>">
                    </div>
                </div>               
                <div class="row single_field">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <input type="submit" name="save" value="<?php echo display('update')?>" class="btn btn-primary">
                    </div>
                </div> 
            </div>                     
       <?php echo form_close();?>
    </section>
</aside>