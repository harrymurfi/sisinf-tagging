<?php 
  class calendar
  {
    private $useDate;
    private $month;
    private $year;
    private $daysInMonth;
    private $startDay;

    public function __construct($dbo = null, $useDate = null){}
    public function buildCalendar(){}
    public function displayEvent($id){}
    public function displayForm(){}
    public function processForm(){}
    public function confirmDelete($id){}

    private function _validDate($date)
    {
      $pattern = "/^(\d{4}(-\d{2}){2} \d{2}(:\d{2}){2})$/";
      return preg_match($pattern, $date)==1 ? true : false;
    }
    private function _loadEventData(){}
    private function _createEventObject(){}
    private function _loadEventById($id){}
    private function _adminGeneralOptions(){}
    private function _adminEntryOptions($id){}
  }
?>