<?php
class Track extends Controller
{
   private $data = [];
   private $pageModel;
   private $formData;
   private $tracking_no;
   public function __construct()
   {
      $this->pageModel = $this->model('Page');
   }

   public function index()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         if (isset($_POST['track-package'])) {
            $this->formData = filteration($_POST);
            $this->tracking_no = $this->formData['tracking_no'];
            $this->data = [
               'package' => $this->pageModel->select_Where('products', 't_id', $this->tracking_no),
            ];
            if (empty($this->tracking_no)) {
               flashmsg('message', 'Please, enter your tracking number', 'alert alert-danger');
            } else if (strlen($this->tracking_no) < 10) {
               flashmsg('message', 'Please, enter a valid tracking number', 'alert alert-danger');
            }
            if (!$this->data['package']) {
               flashmsg('message', 'This Tracking Number does not exist or has been completed', 'alert alert-danger');
            }
            $this->view("track", $this->data);
         }
      }
      $this->data = [
         'package' => $this->pageModel->select_Where('products', 't_id', $this->tracking_no),
      ];
      $this->view("track", $this->data);
   }
}
