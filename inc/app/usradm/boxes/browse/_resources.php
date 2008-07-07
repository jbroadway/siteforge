<?php

	echo '<h1>' . intl_get ('Browsing') . ': ' . ucwords ($pleural[$cgi->list]) . '</h1>' . NEWLINEx2;

	if (! is_writeable ('inc/conf/auth/' . $objects[$cgi->list]) || ! is_writeable ('inc/conf/auth/' . $objects[$cgi->list] . '/index.php')) {
		echo '<p style="color: #900; font-weight: bold">' . intl_get ('Warning: The {list} folder is not writeable.  Please verify that the folder \'inc/conf/auth\' and all files and folders below it are writeable by the web server user.', $cgi) . '</p>';
	}

	loader_import ('saf.GUI.Prompt');

	?>
	<script language="javascript" type="text/javascript">
	<!--

	function confirmDelete (list, key) {
		return confirm ('Are you sure you want to delete "' + list + '/' + key + '"?');
	}

	function addSimple (list) {
		var add_simple_list = list;
		prompt (
			'New <?php echo ucwords ($names[$cgi->list]); ?>:',
			'',
			function (name) {
				if (name == false || name == null || name.length == 0) {
					return false;
				}
				window.location.href = '<?php echo site_prefix (); ?>/index/usradm-add-simple-action?_list=' + add_simple_list + '&_key=' + name;
				return false;
			}
		);
		return false;
	}

	// -->
	</script>
	<?php

	echo template_simple ('<p><a href="#" onclick="return addSimple (\'{cgi/list}\')">{intl Add} {filter ucwords}{name}{end filter}</a></p>', array ('name' => $names[$cgi->list]));

	$total = count ($session->acl->{$objects[$cgi->list]});

	echo '<p>' . $total . ' ' . ucwords ($pleural[$cgi->list]) . ' ' . intl_get ('found') . ':</p>' . NEWLINEx2;

	// header
	echo '<table border="0" cellpadding="3" cellspacing="1" width="100%">
		<tr>
			<th>&nbsp;</th>' . NEWLINE;
	echo TABx3 . '<th>' . intl_get ('Name') . '</th>' . NEWLINE;
	echo TABx3 . '<th>' . intl_get ('Type') . '</th>' . NEWLINE;
	echo TABx3 . '<th>' . intl_get ('System Name') . '</th>' . NEWLINE;
	echo TABx2 . '</tr>' . NEWLINE;

	loader_import ('saf.Misc.Alt');
	$alt = new Alt ('#fff', '#eee');

	$rows = array ();

	// each row
	foreach ($session->acl->{$objects[$cgi->list]} as $key => $row) {
		if (! is_array ($row)) {
			$row = array ('name' => $row);
		} else {
			$row['name'] = $key;
		}

		$row['type'] = 'Custom';

		if (strpos ($row['name'], 'app_') === 0) {
			if (@file_exists ('inc/app/' . substr ($row['name'], 4) . '/conf/config.ini.php')) {
				$ini = parse_ini_file ('inc/app/' . substr ($row['name'], 4) . '/conf/config.ini.php');
				$row['alt'] = $ini['app_name'];
			} else {
				$row['alt'] = ucwords (str_replace ('_', ' ', substr ($row['name'], 4)));
			}
			$row['type'] = 'App';
		} elseif (@file_exists ('inc/app/cms/conf/collections/' . $row['name'] . '.php')) {
			$ini = parse_ini_file ('inc/app/cms/conf/collections/' . $row['name'] . '.php', true);
			$row['alt'] = $ini['Collection']['display'];
			$row['type'] = 'Collection';
		} else {
			$row['alt'] = ucwords (str_replace ('_', ' ', $row['name']));
		}

		$rows[] = $row;
	}

	// sort rows
	function usradm_resources_sort ($a, $b) {
		if ($a['type'] < $b['type']) {
			return -1;
		} elseif ($a['type'] > $b['type']) {
			return 1;
		} elseif ($a['alt'] < $b['alt']) {
			return -1;
		} elseif ($a['alt'] > $b['alt']) {
			return 1;
		}
		return 0;
	}

	usort ($rows, 'usradm_resources_sort');

	foreach ($rows as $row) {
		echo template_simple (TAB . '<tr style="background-color: ' . $alt->next () . '">' . NEWLINE . TABx2 . '<td align="center" width="5%"><a href="{site/prefix}/index/usradm-delete-action?_list={cgi/list}&_key={name}" onclick="return confirmDelete (\'{cgi/list}\', \'{name}\')"><img src="{site/prefix}/inc/app/cms/pix/icons/delete.gif" alt="{intl Delete}" title="{intl Delete}" border="0" /></a></td>', $row);
		echo template_simple (TABx2 . '<td>{alt}</td>' . NEWLINE, $row);
		echo template_simple (TABx2 . '<td>{type}</td>' . NEWLINE, $row);
		echo template_simple (TABx2 . '<td>{name}</td>' . NEWLINE, $row);
		echo TAB . '</tr>' . NEWLINE;
	}

	echo '</table>' . NEWLINEx2;

?>