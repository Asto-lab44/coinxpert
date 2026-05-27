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

          


<div class="col-lg-6">
	<div class="post-box">       

		<?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>	
			<div class="post-img">
				<img src="<?php echo $item->imageSrc; ?>" class="img-fluid" alt="<?php echo $item->imageAlt; ?>">
				<?php if (!empty($item->imageCaption)) : ?>
					<figcaption>
						<?php echo $item->imageCaption; ?>
					</figcaption>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<span class="post-date"><?php echo JHtml::_('date', $item->displayDate, 'd/m/Y'); ?></span>
				

		<?php if ($params->get('item_title')) : ?>
			<h3 class="post-title">
				<a href="<?php echo $item->link; ?>">
					<?php echo $item->title; ?>
				</a>
			</h3>
		<?php endif; ?>

		

		<?php if (!$params->get('intro_only')) : ?>
			<?php echo $item->afterDisplayTitle; ?>
		<?php endif; ?>

		<?php echo $item->beforeDisplayContent; ?>

		<?php if ($params->get('show_introtext', 1)) : ?>
			<?php echo $item->introtext; ?>
		<?php endif; ?>

		<?php echo $item->afterDisplayContent; ?>

		<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
			<?php echo '<a class="readmore stretched-link mt-auto" href="' . $item->link . '"><span>' . $item->linkText . '</span><i class="bi bi-arrow-right"></i></a>'; ?>
		<?php endif; ?>
	</div>
</div>