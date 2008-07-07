<?php
//
// +----------------------------------------------------------------------+
// | Sitellite - Content Management System                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2007 Simian Systems                                    |
// +----------------------------------------------------------------------+
// | This software is released under the GNU General Public License (GPL) |
// | Please see the accompanying file docs/LICENSE for licensing details. |
// |                                                                      |
// | You should have received a copy of the GPL Software License along    |
// | with this program; if not, write to Simian Systems, 242 Lindsay,     |
// | Winnipeg, MB, R3N 1H1, CANADA.  The License is also available at     |
// | the following web site address:                                      |
// | <http://www.sitellite.org/index/license>                             |
// +----------------------------------------------------------------------+
// | Authors: John Luxford <lux@simian.ca>                                |
// +----------------------------------------------------------------------+
//
// Security widget.  Performs a CAPTCHA test on the user.
//

/**
	 * Security widget.  Performs a CAPTCHA test on the user.
	 * 
	 * <code>
	 * <?php
	 * 
	 * $widget = new MF_Widget_security ('name');
	 * $widget->validation ('is "foo"');
	 * $widget->setValue ('foo');
	 * $widget->error_message = 'Oops!  This widget is being unruly!';
	 * 
	 * ? >
	 * </code>
	 * 
	 * @package	MailForm
	 * @author	John Luxford <lux@simian.ca>
	 * @copyright	Copyright (C) 2001-2003, Simian Systems Inc.
	 * @license	http://www.sitellite.org/index/license	Simian Open Software License
	 * @version	1.2, 2002-05-03, $Id: Security.php,v 1.2 2007/10/06 00:06:30 lux Exp $
	 * @access	public
	 * 
	 */

class MF_Widget_security extends MF_Widget {
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
	var $type = 'security';

	/**
	 * This is the method to use to verify the user is human.  The default
	 * is 'figlet' which renders random letters and numbers using a combination
	 * of ascii symbols on several lines.  This technique is less typical
	 * than other form security techniques, which may increase its security
	 * slightly, but it is also text-based and therefore less secure in that
	 * regard.  It is the default because it requires no special PHP extensions
	 * to use.
	 *
	 * The alternative is 'turing' which generates an image of random letters
	 * and numbers, making it a slightly more effective security precaution.
	 * This requires PHP's GD extension however, which is not available on all
	 * systems.  Check your phpinfo() output to determine compatibility.
	 *
	 * Turing tests are also known as CAPTCHA tests.  Their purpose is to
	 * verify that the user is human by having them perform a test that would
	 * be difficult for a computer to pass.
	 *
	 * @access	public
	 *
	 */
	var $verify_method = 'figlet';

	/**
	 * Constructor Method.
	 * 
	 * @access	public
	 * @param	string	$name
	 * 
	 */
	function MF_Widget_security ($name) {
		parent::MF_Widget ($name);

		$this->addRule (
			'func "mailform_widget_security_verify"',
			'Your input does not match the letters and numbers shown in the security field.  Please try again.'
		);
	}

	function verify () {
		global $cgi;
		if ($this->verify_method == 'turing') {
			loader_import ('saf.Security.Turing');
			if (! SECURITY_TURING_GD_LOADED) {
				die ('Your server does not have GD support, which is necessary to render the turing test for this form.');
			}
			$sec = new Security_Turing ();
		} else {
			loader_import ('saf.Security.Figlet');
			$sec = new Security_Figlet ();
		}
		return $sec->verify ($cgi->{$this->name}, $cgi->{$this->name . '_hash'});
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
		parent::display ($generate_html);
		global $intl, $simple;
		$attrstr = $this->getAttrs ();

		if ($this->verify_method == 'turing') {
			loader_import ('saf.Security.Turing');
			if (! TURING_TEST_GD_LOADED) {
				die ('Your server does not have GD support, which is necessary to render the turing test for this form.');
			}
			$sec = new Security_Turing ();
		} else {
			loader_import ('saf.Security.Figlet');
			$sec = new Security_Figlet ();
		}
		list ($pre, $hash) = $sec->makeTest ();

		if ($generate_html) {
			return "\t" . '<tr>' . "\n\t\t" . '<td class="label" colspan="2"><label for="' . $this->name . '" id="' . $this->name . '-label"' . $this->invalid () . '>' . $simple->fill ($this->label_template, $this, '', true) . '</label></td></tr>' . "\n\t\t" .
				'<tr><td class="field" colspan="2">' . $pre . intl_get ('Please type the letters and numbers you see above in the field below') . ':<br /><input type="hidden" name="' . $this->name . '_hash" value="' . $hash . '" /><input type="text" ' . $attrstr .
				'" maxlength="6" size="20" style="margin-top: 5px" ' . $this->extra . ' /></td>' . "\n\t" . '</tr>' . "\n";
		} else {
			return '<input type="text" ' . $attrstr . ' value="' . htmlentities_compat ($this->data_value, ENT_COMPAT, $intl->charset) . '" ' . $this->extra . ' />';
		}
	}
}

function mailform_widget_security_verify ($vals) {
	global $cgi, $mailform_current_form;
	foreach ($vals as $k => $v) {
		if (isset ($cgi->{$k . '_hash'})) {
			if (! $mailform_current_form->widgets[$k]->verify ()) {
				return false;
			}
		}
	}
	return true;
}

?>