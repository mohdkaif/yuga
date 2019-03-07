<?php
    $news_id = $this->uri->segment(4);
    @$home_row = $this->db->select('position')->from('news_position')->where('news_id',$news_id)->where('page','home')->get()->row_array();
    @$other_row = $this->db->select('page,position')->from('news_position')->where('news_id',$news_id)->where('page !=','home')->get()->row_array();
  
    $bu = base_url();

?>


<?php
$user_type = $this->session->userdata('user_type');
if (($user_type == 3) || ($user_type == 4)) {
    include("view_left_menu.php");
} else if($user_type==2){
    include("user_left_menu_view.php");
}else if($user_type==1){
    include("modaretor_left_menu_view.php");
}
?>

<aside class="right-side">
    <section class="content">  

        <?php
            include('common_file/array_file.php');
            $home_page = (isset($home_row['position'])) ? $home_row['position'] : 0;
            $other_position = (isset($other_row['position'])) ? $other_row['position'] : 0;
            $reference = (isset($row['reference'])) ? $row['reference'] : '0';
            $attributes = array('class' => 'myform', 'name' => 'f_name', 'id' => 'myform', 'onsubmit' => 'return FormValidation()');
            echo form_open_multipart('admin/News_edit/update/' . $news_id, $attributes);
        ?>
        <!-- old data hold for update............................................................. start -->
            <input type="hidden" name="home_page_old" value="<?php echo @($home_row['position'] != '') ? $home_row['position'] : 0; ?>" />
            <input type="hidden" name="other_page_old" value="<?php echo @($other_row['page'] != '') ? $other_row['page'] : 0; ?>" />
            <input type="hidden" name="other_position_old" value="<?php echo @($other_row['position'] != '') ? $other_row['position'] : 0; ?>" />
            <input type="hidden" name="image_old" id="image_old" value="<?php echo @$row['image']; ?>" />
            <input type="hidden" name="news_id" value="<?php echo @$news_id; ?>" />
        <!-- old data hold for update............................................................... end -->
        
        <div class="row">
            <!-- <div class="col-lg-4 col-xs-6 form-inline">
                <fieldset><legend><?php echo display('position');?></legend>
                    <table>
                        <tr>
                            <td><?php echo display('category');?></td>
                            <td>
                                <select name="other_page" class="form-control">
                                <?php foreach ($categories as  $value) {
                                   echo '<option value="'.$value->slug.'">'.$value->category_name.'</option>';
                                } ?> 
                                </select>
                            </td>
                        </tr>

                    </table>
                </fieldset>
            </div> -->

    <?php
        if($this->session->flashdata('exception')){
    ?>
        <div class="row">
            <div class="alert alert-danger fade in">
                <span class="close" data-dismiss="alert">×</span>
                <b><?php echo $this->session->flashdata('exception'); ?></b>
            </div>
        </div>
    <?php
        }
    ?>

            <div class="col-lg-3 col-xs-6 form-inline">
                <fieldset><legend><?php echo display('position');?></legend>
                    <table>
                       <tr>
                        <td><?php echo display('home');?></td>
                        <td><?php echo form_dropdown('home_page', $home_position, $home_page, 'class="form-control"'); ?></td>
                    </tr>

                        <tr>
                            <td><?php echo display('category');?></td>
                            <td>
                                <select name="other_page" class="form-control">
                                <?php foreach ($categories as  $value) {
                                   echo '<option value="'.$value->slug.'">'.$value->category_name.'</option>';
                                } ?> 
                                </select>
                            </td>
                        </tr>

                    
                    <tr>
                        <td><?php echo display('position');?></td>
                        <td><?php echo form_dropdown('other_position', @$other_positions, @$other_position, 'class="other_position form-control"'); ?></td>
                    </tr>

                    </table>
                </fieldset>
            </div>


            <div class="col-lg-4 col-xs-6 form-inline">
                <fieldset><legend><?php echo display('photovideos');?></legend>
                    <table>
                        <tr>
                            <th><?php echo display('photo');?></th><th>:</th><td>
                                <input type="file" name="file_select_machin" accept="image/*" id="file_select_machin" />
                               
                                <!-- Old Image-->
                                
                                <?php if($row['image']!=null) {

                                    $img_url = (is_file('uploads/' . $row['image'])) ? $bu . 'uploads/' . $row['image'] : $bu . 'uploads/' . $row['image']; 

                                    ?>
                                    <img src="<?php echo $img_url;?>" alt="" width="150px" height="150px" id="old-image">
                                    <div class="delete_fields" data-request="remove" data-target="#old-image">
                                        <a href="javascript:void(0);"><img src="<?php echo $bu;?>/uploads/del_icon.png"></a>
                                    </div>
                                <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo display('photo_name');?></th><th>:</th>
                            <td>
                                <input type="text" name="picture_name" value="" style="width:100px;"  class="form-control"/>
                                <input type="text" readonly="readonly" name="lib_file_selected" id="lib_file_selected" value="" class="form-control" style="width:60px;" />
                                <?php echo anchor_popup('admin/News_post/my_window/', 'Library', $nw_img_search); ?>
                            </td>
                        </tr>

                    </table>
                </fieldset>
            </div>

            <div class="col-lg-5 col-xs-6 form-inline">
                <fieldset><legend><?php echo display('optional');?></legend>
                    <table>
                        <tr>
                            <th><?php echo display('ref');?></th><th>:</th><td><input type="text" name="reference" value="<?php echo $row['reference']; ?>"  class="form-control"/></td>
                            <th> <?php echo display('post_date');?></th><th>:</th><td><input type="text" name="ref_date" value="<?php echo $row['post_date']; ?>" class="form-control datepicker" /></td>
                        </tr>
                        <tr>
                            <th><?php echo display('video_url');?></th><th>:</th><td><input type="text" name="videos" value="<?php echo $row['videos']; ?>"  class="form-control"/></td>
                            <th><?php echo display('reporter');?></th><th>:</th><td><input type="text" name="reporter" value="<?php echo $row['name']; ?>"  class="form-control"/></td>
                        </tr>
                        <tr>
                          <th> <?php echo display('publish_date');?></th><th>:</th><td><input type="text" name="publish_date" value="<?php echo $row['publish_date']?>" class="form-control datepicker" /></td>
                         </tr>
                    </table>
                </fieldset>
            </div>
        </div>

        <div class="voffset2"></div>
        <div class="row-fluid">
            <fieldset>
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <input type="hidden"  name="post_by" value="<?php echo $row['post_by']; ?>"/>

                        

                        <th> <?php echo display('head_line');?></th>

                        <td width="60%">
                            <input type="text" class="form-control" name="head_line" value="<?php echo $row['title']; ?>" style="width:99%;" />
                        </td>
                        <th><?php echo display('short_head');?></th><td><input type="text" name="short_head" class="form-control" value="<?php echo $row['stitle']; ?>"/></td>
                    </tr>
                    <tr>
                        <th> <?php echo display('slug');?></th>
                        <td width="60%"><input type="text" name="slug" style="width:99%;" value="<?php echo $row['slug']; ?>" class="form-control"></td>
                    </tr>

                </table>
            </fieldset>
        </div>
        <div class="row-fluid">
            <fieldset><legend><?php echo display('details');?></legend>
                <table width="100%">
                    <tr>
                    <textarea  name="details_news" rows="10" cols="80"><?php echo $row['news']; ?></textarea>
                    </tr>

                </table>
            </fieldset>
        </div>
        <div class="row" style="margin: 10px;"></div>
        <div class="row-fluid">
            <table width="100%">
                <tr>
                    <td>
                         <?php echo display('meta_keyword');?>: <input type="text" name="meta_keyword" id="tags" class="form-control" value="<?php echo @$seo_info['meta_keyword']; ?>">
                        <?php echo display('meta_description');?>:<textarea class="form-control" name="meta_description"><?php echo @$seo_info['meta_description']; ?></textarea>
                    </td>
                </tr>
            </table>
        </div>
        <br/>
        <div class="row">
            <fieldset>
                <table width="100%">
                    <tr>
                        <td align="right">
                            <input type="reset" value="<?php echo display('reset');?>" class="btn btn-danger" />
                            <input type="submit" name="" value="<?php echo display('update');?>" class="btn btn-primary" />
                        </td>
                    </tr>
                </table>
            </fieldset>
        </div>
    <?php
        echo form_close();
    ?>
    </section>
</aside>
<script type="text/javascript">
    document.forms['f_name'].elements['other_page'].value="<?php echo $row['page'];?>";


    $(document).on('click', '[data-request="remove"]', function(){
        var $this = $(this);
        var $target = $this.attr('data-target');
        $($target).hide('slow', function(){ $($target).remove(); });
        $('#image_old').val("");
       
    });
</script>

