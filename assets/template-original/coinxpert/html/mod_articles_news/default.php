<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div id="recent-blog-posts" class="recent-blog-posts">
	<div class="" data-aos="fade-up">
		<header class="section-header">
		  <h2>Blog</h2>
		  <p>Nos derniers articles</p>
		</header>

		<div class="row <?php echo $moduleclass_sfx; ?>">
			<?php foreach ($list as $item) : ?>
				<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_item'); ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>
