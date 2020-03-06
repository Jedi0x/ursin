
  <header class="header-area">
    <div class="container">
      <div class="logo-area">
        <a href="https://edtools.io/apps/"><img src="<?php echo base_url(); ?>assets/entries/images/logo.png" alt="Logo"></a>
      </div>
      <div class="menu-area">
        <nav>
          <ul>
              <li><a href="<?php echo base_url('entries/Homework'); ?>">Homework</a></li> 
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
 <form action="<?php echo base_url('entries/Link/manage'); ?>" method="POST" onsubmit="return checkvalidation_links();">
  <section class="class-selection link-cl-sel">
    <div class="container">
      <div class="custom-select">
        <select name="class_id" id="clasid_link">
            <option value="">Select Class</option>
            <?php foreach ($classes as $class) { ?>
              <option value="<?=$class['_id']?>"><?=$class['class_name']?></option>
            <?php } ?>
        </select>
      </div>
    </div>
  </section>
  <section class="form-area link-form">

    <div class="container">
      <h1 class="typer">Publish a weblink</h1>
 
        <label for="url">URL</label>
        <input type="text" name="url" id="urlid" placeholder="Enter a valid url">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Enter title" required="required">
        <label for="description">Description</label>
        <textarea maxlength="400"  name="description" id="description" cols="30" rows="6" placeholder="Please describe" required="required"></textarea>
        <input type="checkbox" id="check" value="publish" name="publishforall">
        <label id="check-text" for="check">Publish for all classes</label>
        <div class="form-bottom-selection">
          <div class="selection-part">
            <select name="category" id="">
               <option value="">Select Category</option>
               <option value="classroom">Classroom</option>
               <option value="homework">Homework</option>
               <option value="leisure_time">Leisure time</option>
               <option value="learning">Learning</option>
               <option value="parents">Parents(only)</option>
               <option value="school">School</option>
               <option value="tools">Tools</option>
               <option value="various">Various</option>
            </select>
          </div>
          <div class="selection-part">
                    <div class="form-input form-input-icon" >
                      <div class="get-and-preview">
                               
                          <button style="width: 100%;padding: 5px 7px;font-size: 18px;border-radius: 50px;border: 4px solid #fff;background: #94427f;color: #fff;" type="button" id="GetIconPicker" data-iconpicker-input="input#IconInput" data-iconpicker-preview="i#IconPreview">Select Icon</button>
                      </div>

                            <div class="export">
                                <input type="hidden" id="IconInput" name="icon" required placeholder="Hidden etc. input for icon classname" autocomplete="off" spellcheck="false" />
                            </div>
                      </div>
            <div class="color-bar">
              <ul>
                <input type="hidden" name="color" id='colorset'>
                <li><a href="javascript:void(0)"  onclick="changecolor('#00AEEF')">
                    <div id="clr-ptr" class="color-box"></div>
                  </a></li>
                <li><a href="javascript:void(0)"  onclick="changecolor('#EC008C')">
                    <div id="clr-alg" class="color-box"></div>
                  </a></li>
                <li><a href="javascript:void(0)"  onclick="changecolor('#F37121')">
                    <div id="clr-carrot" class="color-box"></div>
                  </a></li>
                <li><a href="javascript:void(0)"  onclick="changecolor('#25408F')">
                    <div id="clr-mblue" class="color-box"></div>
                  </a></li>
                <li><a href="javascript:void(0)"  onclick="changecolor('#A42780')">
                    <div id="clr-amet" class="color-box"></div>
                  </a></li>
                <li><a href="javascript:void(0)"  onclick="changecolor('#B3C935')">
                    <div id="clr-org" class="color-box"></div>
                  </a></li>
              </ul>
            </div>
          </div>
          <div class="selection-part">
            <div class="icon-box" id='setboxcolor'>
              <a href="#"> 
                  <div class="icon-preview" data-toggle="tooltip" title="Preview of selected Icon">
                    <i id="IconPreview" style="font-size: 35px; padding: 16px; color: white;" class="fas fa-pencil-alt"></i>
                  </div>
              </a>
            </div>
          </div>
        </div>
                        

        <button type="submit" id="send">Send</button>
     
    </div>
  </section>
   </form>
  <section class="bottom-area link-bottom" id='linkbox'>
    
  </section>
  <footer class="footer-area">
    <div class="container">
      <p>Students can access your links from anywhere, even from home. The Student Dashboard takes them to the clearly arranged link page, which can also be set up as a browser start page. This simplifies working with online tools and prevents mistyping. </p>
    </div>
  </footer>
<?php }else{?>
 <section>
        <div class="container">
        <div style="padding: 20px; background-color: red; color:white">
         Weblinks are not shown for this class in the students dashboard. Please activate it in the settings. <a href="<?php echo base_url() ?>settings/student/student"> click here</a>. 
        </div>
      </div>
 </section>
<?php } ?>