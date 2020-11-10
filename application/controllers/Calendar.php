<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller
{

    public function index($year = null, $month = null)
    {
        if (!$year) {
            $year = date('Y');
        }
        if (!$month) {
            $month = date('m');
        }

        // load the model
        $this->load->model('CalendarModel');
        $this->load->model('UsersModel');

        // if user logged in, show event data
        if($this->session->userdata('logged_in')){
            // get the uid for this username
            $uid = $this->UsersModel->getUserId();
            // get the data passed from users' input (add events)
            if ($this->input->post('day')) {
                $day = $this->input->post('day');
                $uid = $this->input->post('uid');
                // add data into calendar
                $this->CalendarModel->addCalendarData($uid,"$year-$month-$day", $this->input->post('data'));
            }
            // get the data passed from users' input (remove events)
            if($this->input->post('remove')){
                $uid = $this->input->post('uid');
                $day = $this->input->post('day');

                $this->CalendarModel->removeCalendarData($uid,"$year-$month-$day");
            }

            $data = [
                // generate calendar
                'calender' => $this->CalendarModel->generateCalendar($uid, $year, $month),
                'uid' => $uid
            ];
            // load the view page
            $this->load->view('calendar_page', $data);

        }else{
            $data = [
                // generate calendar without event
                'calender' => $this->CalendarModel->generateEmptyCalendar($year, $month),
            ];
            // load the view page
            $this->load->view('calendar_page', $data);
        }
    }
}







