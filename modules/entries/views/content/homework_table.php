<?php
  function date_compare($a, $b)
  {
      $t1 = strtotime($a['due_date']);
      $t2 = strtotime($b['due_date']);
      return $t1 - $t2;
  }  
  usort($mesagedata, "date_compare"); 
 ?>
    <h1>Exam in Class <?php echo $classname; ?>

        <?php if(!  empty($connectedclass)){ ?>  
          <div style="float:right; font-size: 12px; color:red">Show all teachers  
            <input type="checkbox" name="" onclick="load_alldata_homework('<?php echo $idofclass ?>')"></div> 
        <?php }else{ ?>
          <a href="<?php echo base_url(); ?>settings/student/student"> <div style="float:right; font-size: 12px; color:red">Connect to another teacher</div> </a>
        <?php }?>
    </h1>

        <div class="message" id="home_work">
          <nav>
            <ul>
                <?php  if(isset($mesagedata)){ 
                   $datearrt =  array();
                   $count = 0;
                 foreach ($mesagedata as $key => $value) {
                  if($value['due_date'] >= date('Y-m-d') && $value['teachers_name'] == get_teacher_id()){
                   
                   ?>
                        <li>
                            <table style="width: 100%; <?php if(isset($value[0])){?> color:gray; <?php } ?> " >
                              <?php if(in_array($value['due_date'], $datearrt)){ ?>
                                  <tr>
                                      <td></td>
                                      <td><?php echo $value['subject']; ?></td>
                                      <td>
                                        <?php echo $value['description']; ?>
                                      </td>
                                      <td>
                                        <?php if(!isset($value[0])){?>
                                         <button style="color:none;border: none; padding: 0" class="delete delete-homework" data-id="<?php echo $idofclass; ?>" data-key="<?php echo $key ?>" >&#10007;</button>
                                          <?php } ?>
                                       </td>
                                  </tr>
                              <?php }else{ ?>
                                  <tr>
                                    <td><?php echo $value['due_date']; ?></td>
                                    <td><?php echo $value['subject']; ?></td>
                                    <td>
                                      <?php echo $value['description']; ?>
                                    </td>
                                    <td>
                                   <?php if(!isset($value[0])){?>
                                         <button style="color:none;border: none; padding: 0" class="delete delete-homework" data-id="<?php echo $idofclass; ?>" data-key="<?php echo $key ?>" >&#10007;</button>
                                    <?php } ?>
                                     </td>
                                  </tr>
                              <?php }?>
                            </table>
                        </li>
                 <?php  
                 $datearrt[$count] = $value['due_date']; 
                 $count++;
                 } // end date con
                 } // end loop
                 } // end empty check
                ?>
            </ul>
          </nav>
        </div>


         <div class="sec-late-homework" id="late-homework">
              <h1>Homework of the last few days</h1>
              <div class="message">
                <nav>
                  <ul>
                  <?php  if(isset($mesagedata)){ 
                    $datearrtlastdy =  array();
                    $countday = 0;
                    foreach ($mesagedata as $key => $valueday) {
                      if($valueday['due_date'] < date('Y-m-d')){
                  ?>
                    <li>
                      <table style="width: 100%; ">
                         <?php if(in_array($valueday['due_date'], $datearrtlastdy)){ ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td><?php echo $valueday['subject']; ?></td>
                                <td><?php echo $valueday['description']; ?></td>
                                <td></td>
                              
                            </tr>
                        <?php }else{ ?>
                        <tr>
                          <td><?php echo $valueday['due_date']; ?></td>
                          <td><?php echo $valueday['subject']; ?></td>
                          <td><?php echo $valueday['description']; ?></td>
                          <td></td>
                        </tr>
                        <?php }?>
                      </table>
                    </li>
                 <?php 
                   $datearrtlastdy[$countday] = $valueday['due_date']; 
                   $countday++;
                 } // end date con
                 } // end loop
                 } // end empty check
                 ?>
                  </ul>
                </nav>
              </div>
            </div>
            

