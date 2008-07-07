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
// Calendar widget.  Displays a text box with a Javascript calendar popup
// to select dates.
//

/**
	 * Calendar widget.  Displays a text box with a Javascript calendar popup
	 * to select dates.  The format of the date can also be specified, but the
	 * default is YYYY-MM-DD.
	 * 
	 * The Javascript from this widget is based on the DHTML Calendar project
	 * at http://students.infoiasi.ro/~mishoo/site/calendar.epl
	 *
	 * New in 1.2:
	 * - Updated to work with the DHTML Calendar version 0.9.4 and up.
	 * 
	 * <code>
	 * <?php
	 * 
	 * $widget = new MF_Widget_calendar ('name');
	 * $widget->setFormat ('y/m/d');
	 * echo $widget->display ();
	 * 
	 * ? >
	 * </code>
	 * 
	 * @package	MailForm
	 * @author	John Luxford <lux@simian.ca>
	 * @copyright	Copyright (C) 2001-2003, Simian Systems Inc.
	 * @license	http://www.sitellite.org/index/license	Simian Open Software License
	 * @version	1.2, 2003-11-06, $Id: Calendar.php,v 1.4 2007/10/06 00:06:30 lux Exp $
	 * @access	public
	 * 
	 */

class MF_Widget_calendar extends MF_Widget {
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
	var $type = 'calendar';

	/**
	 * This determines the format of the date stored in the hidden
	 * field, and also the format submitted by the form widget.
	 *
	 * @access	public
	 *
	 */
	var $format = '%Y-%m-%d';

	/**
	 * This determines the format of the date displayed to the user.
	 *
	 * @access	public
	 *
	 */
	var $displayFormat = '%a, %e %b, %Y';

	/**
	 * This determines the language file to load for the calendar
	 * user interface.  See the folder /js/calendar/lang for a list
	 * of available languages.
	 *
	 * @access	public
	 *
	 */
	var $lang = 'en';

	/**
	 * This determines the stylesheet to load for the calendar
	 * user interface.  See the CSS files in the folder /js/calendar
	 * for a list of available stylesheets, or information on
	 * writing your own.
	 *
	 * @access	public
	 *
	 */
	var $style = 'sitellite';

	/**
	 * Determines whether to show the time selection options under the
	 * calendar.
	 *
	 * @access	public
	 *
	 */
	var $showsTime = false;

	/**
	 * Sets the display time to 24 hours, or 12 hours with AM/PM option.
	 * The default is 12 hours.
	 *
	 * @access	public
	 *
	 */
	var $timeFormat = '12';

	/**
	 * Constructor Method.
	 * 
	 * @access	public
	 * @param	string	$name
	 * 
	 */
	function MF_Widget_calendar ($name) {
		// initialize core Widget settings
		parent::MF_Widget ($name);
	}

	function displayValue () {
		$out = htmlentities_compat ($this->data_value, ENT_COMPAT, intl_charset ());
		if (empty ($out)) {
			return intl_get ('No date selected.');
		}
		loader_import ('saf.Date');
		 return Date::format ($out, $this->js2phpFormat ($this->displayFormat));
	}

