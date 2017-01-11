<?php

namespace common\helpers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\HttpException;

/**
 * Google chart Helper 
 * @author Dalia Atef <dahliaatef@hotmail.com>
 */
class GoogleChartHelper {

    /**
     * Get Data Table
     * @author Dalia Atef <dahliaatef@hotmail.com>
     * @param string $x_axis of graph
     * @param string $y_axis of graph
     * @param array $values to be graphed
     * @return object $json_table of values
     * y_axis is date
     */
    public static function getKeyValueTimeDataTableWithValueKeyName($x_axis, $y_axis, $values, $value_key_name) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $key => $value){
                $rows[] = ['c' => [
                ['v' => ucwords(strtolower((((date('d', $key)) != 1) ? date('d', $key) : date('M d', $key))))],
                ['v' => $value[$value_key_name]],    
                ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    /**
     * Get Data Table
     * @author Dalia Atef <dahliaatef@hotmail.com>
     * @param string $x_axis of graph
     * @param string $y_axis of graph
     * @param array $values to be graphed
     * @return object $json_table of values
     * y_axis is date
     */
    public static function getKeyValueDataTableWithValueKeyName($x_axis, $y_axis, $values, $value_key_name) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $key => $value){
                $rows[] = ['c' => [
                ['v' => ucwords(strtolower($key))],
                ['v' => $value[$value_key_name]],    
                ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    /**
     * Get Data Table
     * @author Dalia Atef <dahliaatef@hotmail.com>
     * @param string $x_axis of graph
     * @param string $y_axis of graph
     * @param array $values to be graphed
     * @return object $json_table of values
     * y_axis is date
     */
    public static function getKeyValueDataTableWithValueKeyNameTime($x_axis, $y_axis, $values, $value_key_name) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $key => $value){
            $refine_date = date('d', $key);
            $date_day = date('M d', $key);
            $date = (($refine_date != '01') ? $refine_date : $date_day);
                $rows[] = ['c' => [
                ['v' => $date],
                ['v' => $value[$value_key_name]],    
                ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    
    
    public static function getSameArrayThreeValuesDataTableUsingKeyNames($x_axis, $first_y_axis, $second_y_axis, $third_y_axis, $values, $first_key_name, $second_key_name, $third_key_name){
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $first_y_axis, 'type' => 'number'],
            ['label' => $second_y_axis, 'type' => 'number'],
            ['label' => $third_y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $key => $value){
                $rows[] = ['c' => [
                ['v' => ucwords(strtolower($key))],
                ['v' => $value[$first_key_name]],
                ['v' => $value[$second_key_name]],
                ['v' => $value[$third_key_name]],
                ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    /**
     * Get Data Table
     * @author Dalia Atef <dahliaatef@hotmail.com>
     * @param string $x_axis of graph
     * @param string $y_axis of graph
     * @param array $values to be graphed
     * @return object $json_table of values
     */
    public static function getDataTable($x_axis, $y_axis, $values) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $key => $value){
            $rows[] = ['c' =>[
                ['v' => ucwords(strtolower($key))],
                ['v' => $value]
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
  
  /**
     * Get Data Table
     * @author Dalia Atef <dahliaatef@hotmail.com>
     * @param string $x_axis of graph
     * @param string $y_axis of graph
     * @param array $values to be graphed
     * @return object $json_table of values
     */
    public static function getRegularTimeDataTable($x_axis, $y_axis, $values) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $key => $value){
            $rows[] = ['c' =>[
                ['v' => (((date('d', ($key))) != 1) ? date('d', ($key)) : date('M d', ($key)))],
                ['v' => $value]
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
  
    /**
     * Get Data Table for two time graphs
     * @author Dalia Atef <dahliaatef@hotmail.com>
     * @param string $x_axis of graph
     * @param string $y_axis of graph
     * @param array $values to be graphed
     * @return object $json_table of values
     */
    public static function getTwoTimeGraphsDataTable($x_axis, $graph_one_y_axis,$graph_two_y_axis, $graph_one_values, $graph_two_values) {
        $counter = 0;
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $graph_one_y_axis, 'type' => 'number'],
            ['label' => $graph_two_y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($graph_one_values as $value){
            $rows[] = ['c' =>[
                ['v' => (((date('d', strtotime($value["end_time"]))) != 1) ? date('d', strtotime($value["end_time"])) : date('M d', strtotime($value["end_time"])))],
                ['v' => $value["value"]],
                ['v' => $graph_two_values[$counter]["value"]]
            ]];
            $counter++;
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    /**
     * Get Data Table for two Date graphs using key names
     * @author Dalia Atef <dahliaatef@hotmail.com>
     * @param string $x_axis of graph
     * @param string $y_axis of graph
     * @param array $values to be graphed
     * @return object $json_table of values
     */
    public static function getTwoGraphsByDayDataTableUsingKeyNames($x_axis, $graph_one_y_axis,$graph_two_y_axis, $x_axis_values, $graph_one_values, $graph_one_key, $graph_two_values, $graph_two_key) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $graph_one_y_axis, 'type' => 'number'],
            ['label' => $graph_two_y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($x_axis_values as $x_axis_value){
            $rows[] = ['c' =>[
                ['v' => ucwords(strtolower($x_axis_value))],
                ['v' => $graph_one_values[$x_axis_value][$graph_one_key]],
                ['v' => $graph_two_values[$x_axis_value][$graph_two_key]]
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
      /**
     * Get Time Data Table for two Date graphs using key names
     * @author Dalia Atef <dahliaatef@hotmail.com>
     * @param string $x_axis of graph
     * @param string $y_axis of graph
     * @param array $values to be graphed
     * @return object $json_table of values
     */
    public static function getTwoGraphsByDayTimeDataTableUsingKeyNames($x_axis, $graph_one_y_axis,$graph_two_y_axis, $x_axis_values, $graph_one_values, $graph_one_key, $graph_two_values, $graph_two_key) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $graph_one_y_axis, 'type' => 'number'],
            ['label' => $graph_two_y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($x_axis_values as $x_axis_value){
            $rows[] = ['c' =>[
                ['v' => (((date('d', $x_axis_value)) != 01) ? date('d', $x_axis_value) : date('M d', $x_axis_value))],
                ['v' => $graph_one_values[$x_axis_value][$graph_one_key]],
                ['v' => $graph_two_values[$x_axis_value][$graph_two_key]]
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
  
    
    /**
     * Get Data Table
     * @author Dalia Atef <dahliaatef@hotmail.com>
     * @param string $x_axis of graph
     * @param string $y_axis of graph
     * @param array $values to be graphed
     * @return object $json_table of values
     * y_axis is date
     */
    public static function getTimeDataTable($x_axis, $y_axis, $values) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $value){
            if(array_key_exists('value', $value)){
                $rows[] = ['c' => [
                ['v' => (((date('d', strtotime($value["end_time"]))) != 1) ? date('d', strtotime($value["end_time"])) : date('M d', strtotime($value["end_time"])))],
                ['v' => $value["value"]],    
                ]];
            }
            
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
//    
//    public static function getInstagramTwoTimeDataTable($x_axis, $graph_one_y_axis,$graph_two_y_axis, $graph_one_values, $graph_two_values){
//        $counter = 0;
//        $table = array();
//        $table['cols'] = [
//            ['label' => $x_axis, 'type' => 'string'],
//            ['label' => $graph_one_y_axis, 'type' => 'number'],
//            ['label' => $graph_two_y_axis, 'type' => 'number'],
//        ];
//        $rows = array();
//        foreach($graph_one_values as $key => $value){
//            $rows[] = ['c' =>[
//                ['v' => $key],
//                ['v' => $value["amount"]],
//                ['v' => $graph_two_values[$key]["amount"]]
//            ]];
//            $counter++;
//        }
//        if($rows){
//            $table['rows'] = $rows;
//            $json_table = json_encode($table);
//            return $json_table;
//        }else{
//            $json_table = null;
//            return $json_table;
//        }
//    }
//    
    public static function getArrayOfArrayDataTable($x_axis, $y_axis, $values) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $first_array){
            foreach($first_array as $key => $value){
                $rows[] = ['c' =>[
                    ['v' => ucwords(strtolower($key))],
                    ['v' => $value]
                ]];
            }
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    public static function getValuesSameArrayDataTable($x_axis, $y_axis, $values) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $value){
            $rows[] = ['c' =>[
                ['v' => ucwords(strtolower($value[0]))],
                ['v' => $value[1]],
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    public static function getKeyAndValueByValueIndexDataTable($x_axis, $y_axis, $values, $index) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $value){
            $rows[] = ['c' =>[
                ['v' => ucwords(strtolower($value[0]))],
                ['v' => $value[$index]],
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    public static function getTwoValuesSameArrayDataTable($x_axis, $first_y_axis, $second_y_axis, $values) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $first_y_axis, 'type' => 'number'],
            ['label' => $second_y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $value){
            $rows[] = ['c' =>[
                ['v' => ucwords(strtolower($value[0]))],
                ['v' => $value[1]],
                ['v' => $value[2]],
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    public static function getTwoValuesDiffArraysDataTable($x_axis, $first_y_axis, $second_y_axis, $first_values, $second_values){
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $first_y_axis, 'type' => 'number'],
            ['label' => $second_y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $key => $value){
            $rows[] = ['c' =>[
                ['v' => ucwords(strtolower($key))],
                ['v' => $value],
                ['v' => $value[2]],
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    public static function getGenderAgesDataTable($age_ranges, $male, $female) {
        $table = array();
        $table['cols'] = [
                ['label' => 'age range', 'type' => 'string'],
                ['label' => 'male', 'type' => 'number'],
                ['label' => 'female', 'type' => 'number'],
            ];
        $rows = array();
        foreach($age_ranges as $age_range){
            $rows[] = ['c' =>[
                ['v' => ucwords(strtolower($age_range))],
                ['v' => (array_key_exists($age_range, $male)) ? $male[$age_range] : 0],
                ['v' => (array_key_exists($age_range, $female)) ? $female[$age_range] : 0],
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }

    public static function bestTimeToPost($values){
        $table = array();
        $table['cols'] = [
                ['label' => 'hour', 'type' => 'string'],
                ['label' => 'day', 'role' => 'annotation','type' => 'string'],
                ['label' => 'interaction', 'type' => 'number'],
            ];
        $rows = array();
        foreach($values as $hour => $days_of_week){
            if(!$days_of_week){
                $rows[] = ['c' =>[
                    ['v' => $hour],
                    ['v' => null],
                    ['v' => null],
                ]];
            }else{
               foreach($days_of_week as $day => $interaction){
                $rows[] = ['c' =>[
                    ['v' => ucwords(strtolower($hour))],
                    ['v' => $day],
                    ['v' => $interaction],
                ]];
                } 
            }
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
  
    public static function getSameArrayThreeValuesTimeDataTableUsingKeyNames($x_axis, $first_y_axis, $second_y_axis, $third_y_axis, $values, $first_key_name, $second_key_name, $third_key_name){
      $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $first_y_axis, 'type' => 'number'],
            ['label' => $second_y_axis, 'type' => 'number'],
            ['label' => $third_y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($values as $key => $value){
                $rows[] = ['c' => [
                ['v' => (((date('d', $key)) != 01) ? date('d', $key) : date('M d', $key))],
                ['v' => $value[$first_key_name]],
                ['v' => $value[$second_key_name]],
                ['v' => $value[$third_key_name]],
                ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
    
    
    public static function getBestTimeToPost($values){
        $table = array();
        $table['cols'] = [
                ['label' => 'hour', 'type' => 'string'],
                ['label' => 'Sun', 'type' => 'number'],
                ['label' => 'Sat', 'type' => 'number'],
                ['label' => 'Fri', 'type' => 'number'],
                ['label' => 'Thu', 'type' => 'number'],
                ['label' => 'Wed', 'type' => 'number'],
                ['label' => 'Tue', 'type' => 'number'],
                ['label' => 'Mon', 'type' => 'number'],
            ];
        $rows = array();
        foreach($values as $hour => $days_of_week){
            $rows[] = ['c' =>[
                ['v' => $hour],
                ['v' => $days_of_week['Sun']],
                ['v' => $days_of_week['Sat']],
                ['v' => $days_of_week['Fri']],
                ['v' => $days_of_week['Thu']],
                ['v' => $days_of_week['Wed']],
                ['v' => $days_of_week['Tue']],
                ['v' => $days_of_week['Mon']],
            ]];
        }
        if($rows){
            $table['rows'] = $rows;
            $json_table = json_encode($table);
            return $json_table;
        }else{
            $json_table = null;
            return $json_table;
        }
    }
}
