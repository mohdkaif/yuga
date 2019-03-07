<?php defined('BASEPATH') or exit('No direct script access allowed');

class News_post extends CI_Controller {
#----------------------------
#   constructor function                            
#---------------------------- 
public function __construct() {

    parent::__construct();
    #----------------------------------------
        $this->load->library('session');
       /* $this->load->library('javascript');
        $this->load->library('javascript/jquery');*/
        $session_id = $this->session->userdata('session_id'); 
        if($session_id == NULL ) {
         redirect('admin/Sign_out');
        }
        $user_type = $this->session->userdata('user_type'); 

        if(($user_type!=3) AND ($user_type!=4) AND ($user_type!=2)) {
         redirect('admin/Sign_out');
        }
        #----------------------------------------
        

    $this->load->helper('form');
    $this->load->model('admin/Common_function', 'npost');

}

#----------------------------
# To add new post
#----------------------------    
public function index() {

    $data['cat'] = $this->db->select("*")->from('categories')->order_by('position','ASC')->get()->result();  
    $this->load->view('admin/header');
    $this->load->view('admin/menu');
    $this->load->view('admin/view_post',$data);
    $this->load->view('admin/footer');

}


public function get_youtube_id_from_url($url) 
{
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $url, $match)) {
    return $match['1']; 
    }else{
        return $video='';
    }
}

#------------------------------------
#   save post
#------------------------------------    
    public function post() {

        // on page SEO
        $post_keyword = trim($this->input->post('meta_keyword'));
        $post_description = trim($this->input->post('meta_description'));

        if ($post_keyword != '' || $post_keyword != '') {

            $post_meta['meta_keyword'] = $post_keyword;
            $post_meta['meta_description'] = $post_description;
        
        }

        if ($_FILES['file_select_machin']['name']) {

            $pst_imge = $_FILES['file_select_machin']['name'];
            $image_chk = explode(".",$pst_imge);
            $extent = end($image_chk);

            if($extent=="jpg" || $extent=="png" || $extent=="jpeg" || $extent=="gif"){
                $sizes = array(200 => 135, 600 => 400);
                $file_location = $this->npost->do_upload($_FILES['file_select_machin'], $sizes);
              
                if(@$file_location['msg']!=NULL){
                    $this->session->set_flashdata('exception', $file_location['msg']);
                    redirect('admin');
                } else {
                    $image = explode('/', $file_location[0]);
                    $image = end($image);
                }
                
            } else{
                $this->session->set_flashdata('exception','This File Not allowed!');
                redirect('admin/news_post');
            }
            
        } 
        else {
            $image = $this->input->post('lib_file_selected');
        }

    if($this->session->userdata('user_type')==2){

        $d = $this->db->select('post_ap_status,id')->from('user_info')->where('id',$this->session->userdata('id'))->get()->row(); 
        
        if($d->post_ap_status !=0){
            $post_ap_status = 1;
        }else{
            $post_ap_status = 0;
        }
    } else{
         $post_ap_status = $this->input->post('status_confirmed');
    }

        $data = array(
            'home_page' => $this->input->post('home_page'),
            'other_page' => $this->input->post('other_page'),
            'other_position' => $this->input->post('other_position'),
            'image' => $image,
            'picture_name' => $this->input->post('picture_name'),
            'videos' => $this->get_youtube_id_from_url($this->input->post('videos')),
            'stitle' => $this->input->post('short_head'),
            'slug'   => $this->input->post('slug'),
            'title' => $this->input->post('head_line'),
            'reporter' => $this->input->post('reporter'),
            'news' => $this->input->post('details_news'),
            'confirm_dynamic_static' => $this->input->post('confirm_dynamic_static'),
            'latest_confirmed' => $this->input->post('latest_confirmed'),
            'breaking_confirmed' => $this->input->post('breaking_confirmed'),
            'send_to_temp' => $this->input->post('send_to_temp'),
            'reference' => $this->input->post('reference'),
            'ref_date' => $this->input->post('ref_date'),
            'publish_date'      => ($this->input->post('publish_date')!=NULL?$this->input->post('publish_date'):$this->input->post('ref_date')),
            'post_by' => $this->session->userdata('id'),
            'status1' =>  $post_ap_status
        );



        $result = $this->npost->pbnews_post($data);
        $content = array(
        "en" => $this->input->post('head_line')
        );

        $fields = array(
            'app_id' => "a5498cba-95b2-4e78-9cbb-2f62793a40d7",
            'included_segments' => array('All'),
            'data' => array("yugantar title" => $this->input->post('head_line')),
            'large_icon' =>"ic_launcher_round.png",
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic MGU3OWYwMTAtMjcxNy00MmRhLTgxMjYtY2YyMWVhYzYxZTdh'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
    
        $response = curl_exec($ch);
        curl_close($ch);
        
        if (isset($post_meta)) {
            $post_meta['news_id'] = $result['news_id'];
            $this->npost->save_meta_on_page_seo('post_seo_onpage', $post_meta);
        }
       /* @$splited_TITLE = @trim(@implode('-', @preg_split("/[\s,-\:,()]+/", @$data['title'])), '');

        $splited_TITLE = str_replace(' ', '', $splited_TITLE); 
        $text = preg_replace('/[^A-Za-z0-9\-]/', '', $splited_TITLE);

        if($data['other_page']==0){
            $page = 'home';
        }elseif($data['other_page']!=0){
            $page = $data['other_page'];
        }
        $news_link = base_url() . $page . '/details/' . $result['news_id'].'/'.$text;
        $this->load->library("session");

        $this->session->set_userdata("share_url","<?php echo $news_link;?>");
*/
       
        $this->session->set_flashdata('message', display('news_post_msg'));
         
        redirect("admin/News_post");
    }

#----------------------------------------------
#   My window to select  images form library
#----------------------------------------------
    public function my_window() {
        $this->load->view('admin/header');
        $this->load->view('admin/includes/image_search');
        $this->load->view('admin/footer');
    }

#------------------------------------------
#      viewing user interface
#------------------------------------------    
    function user_interface() {
        
        $data['cat'] = $this->db->select("*")->from('categories')->order_by('position','ASC')->get()->result();  
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/view_post',$data);
        $this->load->view('admin/footer');
    }
 

}
