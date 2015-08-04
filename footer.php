<?php
/*
 * footer
 * semplice.theme
 */
?>
			<!-- content -->
			<footer class="footer">
				<p>© Copyright 2011 – <?=date('Y')?> Roxy Velez · Made with ♥ · <a href="/imprint">Imprint</a></p>
			</footer>
			</div>
		<!-- wrapper -->
		</div>
		<div class="to-the-top">
			<a class="top-button"><?php echo setIcon('arrow_up'); ?></a>
		</div>
		<div class="overlay fade"></div>
		<?php wp_footer(); # include wordpress footer ?>
		<script type="text/javascript">
			(function($) {
				$(document).ready(function () {
					$(".live-video video, .live-audio audio, .cover-video video, .wysiwyg video, .wysiwyg audio").mediaelementplayer();
				});
			})(jQuery);
		</script>
	</body>
</html>