	function js2phpFormat ($date) {
		return str_replace (
			array (
				'%a',
				'%A',
				'%b',
				'%B',
				'%C',
				'%d',
				'%e',
				'%H',
				'%I',
				'%j',
				'%k',
				'%l',
				'%m',
				'%M',
				'%n',
				'%p',
				'%P',
				'%S',
				'%s',
				'%t',
				'%U',
				'%W',
				'%V',
				'%u',
				'%w',
				'%y',
				'%Y',
				'%%',
			),
			array (
				'D',
				'l',
				'M',
				'F',
				'',
				'd',
				'j',
				'H',
				'h',
				'z',
				'G',
				'g',
				'm',
				'i',
				"\n",
				'A',
				'a',
				's',
				'U',
				"\t",
				'W',
				'W',
				'W',
				'',
				'w',
				'y',
				'Y',
				'%',
			),
			$date
		);
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
		$data = '';
		$attrstr = $this->getAttrs ();

		if ($generate_html) {
			static $includedJS = false;

			if (! $includedJS) {
				$data .= '<link rel="stylesheet" type="text/css" href="' . site_prefix () . '/js/calendar/calendar-' . $this->style . '.css" />' . NEWLINE;
				page_add_script (site_prefix () . '/js/calendar/calendar.js');
				page_add_script (site_prefix () . '/js/calendar/lang/calendar-' . $this->lang . '.js');
				page_add_script (site_prefix () . '/js/calendar/calendar-setup.js');
				$includedJS = true;
			}

			$showsTime = ($this->showsTime) ? 'true' : 'false';

		$adv = ($this->advanced) ? ' class="advanced"' : '';

			$data .= '<tr' . $adv . '>
				<td class="label"' . $this->invalid () . '>
					<label for="' . $this->name . '">' . template_simple ($this->label_template, $this, '', true) . '</label>
				</td>
				<td class="field">
					<input type="hidden" name="' . $this->name . '" id="mf-calendar-' . $this->name . '" value="' . htmlentities_compat ($this->data_value, ENT_COMPAT, intl_charset ()) . '" ' . $attrstr . ' ' . $this->extra . ' />
					<table border="0" cellpadding="3" cellspacing="0" width="100%">
						<tr>
							<td width="50%">
								<span id="mf-calendar-' . $this->name . '-display" style="font-weight: bold">' . $this->displayValue () . '</span>
							</td>
							<td width="50%">
								<input type="submit" id="mf-calendar-' . $this->name . '-trigger" value="' . intl_get ('Select Date') . '" />' /*onclick="alert (\'We\\\'re sorry, but the calendar popup is not available in your browser at this time.\'); return false" />*/ . '
								&nbsp;
								<input type="submit" value="' . intl_get ('Clear') . '" onclick="this.form.elements[\'' . $this->name . '\'].value = \'\'; document.getElementById(\'mf-calendar-' . $this->name . '-display\').innerHTML = \'' . intl_get ('No date selected.') . '\'; return false" />
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<script language="javascript" type="text/javascript">
				Calendar.setup ({
					inputField	: "mf-calendar-' . $this->name . '",
					ifFormat	: "' . $this->format . '",
					displayArea	: "mf-calendar-' . $this->name . '-display",
					daFormat	: "' . $this->displayFormat . '",
					button		: "mf-calendar-' . $this->name . '-trigger",
					align		: "Bl",
					showsTime	: ' . $showsTime . ',
					timeFormat	: "' . $this->timeFormat . '"
				});
			</script>' . NEWLINEx2;

		} else {
			$showsTime = ($this->showsTime) ? 'true' : 'false';

			$data .= '<input type="text" name="' . $this->name . '" id="mf-calendar-' . $this->name . '" value="' . htmlentities_compat ($this->data_value, ENT_COMPAT, $intl->charset) . '" ' . $attrstr . ' ' . $this->extra . ' />
					&nbsp;
					<input type="submit" id="mf-calendar-' . $this->name . '-trigger" value="' . intl_get ('Select Date') . '" onclick="alert (\'We\\\'re sorry, but the calendar popup is not available in your browser at this time.\'); return false" />
				<script language="javascript" type="text/javascript">
				Calendar.setup (
					{
						inputField	: "mf-calendar-' . $this->name . '",	// ID of the input field
						ifFormat	: "' . $this->format . '",		// the date format
						button		: "mf-calendar-' . $this->name . '-trigger",	// ID of the button
						showsTime	: ' . $showsTime . ',
						timeFormat	: "' . $this->timeFormat . '"
					}
				);
			</script>' . NEWLINEx2;
		}

		return $data;
	}
}

?>