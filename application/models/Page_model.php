<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

#-------------------------------
# construct function
#-------------------------------      
    function __construct() {
        parent::__construct();
    }
#-------------------------------
# explode Title
#-------------------------------
    function explodedtitle($title) {
        return @trim(@implode('-', @preg_split("/[\s,-\:,()]+/", @$title)), '');
    }
#-------------------------------
# string_clean
#-------------------------------
    function string_clean($string) {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        return $text = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
#-------------------------------
# page_data
#-------------------------------
    function page_data($page=NULL) { 

        $PN = array();
        $bu = base_url();
        $i = 1;
       $newses = $this->db->select('news_position.*,news_mst.*,user_info.id,user_info.name,user_info.photo')
        ->from('news_position')
        ->join('news_mst', 'news_mst.news_id=news_position.news_id')
        ->join('user_info', 'user_info.id=news_mst.post_by')
        ->where('news_position.page', $page)
        ->where('news_position.status',1)
        ->where('news_position.position >',0)
        ->where('news_mst.publish_date <=',date("Y-m-d"))
        ->order_by('news_position.position', 'asc')
        ->order_by('news_position.news_id', 'DESC')
        ->get()
        ->result_array();


        foreach ($newses as $data){

            $this->db->select('categories.*');
            $this->db->from('categories');
            $this->db->where('categories.slug', $data['page']);
            @$slugrow = $this->db->get()->row_array();
            

            @$splited_TITLE = $this->string_clean($this->explodedtitle($data['title']));
            @$splited_SLUG = $this->string_clean($this->explodedtitle($data['slug']));

            @$news_dtl = implode(' ', array_slice(explode(' ', $data['news']), 0, 30));

            $this->db->select('categories.*');
            $this->db->from('categories');
            $this->db->where('categories.slug', $data['page']);
            @$newrow = $this->db->get()->row_array();
            //editor images
            @$PN['post_by_image_' . $i] =  base_url() . $data['photo'] ;
            // editor name
            if($data['reporter'] !=null){
                    @$PN['post_by_name_' . $i] = $data['reporter'];
                }else{
                     @$PN['post_by_name_' . $i] = $data['name'];
            }
           
            // category name
            @$PN['category_' . $i] = $data['page'];

            @$PN['category_name_' . $i] = $newrow['category_name'];
            // category link
            @$PN['category_link_' . $i] = base_url().$data['page'];
            // video id
            @$PN['video_' . $i] = $data['videos'];
            //post time
            $PN['ptime_' . $i] =  $data['time_stamp'];
            //news id
            @$PN['news_id_' . $i] = $data['news_id'];
            //News Title
            @$PN['news_title_' . $i] = $data['title'];
            //Short Title 
            @$PN['stitle_' . $i] = $data['stitle'];
            //Spilt Title  
            @$PN['splted_title_' . $i] = $this->string_clean($splited_TITLE);
            //News Title With Link
            @$PN['title_' . $i] = '<a href="' . base_url() . $data['page'] . '/' . $data['news_id'] . '/' . $splited_TITLE . '">' . $data['title'] . '</a>';
            //Short News from XML data
            @$PN['news_' . $i] = strip_tags($news_dtl . '<a href="' . $bu . 'home/' . $data['news_id'] . '/' . $splited_TITLE . '" class="details_link">  </a>', '<p><a>');
            // full news
            @$PN['full_news_' . $i] = strip_tags($data['news'], '<p><a>');
            //Only News Link Creation
           /* @$PN['news_link_' . $i] = base_url() . $data['page'] . '/story/' . $data['news_id'] . '/' . $splited_SLUG;*/
            @$PN['news_link_' . $i] = base_url() . 'Story/' . $slugrow['slug'] . '/' . $splited_SLUG;
            //Image name
            @$PN['image_' . $i] = $data['image'];
            // image chack
            @$PN['image_check_' . $i] = $data['image'];
            //Thumb Image 
            @$PN['image_thumb_' . $i] = base_url() . 'uploads/thumb/' . $data['image'];
            //Large Image Creation
            @$PN['image_large_' . $i] = base_url() . 'uploads/' . $data['image'];
            
           ### Image Group End  ###
            $i++;
        }
        return $NEWS_ARR = array('pn' => $PN);
    }

#-------------------------------
# count_total_news_by_category
#-------------------------------
    function count_total_news_by_category($category_slug) {
        $total_news = $this->db->select('*')
                ->from('news_mst')
                ->where('page', $category_slug)
                ->where('publish_date <=',date("Y-m-d"))
                ->get()
                ->num_rows();
        return $total_news;
    }


}
