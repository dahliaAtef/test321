<?php

namespace common\helpers;

/**
 * Google chart Helper 
 * @author Dalia Atef <dahliaatef@hotmail.com>
 */
class InstagramGoogleChartHelper extends GoogleChartHelper {
    
    public static function getInstagramTwoTimeDataTable($x_axis, $graph_one_y_axis,$graph_two_y_axis, $graph_one_values, $graph_two_values, $key_name){
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $graph_one_y_axis, 'type' => 'number'],
            ['label' => $graph_two_y_axis, 'type' => 'number'],
        ];
        $rows = array();
        foreach($graph_one_values as $key => $value){
            $rows[] = ['c' =>[
                ['v' => $key],
                ['v' => $value[$key_name]],
                ['v' => $graph_two_values[$key][$key_name]]
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
    
    public static function getInstagramDataTableUsingKeyName($x_axis, $y_axis, $second_y_axis = null, $graph_values, $second_graph_values = null, $key_name, $second_key_name = null) {
        $table = array();
        $table['cols'] = [
            ['label' => $x_axis, 'type' => 'string'],
            ['label' => $y_axis, 'type' => 'number'],
        ];
        ($second_y_axis) ? $table['cols'][2] = ['label' => $second_y_axis, 'type' => 'number'] : '';
        $rows = array();
        
        if($second_y_axis && $second_graph_values){
            foreach($graph_values as $key => $value){
                $rows[] = ['c' => [
                    ['v' => $key],
                    ['v' => $value[$key_name]],
                    ['v' => $second_graph_values[$key][$key_name]],
                ]];
            }
        }elseif($second_y_axis && $second_key_name){
            foreach($graph_values as $key => $value){
                $rows[] = ['c' => [
                    ['v' => $key],
                    ['v' => $value[$key_name]],
                    ['v' => $value[$second_key_name]],
                ]];
            }
        }else{
            foreach($graph_values as $key => $value){
                $rows[] = ['c' => [
                    ['v' => $key],
                    ['v' => $value[$key_name]],    
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

}