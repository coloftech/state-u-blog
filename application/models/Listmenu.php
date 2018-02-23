<?php

/**
 * Generate HTML for multi-dimensional menu from MySQL database
 * with ONE QUERY and WITHOUT RECURSION 
 * @author J. Bruni
 */
class Listmenu extends CI_Model
{
    /**
     * MySQL connection
     */
    var $conn;

    /**
     * Menu items
     */
    var $items = array();

    /**
     * HTML contents
     */
    var $html  = array();

    var $page;
    /**
     * Create MySQL connection
     */
    function __construct()
    {
    	parent::__construct();
                $this->load->database();
    }


    function get_menu_items()
    {

        $page = ($this->input->get('p')) ? $this->input->get('p') : 'bilar';
        $site_id  = $this->site_m->getSiteId($page);
	    $this->db->select('*');
	    $this->db->from('site_setting');
        $this->db->where(array('site_id'=>$site_id));
	    $this->db->order_by('parent_id', 'ASC');
	    $result = $this->db->get()->result_array();
	    return $result;
    }

    /**
     * Build the HTML for the menu 
     */
    function get_menu_html( $root_id = 0 )
    {
        $page = ($this->input->get('p')) ? $this->input->get('p') : 'bilar';
        $this->html  = array();
        $this->items = Self::get_menu_items();
        //var_dump($this->items);die();
        foreach ( $this->items as $item )
            $children[$item['parent_id']][] = $item;

        // loop will be false if the root has no children (i.e., an empty menu!)
        $loop = !empty( $children[$root_id] );

        // initializing $parent as the root
        $parent = $root_id;
        $parent_stack = array();

        // HTML wrapper for the menu (open)
       // $this->html[] = '<ul>';

        while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_id ) ) )
        {
            if ( $option === false )
            {
                $parent = array_pop( $parent_stack );

                // HTML for menu item containing childrens (close)
                $this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 ) . '</ul>';
                $this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ) . '</li>';
            }
            elseif ( !empty( $children[$option['value']['id']] ) )
            {
                $tab = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 );

                // HTML for menu item containing childrens (open)
                
                    $path =  site_url("c=site&f=view&p=$page&i=").$this->site_m->getSettingNameById($option['value']['id']);//'?c=info&m=getinfo&q='.$option['value']['site_id'];
                
                $this->html[] = sprintf(
                    '%1$s<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">%3$s <span class="caret"></span></i></a>',
                    $tab,   // %1$s = tabulation
                    $path,   // %2$s = link (URL)
                    ucfirst($option['value']['setting_name'])   // %3$s = setting_name
                ); 
                $this->html[] = $tab . "\t" . '<ul  class="dropdown-menu">';

                array_push( $parent_stack, $option['value']['parent_id'] );
                $parent = $option['value']['id'];
            }
            else{
                // HTML for menu item with no children (aka "leaf") 
                 
                    $path =  site_url("c=site&f=view&p=$page&i=").$this->site_m->getSettingNameById($option['value']['id']);
                
                $this->html[] = sprintf(
                    '%1$s<li><a href="%2$s">%3$s</a></li>',
                    str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
                    $path,   // %2$s = link (URL)
                    ucfirst($option['value']['setting_name'])   // %3$s = setting_name
                );
        }
        }
        // HTML wrapper for the menu (close)
        //$this->html[] = '</ul>';

        return implode( "\r\n", $this->html );
    }
}


