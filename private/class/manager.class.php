<?php 

require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once(PRIVATE_PATH . '/class/employee.class.php');
require_once(PRIVATE_PATH . '/class/customevent.class.php');


class Manager extends Employee{

static public function applyDiscount(string $id, CustomEvent $event)
{

	if($event->getPrice() < $event->getDiscountedPrice()){
		$event->errors[] = "Discount Price must be less than Price";
	}

	if($event->getDiscountedPrice() == 0){
		$event->errors[] = "Discount Price must be greater than zero";
	}

	if(!empty($event->errors)){
		echo alertErrorMessage($event->errors);
		return false;
	}

	return $event->updateEvent($id);

}

}

?>