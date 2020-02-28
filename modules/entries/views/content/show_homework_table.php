<?php 

function date_compare($a, $b)
{
    $t1 = strtotime($a['due_date']);
    $t2 = strtotime($b['due_date']);
    return $t1 - $t2;
}  
usort($mesagedata, "date_compare"); 


if($filterdayval == 'today'){
   $checkfilter = date('Y-m-d');
}else if($filterdayval == 'tomorrow'){

  $checkfilter = date('Y-m-d',strtotime(' +1 day'));

}else if($filterdayval == 'future'){
  $checkfilter = date('Y-m-d');
}
?>

<div class="container">
      <table class="std-table">
              <?php
                 $datearrt =  array();
                 $dateforday =  array();
                 $count = 0;
             foreach ($mesagedata as $key => $value) {

                  if($checkfilter == $value['due_date'] || $filterdayval == 'future'){
                      if($value['teachers_name'] == get_teacher_id()){

                            $orgDate = $value['due_date'];  
                            $day = date("d", strtotime($orgDate)); 
                            $month = date("F", strtotime($orgDate)); 
                      ?>
                      <?php if(in_array($month, $datearrt)){ ?>
                          <tr <?php if(!in_array($value['due_date'], $dateforday)){ echo 'class="border-top"'; }?>>
                            <td></td>
                            <td><span class="bigfnt"><?php if(!in_array($value['due_date'], $dateforday)){ echo $day; }?></span></td>
                            <td><?php echo $value['subject']; ?></td>
                            <td><?php echo $value['description']; ?></td>
                          </tr>
                      <?php }else{ ?>
                          <tr class="border-top">
                            <td><span class="bigfnt"><?php echo $month; ?></span></td>
                            <td><span class="bigfnt"><?php echo $day; ?></span></td>
                            <td><?php echo $value['subject']; ?></td>
                            <td><?php echo $value['description']; ?></td>
                          </tr>
                      <?php }?>
                      <?php 
                               $datearrt[$count] = $month; 
                               $dateforday[$count] = $value['due_date'];
                               $count++;
                        }//end teacher check
                        }// filter of day today,tomorrow,future
              }//endloop
              ?>
      </table>
    </div>
            

