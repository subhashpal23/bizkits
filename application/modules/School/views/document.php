
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Documents</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Documents Upload</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Upload Documents</h3>
                                <?php 
                                //echo $doccount;
                                if($doccount>0)
                                {
                                $array=array('pending','online','offline');
                                $array_message=array('Documents uploaded and under review on ','Documents reviewed and approved on ','Documents reviewed and cancelled on ');
                                
                                $status=$array[$verify_status];
                                $message=$array_message[$verify_status];
                                ?>
                                <div class="user-status <?php echo $status;?>"></div>
                                <?php echo $message;?>
                                <?php echo date('d/m/Y', strtotime($verify_date));?>
                                <?php
                                }
                                
                                ?>
                            </div>
                            
                        </div>
                        <form class="new-added-form" method="post" action="<?php echo base_url();?>School/allDocuments" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6 col-12 form-group mg-t-30">
                                    <label class="text-dark-medium">National Identity</label>
                                    <input type="file" name="nin_doc" class="form-control-file">
                                    <?php
                                    if($doccount>0)
                                    {
                                    ?>
                                    <img src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->nin_doc;?>" style="width:100px;" onclick="openModal();currentSlide(1)">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-lg-6 col-12 form-group mg-t-30">
                                    <label class="text-dark-medium">Registration Document</label>
                                    <input type="file" name="registration_doc" class="form-control-file">
                                    <?php
                                    if($doccount>0)
                                    {
                                    ?>
                                    <img src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->registration_doc;?>" style="width:100px;" onclick="openModal();currentSlide(2)">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-lg-6 col-12 form-group mg-t-30">
                                    <label class="text-dark-medium">Agreement</label>
                                    <input type="file" name="agreement_doc" class="form-control-file">
                                    <?php
                                    if($doccount>0)
                                    {
                                    ?>
                                    <img src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->agreement_doc;?>" style="width:100px;" onclick="openModal();currentSlide(3)">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-lg-6 col-12 form-group mg-t-30">
                                    <label class="text-dark-medium">Campus Photo</label>
                                    <input type="file" name="campus_photo" class="form-control-file">
                                    <?php
                                    if($doccount>0)
                                    {
                                    ?>
                                    <img src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->campus_photo;?>" style="width:100px;" onclick="openModal();currentSlide(4)">
                                    <?php
                                    }
                                    ?>
                                </div>
                                
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" name="btn" value="Save">Upload</button>
                                    <!--<button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                <div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->nin_doc;?>" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 4</div>
      <img src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->registration_doc;?>" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 4</div>
      <img src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->agreement_doc;?>" style="width:100%">
    </div>
    
    <div class="mySlides">
      <div class="numbertext">4 / 4</div>
      <img src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->campus_photo;?>" style="width:100%">
    </div>
    
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


   <!-- <div class="column">
      <img class="demo cursor" src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->nin_doc;?>" style="width:100%" onclick="currentSlide(1)" alt="National Identity">
    </div>
    <div class="column">
      <img class="demo cursor" src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->registration_doc;?>" style="width:100%" onclick="currentSlide(2)" alt="Registration Doc">
    </div>
    <div class="column">
      <img class="demo cursor" src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->agreement_doc;?>" style="width:100%" onclick="currentSlide(3)" alt="Agreement">
    </div>
    <div class="column">
      <img class="demo cursor" src="<?php echo base_url();?>schooldocuments/<?php echo $documents_list->campus_photo;?>" style="width:100%" onclick="currentSlide(4)" alt="Campus Photo">
    </div>-->
  </div>
</div>

<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
<style>
    .column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 100;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.user-status {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 10px;
}

.online {
    background-color: green;
}

.offline {
    background-color: red;
}
.pending {
    background-color: yellow;
}
</style>              