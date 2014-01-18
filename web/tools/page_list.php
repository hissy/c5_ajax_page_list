<?php  defined('C5_EXECUTE') or die("Access Denied.");

if (!Loader::helper('validation/numbers')->integer($_REQUEST['bID'])) {
	die(t('Access Denied'));
}

$bID = $_REQUEST['bID'];
$b = Block::getByID($bID);

if (is_object($b) && !$b->isError()) {
	
	$btc = $b->getController();
	$pl = $btc->getPageList();
	
	if ($pl->getItemsPerPage() > 0) {
		$pages = $pl->getPage();
	} else {
		$pages = $pl->get();
	}
	
	$nh = Loader::helper('navigation');
	
	//Pagination...
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
