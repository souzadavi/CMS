<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Wordpress_model extends CI_Model {
    const TABLE			= 'wp_posts';
    function __construct() {
        parent::__construct();
        $this->wordpress = $this->load->database('wordpress', TRUE);
    }
    /**
     * Get user record by Id
     *
     * @param	int
     * @param	bool
     * @return	object
     */
	 
    function getAllPosts($limit='3') {
       $this->wordpress->order_by("id DESC");
	   $this->wordpress->where("post_type","post");
   	   $this->wordpress->where("post_parent","0");
	   $this->wordpress->where("post_status","publish");
       return $this->wordpress->get(self::TABLE,$limit);
    }
}