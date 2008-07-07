<?php
//
// +----------------------------------------------------------------------+
// | Sitellite - Content Management System                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2001 Simian Systems                                    |
// +----------------------------------------------------------------------+
// | This software is released under the Simian Open Software License.    |
// | Please see the accompanying file OPENLICENSE for licensing details!  |
// |                                                                      |
// | You should have received a copy of the Simian Open Software License  |
// | along with this program; if not, write to Simian Systems,            |
// | 101-314 Broadway, Winnipeg, MB, R3C 0S7, CANADA.  The Simian         |
// | Public License is also available at the following web site           |
// | address: <http://www.simian.ca/license.php>                          |
// +----------------------------------------------------------------------+
// | Authors: John Luxford <lux@simian.ca>                                |
// +----------------------------------------------------------------------+
//
// Theme widget.  Displays an HTML <select> form field with a
// "Preview" button next to it.
//

/**
	 * Theme widget.  Displays an HTML <select> form field with a
	 * "Preview" button next to it.
	 * 
	 * <code>
	 * <?php
	 * 
	 * $widget = new MF_Widget_theme ('name');
	 * $widget->validation ('is "foo"');
	 * $widget->setValue ('foo');
	 * $widget->error_message = 'Oops!  This widget is being unruly!';
	 * 
	 * ? >
	 * </code>
	 * 
	 * @package	CMS
	 * @author	John Luxford <lux@simian.ca>
	 * @copyright	Copyright (C) 2001-2003, Simian Systems Inc.
	 * @license	http://www.sitellite.org/index/license	Simian Open Software License
	 * @version	1.0, 2001-11-28, $Id: Theme.php,v 1.1.1.1 2006/01/03 00:02:21 lux Exp $
	 * @access	public
	 * 
	 */

class MF_Widget_theme extends MF_Widget {
	/**
	 * A way to pass extra parameters to the HTML form tag, for
	 * example 'enctype="multipart/formdata"'.
	 * 
	 * @access	public
	 * 
	 */
	var $extra = '';

	/**
	 * This is the short name for this widget.  The short name is
	 * the class name minus the 'MF_Widget_' prefix.
	 * 
	 * @access	public
	 * 
	 */
	var $type = 'theme';

	function getThemes ($path = false) {
		if (! $path) {
			$path = site_docroot () . '/inc/app/sitepresenter/themes';
		}

		$themes = array (); //'' => 'Default');

		loader_import ('saf.File.Directory');
		$dir = new Dir;
		if (! $dir->open ($path)) {
			return $themes;
		}

		foreach ($dir->read_all () as $file) {
			if (strpos ($file, '.') === 0 || ! @is_dir ($path . '/' . $file)) {
				continue;
			}
			//if (preg_match ('/^html.([^\.]+)\.tpl$/', $file, $regs)) {
				//if ($regs[1] == 'default') {
				//	continue;
				//}
				$themes[$file] = ucfirst ($file);
			//}
		}

		return $themes;
	}

	/**
	 * Returns the display HTML for this widget.  The optional
	 * parameter determines whether or not to automatically display the widget
	 * nicely, or whether to simply return the widget (for use in a template).
	 * 
	 * @access	public
	 * @param	boolean	$generate_html
	 * @return	string
	 * 
	 */
	function display ($generate_html = 0) {
		global $intl, $simple;
		if (! isset ($this->data_value)) {
			$this->data_value = $this->default_value;
		}
		if (empty ($this->data_value)) {
			$this->data_value = 'default';
		}

		$this->value = $this->getThemes ();

		$attrstr = $this->getAttrs ();
		if ($generate_html) {
			$data = "\t" . '<tr>' . "\n\t\t" . '<td class="label"><label for="' . $this->name . '" id="' . $this->name . '-label"' . $this->invalid () . '>' . $simple->fill ($this->label_template, $this, '', true) . '</label></td>' . "\n\t\t" .
				'<td class="field"><select ' . $attrstr . ' ' . $this->extra . ' >' . "\n";
			foreach ($this->value as $value => $display) {
				$display = str_replace ('_', ' ', ucwords ($display));
				if ($value == $this->data_value) {
					$selected = ' selected="selected"';
				} else {
					$selected = '';
				}
				$data .= "\t" . '<option value="' . $value . '"' . $selected . '>' . $display . '</option>' . "\n";
			}
			$data .= '</select> &nbsp; ';

			$data .= '<script language="javascript" type="text/javascript">
				function preview_theme (f) {
					o = f.elements.' . $this->name . '.options[f.elements.' . $this->name . '.selectedIndex].value;
					if (o.length == 0) {
						w = window.open (\'' . site_prefix () . '/index/sitepresenter-preview-theme-action?theme=default\', \'ThemePreview\', \'top=50,left=50,height=500,width=780,resizable=yes,scrollbars=yes\');
					} else {
						w = window.open (\'' . site_prefix () . '/index/sitepresenter-preview-theme-action?theme=\' + o, \'ThemePreview\', \'top=50,left=50,height=500,width=780,resizable=yes,scrollbars=yes\');
					}
					return false;
				}
			</script><input type="submit" value="' . intl_get ('Preview') . '" onclick="return preview_theme (this.form)" />';

			$data .= '</td>' . "\n\t" . '</tr>' . "\n";
			return $data;

		} else {
			$data = '<select ' . $attrstr . ' ' . $this->extra . ' >' . "\n";
			foreach ($this->value as $value => $display) {
				$display = str_replace ('_', ' ', ucwords ($display));
				if ($value == $this->data_value) {
					$selected = ' selected="selected"';
				} else {
					$selected = '';
				}
				$data .= "\t" . '<option value="' . htmlentities_compat ($value, ENT_COMPAT, $intl->charset) . '"' . $selected . '>' . $display . '</option>' . "\n";
			}
			return $data . '</select>';
		}
	}
}

?>