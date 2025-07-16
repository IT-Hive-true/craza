<?php
use it_hive\THEME;


$theme_options = THEME::getOptionsPage('theme_options');
$data = $theme_options->renderGet();
$socilLinks = ($data && $data['general']) ? $data['general']['social'] : [];


?>
<ul class="social-networks">
	<li class="facebook"><a target="_blank" href="<?= $socilLinks['facebook']; ?>" aria-label="Facebook"> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 9.83 19" style="enable-background:new 0 0 9.83 19;" xml:space="preserve">
				<path d="M0,6.28h2.11V4.37c0-0.84,0.02-2.14,0.68-2.94C3.47,0.58,4.42,0,6.05,0c2.66,0,3.77,0.35,3.77,0.35L9.3,3.26	c0,0-0.88-0.24-1.7-0.24c-0.82,0-1.55,0.27-1.55,1.04v2.22h3.36L9.17,9.13H6.05V19H2.11V9.13H0V6.28z" /></svg> </a></li>
	<li class="instagram"><a target="_blank" href="<?= $socilLinks['instagram']; ?>" aria-label="Instagram"> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 17 17" style="enable-background:new 0 0 17 17;" xml:space="preserve">
				<path d="M2.18,0h12.64C16.02,0,17,0.98,17,2.18v12.64c0,1.2-0.98,2.18-2.18,2.18H2.18C0.98,17,0,16.02,0,14.82V2.18	C0,0.98,0.98,0,2.18,0z M12.39,1.89c-0.42,0-0.77,0.35-0.77,0.77v1.83c0,0.42,0.34,0.77,0.77,0.77h1.92c0.42,0,0.77-0.34,0.77-0.77	V2.65c0-0.42-0.34-0.77-0.77-0.77H12.39z M15.08,7.19h-1.5c0.14,0.46,0.22,0.95,0.22,1.46c0,2.83-2.37,5.12-5.29,5.12	c-2.92,0-5.28-2.29-5.28-5.12c0-0.51,0.08-1,0.22-1.46H1.89v7.18c0,0.37,0.3,0.67,0.68,0.67H14.4c0.37,0,0.68-0.3,0.68-0.67V7.19z	 M8.52,5.16c-1.89,0-3.41,1.48-3.41,3.31c0,1.83,1.53,3.31,3.41,3.31c1.89,0,3.41-1.48,3.41-3.31C11.93,6.64,10.4,5.16,8.52,5.16z" /></svg> </a></li>
	<li class="tiktok"><a target="_blank" href="<?= $socilLinks['tiktok']; ?>" aria-label="Tik Tok"> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16.26 19" style="enable-background:new 0 0 16.26 19;" xml:space="preserve">
				<path d="M16.26,7.69c-0.16,0.02-0.31,0.02-0.47,0.02c-1.71,0-3.31-0.86-4.24-2.29v7.81c0,3.19-2.58,5.77-5.77,5.77	C2.58,19,0,16.42,0,13.23c0-3.19,2.58-5.77,5.77-5.77l0,0c0.12,0,0.24,0.01,0.36,0.02v2.84c-0.12-0.01-0.23-0.04-0.36-0.04	c-1.63,0-2.95,1.32-2.95,2.95c0,1.63,1.32,2.95,2.95,2.95c1.63,0,3.06-1.28,3.06-2.91L8.87,0h2.72c0.26,2.44,2.22,4.35,4.67,4.53	L16.26,7.69" /></svg> </a></li>
</ul>
