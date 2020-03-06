
<body>
  <header class="header-area">
    <div class="container">
      <div class="logo-area">
        <a href="https://edtools.io/apps/"><img src="<?php echo base_url(); ?>assets/entries/images/logo.png" alt="Logo"></a>
      </div>
      <div class="menu-area">
        <nav>
          <ul>
            <li class="drp-itm" id="wh-item"><a id="hw-active" href="<?php echo base_url('entries/Homework'); ?>">Homework <i class="fas fa-angle-down"></i></a>
              <ul>
                <li><a href="<?php echo base_url('entries/Showhomework'); ?>">Show on frontscreen</a></li>
                <li><a href="<?php echo base_url('entries/Absent'); ?>">Who is absent?</a></li>
              </ul>
            </li>
              <li id="ex-item"><a href="<?php echo base_url('entries/Exams'); ?>">Exams</a></li>
              <li id="ms-item"><a href="<?php echo base_url('entries/Messages'); ?>">Messages</a></li>
              <li id="lk-item"><a id="ln-active" href="<?php echo base_url('entries/Link'); ?>">Links</a></li>
              <li id="cl-item"><a href="<?php echo base_url('entries/Calendar'); ?>">Calender</a></li>
            
            <li class="drp-itm" id="mr-item"><a href="">More<i class="fas fa-angle-down"></i></a>
              <ul>
                <li><a href="#">Open Task</a></li>
                <li><a href="#">Checklist</a></li>
                <li><a href="#">Settings</a></li>
              </ul>
            </li>
            <li id="ques-mark"><a class="ques-mark" href="#"><img src="images/question.png" alt=""></a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
  <?php if(!isset($showbanner)){ ?>
<form action="<?php echo base_url('entries/Homework/manage'); ?>" onsubmit="return checkvalidation_homework()" method="POST">
  <section class="class-selection hw-selt">
         
    <div class="container">
      <div class="custom-select">
        <select name="class_id" id="clasid_homework">
          <option value="">Select Class</option>
          <?php foreach ($classes as $class) { ?>
                <option value="<?=$class['_id']?>"><?=$class['class_name']?></option>
          <?php } ?>
        </select>
      </div>
      <div class="sec-left-btn">
        <ul>
          <li>
             <div class="tooltip">
          <a href="<?php echo base_url('entries/showhomework'); ?>">Show on Frontscreen</a>
           <span class="tooltiptext">Show the students the homework so that they can transfer it to their agenda.</span>
          </div>
        </li>
        <li title="Sick">
           <div class="tooltippdf">
             <a href="<?php echo base_url('entries/showhomework'); ?>"><i class="fas fa-thermometer-three-quarters"></i></a>
             <span class="tooltiptextpdf">Who is absent and should see this homeworks in his dashboard?</span>
           </div>
        </li>
        </ul>
      </div>
    </div>
  </section>
  
  <section class="form-area homework-form">
    <div class="container">
      <h1 class="typer">Give Homework</h1>
        <label for="title">Subject</label>
        <input type="text" name="subject" id="title" placeholder="Enter subject name" required="required">
        <label for="datepicker">Date</label>
        <input id="datepicker" name="due_date" onfocus="(this.type='date')" class="js-form-control" placeholder="Enter date" required="required">
        <label for="task">Task</label>
        <textarea name="description" maxlength="300" id="task" cols="30" rows="6" placeholder="Please describe" required="required"></textarea>
        <button class="hw-send" id="send">Send</button>
    
    </div>
  </section>
</form>
  <section class="bottom-area hw-bottom">
    <div class="container">
      <div class="homework-btn">
        <nav>
          <ul>
            <li id="wh-item">
              <div class="tooltip">
                <a href="<?php echo base_url('entries/showhomework'); ?>">Show on Frontscreen</a>
                <span class="tooltiptext">Show the students the homework so that they can transfer it to their agenda.</span>
              </div>
            </li>
          </ul>
        </nav>
        <br/><br/>
      </div>
        <div id="homeworkbox">

           
        </div>
    </div>
  </section>
  <footer class="footer-area">
    <div class="container">
      <p>Homework is automatically deleted five days after the due date. Students only see their upcoming and current homework in their dashboard.</p>
    </div>
  </footer>
<?php }else{?>
   <section>
        <div class="container">
        <div style="padding: 20px; background-color: red; color:white">
          Messages are not shown for this class in the students dashboard. Please activate it in the settings <a href="<?php echo base_url() ?>settings/student/student"> click here</a>. 
        </div>
      </div>
   </section>
<?php } ?>
