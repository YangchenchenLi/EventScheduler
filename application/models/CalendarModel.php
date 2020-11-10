<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CalendarModel extends CI_Model
{
    public $prefs;

    public function __construct()
    {
        // create calendar template
        $this->prefs['template'] = '
        {table_open}<table cellpadding="1" cellspacing="2">{/table_open}
        
        {heading_row_start}<tr>{/heading_row_start}
        
        {heading_previous_cell}<th class="prev_sign"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th class="next_sign"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
        
        {heading_row_end}</tr>{/heading_row_end}
        
        //Deciding where to week row start
        {week_row_start}<tr class="week_name">{/week_row_start}
        //Deciding  week day cell and  week days
        {week_day_cell}<td >{week_day}</td>{/week_day_cell}
        //week row end
        {week_row_end}</tr>{/week_row_end}
        
        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="day">{/cal_cell_start}
        
        {cal_cell_content}
            <div class="day_num click">{day}</div>
            <div class="content click">{content}</div>
        {/cal_cell_content}
        {cal_cell_content_today}
            <div class="day_num highlight click">{day}</div>
            <div class="content click">{content}</div>
        {/cal_cell_content_today}
        
        {cal_cell_no_content}<div class="day_num click">{day}</div>{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="day_num highlight click">{day}</div>{/cal_cell_no_content_today}
        
        {cal_cell_blank}&nbsp;{/cal_cell_blank}
        
        {cal_cell_end}</td>{/cal_cell_end}
        {cal_row_end}</tr>{/cal_row_end}
        
        {table_close}</table>{/table_close}
        ';
        // set up calendar preference
        $this->prefs['start_day'] = 'monday';
        $this->prefs['day_type'] = 'short';
        $this->prefs['show_next_prev'] = true;
        $this->prefs['next_prev_url'] = base_url().'Calendar/index';
    }

    public function getCalendarData($uid,$year, $month){
        // fetch the data from calendar table with the specific year and month
        $query = $this->db->select('date, data')->from('calendar')->where('uid',$uid)->like('date', "$year-$month", 'after')->get();
        $calendarData = array();
        foreach ($query->result() as $row){
            // important: convert date string to integer can solve the problem that
            // "no events showing for the first 9 days of the month"
            $calendarData[intval(substr($row->date,8,2))] = $row->data;
        }
        return $calendarData;
    }

    public function addCalendarData($uid, $date, $data){
       $result = $this->db->select('date','data','uid')->from('calendar')->where('uid',$uid)->where('date',$date)->count_all_results();

        if($result){
            $this->db->where('uid', $uid)->where('date',$date)->update('calendar', array(
                'date' => $date,
                'data' => $data
            ));
        }else{
            $this->db->insert('calendar', array(
                'uid' => $uid,
                'date' => $date,
                'data' => $data
            ));
        }
    }

    public function removeCalendarData($uid, $date){
        $this->db->where('uid',$uid)->where('date',$date)->delete('calendar');
    }

    public function generateCalendar($uid, $year, $month){
        // Loading calendar library and configuring table template
        $this->load->library('calendar', $this->prefs);
        // add data into calendar
//        $this->addCalendarData('1','2020-04-26',"infs7205 due");
        // set up calendar event
        $calendar_data = $this->getCalendarData($uid, $year, $month);

        return $this->calendar->generate($year , $month, $calendar_data);
    }

    public function generateEmptyCalendar($year, $month){
        // Loading calendar library and configuring table template
        $this->load->library('calendar', $this->prefs);
        return $this->calendar->generate($year , $month);
    }
}