<?php 
if(!function_exists('eventRepeatData')){
    function eventRepeatData($getData=null,$refence=null){
        $firstData = array('1'=>'Every','3'=>'Every third','4'=>'Every fourth');
        $secondData = array('D'=>'Day','W'=>'Week','M'=>'Month','Y'=>'Year');
        $thirdData = array('1'=>'First','2'=>'Second','3'=>'Third','4'=>'Fourth');
        $fourthData = array('sunday'=>'Sunday','monday'=>'Monday','tuesday'=>'Tuesday','wednesday'=>'Wednesday','thrusday'=>'Thrusday','friday'=>'Friday','saturday'=>'Saturday');
        $fifthData = array('3'=>'3 months','4'=>'4 months','6'=>'6 months','12'=>'Year');

        if($refence){
            if($refence==1){
                $explodeData = explode(' ',$getData);
                return $firstData[$explodeData[0]]. " " .$secondData[$explodeData[1]];
            }else{
                $explodeData = explode(' ',$getData);
                return $thirdData[$explodeData[0]]. " " .$fourthData[$explodeData[1]]." ".$fifthData[$explodeData[2]];
            }
        }

        return [$firstData,$secondData,$thirdData,$fourthData,$fifthData];
    }
}
?>