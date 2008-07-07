<?php

// $Id: Toc.php,v 1.1 2005/07/09 21:30:22 lux Exp $

class Text_Wiki_Render_Xhtml_Toc extends Text_Wiki_Render {
    
    var $conf = array(
        'css_list' => null,
        'css_item' => null,
        'title' => '<strong>Table of Contents</strong>',
        'div_id' => 'toc'
    );
    
    var $min = 2;
    
    /**
    * 
    * Renders a token into text matching the requested format.
    * 
    * @access public
    * 
    * @param array $options The "options" portion of the token (second
    * element).
    * 
    * @return string The text rendered from the token options.
    * 
    */
    
    function token($options)
    {
        // type, id, level, count, attr
        extract($options);
        
        switch ($type) {
        
        case 'list_start':
        
            $html = '<div';
            
            $css = $this->getConf('css_list');
            if ($css) {
                $html .= " class=\"$css\"";
            }
            
            $div_id = $this->getConf('div_id');
            if ($div_id) {
                $html .= " id=\"$div_id\"";
            }
            
            $html .= '>';
            $html .= $this->getConf('title');
            return $html;
            break;
        
        case 'list_end':
            return "</div>\n";
            break;
            
        case 'item_start':
            $html = '<div';
            
            $css = $this->getConf('css_item');
            if ($css) {
                $html .= " class=\"$css\"";
            }
            
            $pad = ($level - $this->min);
            $html .= " style=\"margin-left: {$pad}em;\">";
            
            $html .= "<a href=\"#$id\">";
            return $html;
            break;
        
        case 'item_end':
            return "</a></div>\n";
            break;
        }
    }
}
?>