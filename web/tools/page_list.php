<?php  defined('C5_EXECUTE') or die("Access Denied.");

// Validate request
if (!Loader::helper('validation/numbers')->integer($_REQUEST['bID'])) {
	die(t('Access Denied'));
}

// Get Block object
$bID = $_REQUEST['bID'];
$b = Block::getByID($bID);

// Check Block exists
if (is_object($b) && !$b->isError()) {
	
	// Check block type handle
	if ($b->getBlockTypeHandle() != 'page_list') {
		die(t('Access Denied'));
	}
	
	// Check whether or not to user can read the block
	$bp = new Permissions($b);
	if (!$bp->canRead()) {
		die(t('Access Denied'));
	}
	
	// Get block type controller
	$btc = $b->getController();
	
	// Get PageList object
	$pl = $btc->getPageList();
	
	// Get pages
	if ($pl->getItemsPerPage() > 0) {
		$pages = $pl->getPage();
	} else {
		$pages = $pl->get();
	}
	
	// Load helpers
	$nh = Loader::helper('navigation');
	
	// Pagination...
	$showPagination = false;
	$paginator = null;
	if ($btc->paginate && $btc->num > 0 && is_object($pl)) {
		$description = $pl->getSummary();
		if ($description->pages > 1) {
			$showPagination = true;
			$paginator = $pl->getPagination();
		}
	}
	
	$data = array(
		'pl'			 => $pl,
		'pages'			 => $pages,
		'nh'			 => $nh,
		'showPagination' => $showPagination,
		'paginator'		 => $paginator
	);
	
	Loader::element('page_list', $data);

}
