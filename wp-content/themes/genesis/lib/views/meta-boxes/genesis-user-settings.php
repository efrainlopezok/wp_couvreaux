<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

?>
<h2><?php esc_html_e( 'User Permissions', 'genesis' ); ?></h2>
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row"><?php esc_html_e( 'Genesis Admin Menus', 'genesis' ); ?></th>
			<td>
				<label for="genesis-meta[genesis_admin_menu]"><input id="genesis-meta[genesis_admin_menu]" name="genesis-meta[genesis_admin_menu]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'genesis_admin_menu', $object->ID ) ); ?> />
				<?php esc_html_e( 'Enable Genesis Admin Menu?', 'genesis' ); ?></label><br />

				<?php if ( ! genesis_seo_disabled() ) : ?>
				<label for="genesis-meta[genesis_seo_settings_menu]"><input id="genesis-meta[genesis_seo_settings_menu]" name="genesis-meta[genesis_seo_settings_menu]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'genesis_seo_settings_menu', $object->ID ) ); ?> />
				<?php esc_html_e( 'Enable SEO Settings Submenu?', 'genesis' ); ?></label><br />
				<?php endif; ?>
				
				<?php if ( current_theme_supports( 'genesis-import-export-menu' ) ) : ?>
				<label for="genesis-meta[genesis_import_export_menu]"><input id="genesis-meta[genesis_import_export_menu]" name="genesis-meta[genesis_import_export_menu]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'genesis_import_export_menu', $object->ID ) ); ?> />
				<?php esc_html_e( 'Enable Import/Export Submenu?', 'genesis' ); ?></label>
				<?php endif; ?>
			</td>
		</tr>
	</tbody>
</table>
