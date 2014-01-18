<?php  defined('C5_EXECUTE') or die("Access Denied.");

$b = $this->getBlockObject();
$bid = $b->getBlockID();

?>
<div id="ccm-ajax-page-list" data-bid="<?php echo $bid; ?>"></div>
<div id="ccm-ajax-page-list-loading">Loading...</div>