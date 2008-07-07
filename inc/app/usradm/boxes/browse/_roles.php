<?php

	echo '<h1>' . intl_get ('Browsing') . ': ' . ucfirst ($pleural[$cgi->list]) . '</h1>' . NEWLINEx2;

	if (! is_writeable ('inc/conf/auth/roles')) {
		echo '<p style="color: #900; font-weight: bold">' . intl_get ('Warning: The roles folder is not writeable.  Please verify that the folder \'inc/conf/auth\' and all files and folders below it are writeable by the web server user.') . '</p>';
	}

	?>
	<script language="javascript">
	<!--

	function confirmDelete (list, key) {
		return confirm ('Are you sure you want to delete "' + list + '/' + key + '"?');
	}

	// -->
	</script>
	<?php

	echo template_simple ('<p><a href="{site/prefix}/index/usradm-add-role-action?_list={cgi/list}">{intl Add Role}</a></p>');

	// -1 for anonymous
	$total = count ($session->acl->{$objects[$cgi->list]}) - 1;

	echo '<p>' . $total . ' ' . intl_get ('Roles found') . ':</p>' . NEWLINEx2;

	// header
	echo '<table border="0" cellpadding="3" cellspacing="1" width="100%">
		<tr>
			<th>&nbsp;</th>' . NEWLINE;
	echo TABx3 . '<th>' . intl_get ('Name') . '</th>' . NEWLINE;
	echo TABx3 . '<th>' . intl_get ('Disabled') . '</th>' . NEWLINE;
	echo TABx3 . '<th>' . intl_get ('Admin') . '</th>' . NEWLINE;
	echo TABx2 . '</tr>' . NEWLINE;

	loader_import ('saf.Misc.Alt');
	$alt = new Alt ('#fff', '#eee');

	// each row
	foreach ($session->acl->{$objects[$cgi->list]} as $key => $row) {
		if ($row['name'] == 'anonymous') {
			continue;
		}
		if (! is_array ($row)) {
			$row = array ('name' => $row);
		} else {
			$row['name'] = $key;
		}
		echo template_simple (TAB . '<tr style="background-color: ' . $alt->next () . '">' . NEWLINE . TABx2 . '<td align="center" width="5%"><a href="{site/prefix}/index/usradm-delete-action?_list={cgi/list}&_key={name}" onclick="return confirmDelete (\'{cgi/list}\', \'{name}\')"><img src="{site/prefix}/inc/app/cms/pix/icons/delete.gif" alt="{intl Delete}" title="{intl Delete}" border="0" /></a></td>', $row);
		echo template_simple (TABx2 . '<td><a href="{site/prefix}/index/usradm-edit-role-action?_list={cgi/list}&_key={name}">{name}</a></td>' . NEWLINE, $row);
		if ($row['disabled']) {
			echo TABx2 . '<td width="25%">Yes</td>' . NEWLINE;
		} else {
			echo TABx2 . '<td width="25%">No</td>' . NEWLINE;
		}
		if ($row['admin']) {
			echo TABx2 . '<td width="25%">Yes</td>' . NEWLINE;
		} else {
			echo TABx2 . '<td width="25%">No</td>' . NEWLINE;
		}
		echo TAB . '</tr>' . NEWLINE;
	}

	echo '</table>' . NEWLINEx2;

?>