<?php

loader_import ('saf.MailForm');

class SitelliteUtilContactForm extends MailForm {
	function SitelliteUtilContactForm ($parameters) {
		parent::MailForm ();

		$this->parameters = $parameters;

		$this->parseSettings ('inc/app/sitellite/boxes/util/contact/form.php');

		//$this->send_to = $parameters['email'];
		//$this->action = site_prefix () . '/index/sitellite-util-contact-action';
		//global $cgi;
		//$cgi->email = $send_to;
		//$cgi->param[] = 'email';
	}

	function onSubmit ($vals) {
		if ($this->parameters['save'] == 'yes') {
			// save to sitellite_form_submission table
			$parts = explode (' ', $vals['name']);
			$first = array_shift ($parts);
			$last = join (' ', $parts);

			db_execute (
				'insert into sitellite_form_submission values (null, ?, now(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
				1,
				'Contact Form',
				$_SERVER['REMOTE_ADDR'],
				null,//$vals['account_number'],
				null,//$vals['pass_phrase'],
				null,//$vals['salutation'],
				$first,
				$last,
				$vals['from'],
				null,//$vals['birthday'],
				null,//$vals['gender'],
				null,//$vals['address_line1'],
				null,//$vals['address_line2'],
				null,//$vals['city'],
				null,//$vals['state'],
				null,//$vals['country'],
				null,//$vals['zip'],
				null,//$vals['company'],
				null,//$vals['job_title'],
				null,//$vals['phone_number'],
				null,//$vals['daytime_phone'],
				null,//$vals['evening_phone'],
				null,//$vals['mobile_phone'],
				null,//$vals['fax_number'],
				null,//$vals['preferred_method_of_contact'],
				null,//$vals['best_time'],
				null,//$vals['may_we_contact_you'],
				$vals['message']
			);
		}

		if (! @mail (
			$this->parameters['email'],
			'[' . site_domain () . '] ' . intl_get ('Contact Form'),
			template_simple ('util_contact_email.spt', $vals),
			'From: ' . $vals['name'] . ' <' . $vals['from'] . '>' //noreply@' . preg_replace ('/^www\./i', '', site_domain ())
		)) {
			page_title (intl_get ('An Error Occurred'));
			echo '<p>' . intl_get ('Our apologies, your message failed to be sent.  Please try again later.') . '</p>';
			return;
		}

		page_title (intl_get ('Thank You'));
		echo template_simple ('util_contact_thanks.spt');
	}
}

$form = new SitelliteUtilContactForm ($parameters);
echo $form->run ();

?>