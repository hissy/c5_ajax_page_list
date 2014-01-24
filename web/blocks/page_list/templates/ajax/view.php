<?php  defined('C5_EXECUTE') or die("Access Denied.");

$b = $this->getBlockObject();
$bid = $b->getBlockID();

$a = $b->getBlockAreaObject();
$aHandle = $a->getAreaHandle();
$cid = $a->getCollectionID();

?>
<div id="ccm-ajax-page-list" data-bid="<?php echo $bid; ?>" data-cid="<?php echo $cid; ?>" data-ahandle="<?php echo $aHandle; ?>"></div>
<div id="ccm-ajax-page-list-loading">Loading...</div>