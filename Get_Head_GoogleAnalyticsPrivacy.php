<?php
function GoogleAnalyticsPrivacy_Get_Head()
{
	global                   $page;
	global                   $addonPathData;

	$configFile              = $addonPathData.'/config.php';
	if( ! file_exists( $configFile ) )
	{
    return;
	}

	include_once $configFile;

	if( ! isset( $config ) || empty($config['enabled']) )
  {
    return;
	}

	$key                   = htmlspecialchars($config['key'], ENT_QUOTES, 'UTF-8');
  $displayFeatures       = !empty($config['displayFeatures']);
	$anonymizeIp       		 = !empty($config['anonymizeIp']);

	$page->head           .= "\n";
	$page->head           .= "\n<script>";
	$page->head           .= "\n  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){";
	$page->head           .= "\n  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),";
	$page->head           .= "\n  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)";
	$page->head           .= "\n  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');";
	$page->head           .= "\n";
	$page->head           .= "\n  ga('create', '$key', 'auto');";

  if( $displayFeatures )
  {
		$page->head         .= "\n  ga('require', 'displayfeatures');";
  }
	if( $anonymizeIp )
	{
		$page->head         .= "\n  ga('set', 'anonymizeIp', true);";
	}


	$page->head           .= "\n  ga('send', 'pageview');";
	$page->head           .= "\n";
	$page->head           .= "\n</script>";
	$page->head           .= "\n";
}

// vim: set noai ts=2 sw=2:
?>
