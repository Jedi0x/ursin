<!DOCTYPE html>
<html lang="en">



<body>
  <header class="header-area">
    <div class="container">
      <div class="logo-area">
        <a href="https://edtools.io/apps/"><img src="<?php echo base_url(); ?>assets/entries/images/logo.png" alt="Logo"></a>
      </div>
      <div class="menu-area">
        <nav>
          <ul>
             <li><a href="<?php echo base_url('entries/homework'); ?>">Homework</a></li> 
              <li id="ex-item"><a href="<?php echo base_url('entries/exams'); ?>">Exams</a></li>
              <li id="ms-item"><a href="<?php echo base_url('entries/messages'); ?>">Messages</a></li>
              <li id="lk-item"><a id="ln-active" href="<?php echo base_url('entries/link'); ?>">Links</a></li>
              <li id="cl-item"><a href="<?php echo base_url('entries/calendar'); ?>">Calender</a></li>
              
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
   <form  action="<?php echo base_url('entries/Calendar/manage'); ?>" method="POST" onsubmit="return checkvalidation_calendar();">
  <section class="class-selection calender-cl-sel">
    <div class="container">
      <div class="custom-select">
        <select name="class_id" id="class_id_calendar">
          <option value="">Select Class</option>
            <?php foreach ($classes as $class) { ?>
                    <option value="<?=$class['_id']?>"><?=$class['class_name']?></option>
            <?php } ?>
        </select>
      </div>
    </div>
  </section>
  <section class="form-area calender-form">
    <div class="container">
      <h1 class="typer">Publish an event</h1>
     
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Enter title" required="required">
        <label for="date">Date</label>
        <input id="datepicker"  name="activity_date" onfocus="(this.type='date')" class="js-form-control" placeholder="Enter date" required="required">
        <label for="descrption">Description</label>
        <textarea name="description" maxlength="200" id="descrption1" cols="30" rows="6" placeholder="Write event details" required="required"></textarea>
        <input type="checkbox" name="publishforall" value="publish" id="check">
        <label id="check-text" for="check">Publish for all classes</label>
        <button id="send">Send</button>
      
    </div>
  </section>
  </form>
  <section class="bottom-area calender-bottom" id="calendarbox">
    
  </section>
  <footer class="footer-area">
    <div class="container">
      <p>Calendar entries are automatically deleted after the due date.</p>
    </div>
  </footer>

<?php }else{?>
 <section>
        <div class="container">
        <div style="padding: 20px; background-color: red; color:white">
          Calendar entries are not shown for this class in the students dashboard. Please activate it in the settings <a href="<?php echo base_url() ?>settings/student/student"> click here</a>. 
        </div>
      </div>
 </section>
<?php } ?>
