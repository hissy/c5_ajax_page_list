<?php  defined('C5_EXECUTE') or die("Access Denied.");

// Validate request
$nh = Loader::helper('validation/numbers');
if (!$nh->integer($_REQUEST['bID']) || !$nh->integer($_REQUEST['cID'])) {
	die(t('Access Denied'));
}

// Get Block object
$bID = $_REQUEST['bID'];
$b = Block::getByID($bID);

// Get Page object
$cID = $_REQUEST['cID'];
$c = Page::getByID($cID);

// Check Block & Page object
if (is_object($b) && !$b->isError() && is_object($c) && !$c->isError()) {
	
	// Check block type handle
	if ($b->getBlockTypeHandle() != 'page_list') {
		die(t('Access Denied'));
	}
	
	// Check whether or not to user can read the block
	$bp = new Permissions($b, $c, $_REQUEST['aHandle']);
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
