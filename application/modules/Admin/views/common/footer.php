<!-- Footer Area Start Here -->
                <footer class="footer-wrap-layout1">
                    <!--<div class="copyright">© Copyrights <a href="#">Interschool</a> 2023. All rights reserved. </div>-->
                </footer>
                <!-- Footer Area End Here -->
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="<?php echo base_url();?>assets/js/plugins.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <!-- Counterup Js -->
    <script src="<?php echo base_url();?>assets/js/jquery.counterup.min.js"></script>
    <!-- Moment Js -->
    <script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
    <!-- Waypoints Js -->
    <script src="<?php echo base_url();?>assets/js/jquery.waypoints.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="<?php echo base_url();?>assets/js/jquery.scrollUp.min.js"></script>
    <!-- Full Calender Js -->
    <script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
    <!-- Chart Js -->
    <script src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url();?>assets/js/main.js"></script>

<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>-->
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</body>

</html>
<style>
    .product-price{
        /*display:none;*/
    }
    #modalContainer {
	background-color:rgba(0, 0, 0, 0.3);
	position:absolute;
	width:100%;
	height:100%;
	top:0px;
	left:0px;
	z-index:10000;
	background-image:url(tp.png); /* required by MSIE to prevent actions on lower z-index elements */
}

#alertBox {
	position:relative;
	width:300px;
	min-height:100px;
	margin-top:50px;
	border:1px solid #666;
	/*background-color:#fff;*/
	background-color:#890224;
	
	background-repeat:no-repeat;
	background-position:20px 30px;
}

#modalContainer > #alertBox {
	position:fixed;
}

#alertBox h1 {
	margin:0;
	font:bold 0.9em verdana,arial;
	background-color:#890224;
	color:#FFF;
	border-bottom:1px solid #000;
	padding:2px 0 2px 5px;
}

#alertBox p {
	font:1em verdana,arial;
	height:50px;
	padding-left:5px;
	margin-left:55px;
	color:#FFF;
}

#alertBox #closeBtn {
	display:block;
	position:relative;
	margin:5px auto;
	padding:7px;
	border:0 none;
	width:70px;
	font:0.7em verdana,arial;
	text-transform:uppercase;
	text-align:center;
	color:#890224;
	background-color:#b9edd4;
	border-radius: 3px;
	text-decoration:none;
}

.#closeBtn:hover {
    background-color: #890224;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.05);
}
/*#closeBtn {
    position: relative;
    display:block;
    padding: 6px 20px 6px 20px;
    border-radius: 4px;
    background-color: #DEF9EC;
    font-size: 14px;
    font-weight: 700;
}*/
/* unrelated styles */

#mContainer {
	position:relative;
	width:600px;
	margin:auto;
	padding:5px;
	border-top:2px solid #000;
	border-bottom:2px solid #000;
	font:0.7em verdana,arial;
}

h1,h2 {
	margin:0;
	padding:4px;
	font:bold 1.5em verdana;
	border-bottom:1px solid #000;
}

code {
	font-size:1.2em;
	color:#069;
}

#credits {
	position:relative;
	margin:25px auto 0px auto;
	width:350px; 
	font:0.7em verdana;
	border-top:1px solid #000;
	border-bottom:1px solid #000;
	height:90px;
	padding-top:4px;
}

#credits img {
	float:left;
	margin:5px 10px 5px 0px;
	border:1px solid #000000;
	width:80px;
	height:79px;
}

.important {
	background-color:#F5FCC8;
	padding:2px;
}

code span {
	color:green;
}
</style>
<script>

var ALERT_TITLE = "Message!";
var ALERT_BUTTON_TEXT = "Ok";

if(document.getElementById) {
	window.alert = function(txt) {
		createCustomAlert(txt);
	}
}

function createCustomAlert(txt) {
	d = document;

	if(d.getElementById("modalContainer")) return;

	mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
	mObj.id = "modalContainer";
	mObj.style.height = d.documentElement.scrollHeight + "px";
	
	alertObj = mObj.appendChild(d.createElement("div"));
	alertObj.id = "alertBox";
	if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
	alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
	alertObj.style.visiblity="visible";

	h1 = alertObj.appendChild(d.createElement("h1"));
	h1.appendChild(d.createTextNode(ALERT_TITLE));

	msg = alertObj.appendChild(d.createElement("p"));
	//msg.appendChild(d.createTextNode(txt));
	msg.innerHTML = txt;

	btn = alertObj.appendChild(d.createElement("a"));
	btn.id = "closeBtn";
	btn.class= 'add';
	btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
	btn.href = "#";
	btn.focus();
	btn.onclick = function() { removeCustomAlert();return false; }

	alertObj.style.display = "block";
	
}

function removeCustomAlert() {
	document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
}
function ful(){
alert('Alert this pages');
}

$(document).ready(function(){
            $("#datepicker").datepicker();
        });
    $('.select2').select2();
</script>
<script>
function removefromcartrepurchase(query)
{
    //alert(query);
    $.ajax({
   url:"<?php echo base_url().$module_name; ?>/Cart/removeItemOfCart",
   method:"POST",
   data:{query:query},
   success:function(response){
       //$('#result').html(response);
       window.location=response;
   }
  })
}
function updatecart(query,qty)
{
   //alert(query+'--'+qty);
   $.ajax({
   url:"<?php echo base_url().$module_name; ?>/Cart/updateItemOfCart",
   method:"POST",
   data:{query:query,qty:qty},
   success:function(response){
       //$('#finalResult').html(response);
        window.location=response;
   }
  })
}
function addcartvalueproducts(product_id)
{
   //alert(query+'--'+qty);
   var qty=$("#quantity"+product_id).val();
   $.ajax({
   url:"<?php echo base_url().$module_name; ?>/Cart/addToCartRepurchaseDiscount/"+product_id+"/eshop/"+qty,
   method:"POST",
   data:{query:product_id,qty:qty},
   success:function(response){
       var jsonObject = JSON.parse(response);
       $('.totalproducts').html(jsonObject.total);
       alert("Product added successfully");
       //createCustomAlert("Product added successfully.");
        //window.location=response;
   }
  })
}
function proceedtopay()
{
    //var payment_mode= $("input[name='payment_mode']:checked"). val();
    window.location.href='<?php echo site_url().$module_name."/Eshop/ewalletPaymentConfirm";?>';
}
function proceedtopaytopup()
{
    //var payment_mode= $("input[name='payment_mode']:checked"). val();
    window.location.href='<?php echo site_url().$module_name."/Eshop/ewalletPaymentConfirmTopup";?>';
}
function proceedtopay1()
{
    var payment_mode= $("input[name='payment_mode']:checked"). val();
    var center_leader=$("#center_leader").val();
    // check center leader is mandatory
    
    if(payment_mode=='ewallet')
    {
    window.location.href='<?php echo site_url().$module_name."/Eshop/ewalletPayment/";?>';
    }
    if(payment_mode=='paytm')
    {
    window.location.href='<?php echo site_url().$module_name."/Eshop/paytmPayment/";?>';
    }
}
function showStockist(state_id)
    {
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Admin/Eshop/showStockistStateWise/'+state_id,
           data: {state_id:state_id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               //alert(res);
            var jsonObject = JSON.parse(res);
            $('.totalproducts').html(jsonObject.total);
            $("#showstockistdetails").html(jsonObject.name+'<br>'+jsonObject.email+'<br>'+jsonObject.contact_no);
            $('.showproducts').show();
            
           },//end success
          complete: function () {
       
            } 
      });//end ajax
    }
$(function() {
            $("#datepicker").datepicker({
                onSelect: function(dateText) {
                    alert('Selected date: ' + dateText);
                }
            });
            $("#datepicker1").datepicker({
                onSelect: function(dateText) {
                    //alert('Selected date: ' + dateText);
                    if($("#datepicker").val()=='')
                    {
                        alert('Please select from date also');
                    }
                }
            });
        });
    function updatetax(type,id)
{
    var stockist_id='<?php echo $stockist_id;?>';
    var tax_stockist=$("#tax_stockist_"+id).val();
    jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>Admin/Stockist/setAjaxStockistTax',
				  data:{'tax_stockist':tax_stockist,'stockist_id':stockist_id,'type':type,'id':id},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
				  success:function(d){
				      //alert(d);
				      var res = JSON.parse(d);
				      alert(res.msg);
				      $("#tax_stockist"+id).val(tax_stockist);
				      
                  },//end success
                  complete: function () 
                  {
                     //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                  }
             });//end ajax
}
function updateqty(type,id)
{
    //var qty=$("#qty_"+id).val();
    //var assign_web=$("#assign_web_"+id).val();
    var assign_stockist=$("#assign_stockist_"+id).val();
    var remove_stockist=$("#remove_stockist_"+id).val();
    var assign_stockist_old=$("#assign_stockist_old_"+id).val();
    var stockist_id='<?php echo $stockist_id;?>';
    //alert(assign_stockist+'---'+assign_stockist_old+'--'+stockist_id+'--'+id); return false;
	    jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>Admin/Stockist/setAjaxStockistAll',
				  data:{'remove_stockist':remove_stockist,'assign_stockist':assign_stockist,'assign_stockist_old':assign_stockist_old,'stockist_id':stockist_id,'type':type,'id':id},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
				  success:function(d){
				      //alert(d);
				     var res = JSON.parse(d);
				      
				      if(res.status=='success')
				      {
				          //alert(res.assign_stockist+'--'+res.assign_stockist_old);
				          //$("#qty_"+id).val(res.qty);
				          if(res.type=='remove_stockist_')
				          {
				              $("#remove_stockist_"+id).val(res.remove_stockist);
                              $("#assign_stockist_old_"+id).val(res.assign_stockist_old);
                              $("#showstockistqty_"+id).html(res.assign_stockist_old);
				          }
				          else
				          {
				              $("#assign_stockist_"+id).val(res.assign_stockist);
                            $("#assign_stockist_old_"+id).val(res.assign_stockist_old);
                            $("#showstockistqty_"+id).html(res.assign_stockist_old);
				          }
                          
				      }
				      else
				      {
				          //$("#qty_"+id).val(qty);
				          if(res.type=='remove_stockist_')
				          {
				              $("#remove_stockist_"+id).val(remove_stockist);
				          }
				          else
				          {
                            $("#assign_stockist_"+id).val(assign_stockist);
				          }
				      }
				      alert(res.msg);
                  },//end success
                  complete: function () 
                  {
                     //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                  }
             });//end ajax
}
</script>
<!--<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>-->
<script>
//   ClassicEditor
//     .create(document.querySelector('#description'))
//     .catch(error => {
//         console.error(error);
//     });
//     ClassicEditor
//     .create(document.querySelector('#description1'))
//     .catch(error => {
//         console.error(error);
//     });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.1/tinymce.min.js"></script>



<script>
//   tinymce.init({
//     selector: '#description',
//     plugins: 'advlist autolink lists link image charmap print preview anchor code',
//     toolbar: 'undo redo | formatselect | ' +
//       'bold italic underline strikethrough | alignleft aligncenter ' +
//       'alignright alignjustify | bullist numlist outdent indent | ' +
//       'removeformat | forecolor backcolor | code', // ✅ "Code" button add kiya
//     height: 300,
//     // ✅ <p> tag ki jagah <div> use karega
//     content_style: "p {display: inline;}",  
//     forced_root_block: "div",  
//     force_br_newlines: true,
//     force_p_newlines: false
//   });
</script>

<script>
  tinymce.init({
    selector: '#description,#description1,#description2',
    plugins: 'powerpaste advlist autolink lists link image charmap print preview anchor code',
    toolbar: 'undo redo | formatselect | ' +
      'bold italic underline strikethrough | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | forecolor backcolor | code',
    height: 300,

    paste_as_text: false,  // Word formatting ko preserve karega
    paste_enable_default_filters: false,

  });
</script>


</script>

<script>
$(document).ready(function(){

   $("#parent_category_id").change(function(){
	  var parent_category_id=$(this).val();
	  var service_status=$("#service_status").val();
	  jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>Admin/Eshop/getAjaxSubCategory',
				  data:{'parent_category_id':parent_category_id,'service_status':service_status},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  
				  success:function(res){
					
					var option='<option value="">-Select Sub Category-</option>';  
					
					$("#sub_category_id").children().remove();					 
					 $(res).each(function(key,obj){
						  
						  option +='<option value="'+obj.id+'">'+obj.subcategory_name+'</option>';
					  })
					$("#sub_category_id").append(option);  
                  },//end success
                  complete: function () {
                       //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax
   });//end change	
   $("#sub_category_id").change(function(){
	  var parent_category_id=$('#parent_category_id').val();
	  var category_id=$(this).val();
	  var service_status=$("#service_status").val();
	  jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>Admin/Eshop/getAjaxSub2Category',
				  data:{'parent_category_id':parent_category_id,'category_id':category_id,'service_status':service_status},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  
				  success:function(res){
					
					var option='<option value="">-Select Sub Category-</option>';  
					
					$("#2category_id").children().remove();					 
					 $(res).each(function(key,obj){
						  
						  option +='<option value="'+obj.id+'">'+obj.subcategory_name+'</option>';
					  })
					$("#2category_id").append(option);  
                  },//end success
                  complete: function () {
                       //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax
   });
   $("#service_category_id").change(function(){
	  var parent_category_id=$(this).val();
	  jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>Admin/ServiceProduct/getAjaxSubCategory',
				  data:{'parent_category_id':parent_category_id},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  
				  success:function(res){
					
					var option='<option value="">-Select Sub Category-</option>';  
					
					$("#service_sub_category_id").children().remove();					 
					 $(res).each(function(key,obj){
						  
						  option +='<option value="'+obj.id+'">'+obj.subcategory_name+'</option>';
					  })
					$("#service_sub_category_id").append(option);  
                  },//end success
                  complete: function () {
                       //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax
   });//end change	
   $("#service_sub_category_id").change(function(){
	  var parent_category_id=$(this).val();
	  jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>Admin/ServiceProduct/getAjaxSub2Category',
				  data:{'parent_category_id':parent_category_id},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  
				  success:function(res){
					
					var option='<option value="">-Select Sub Category-</option>';  
					
					$("#subcat_id").children().remove();					 
					 $(res).each(function(key,obj){
						  
						  option +='<option value="'+obj.id+'">'+obj.subcategory_name+'</option>';
					  })
					$("#subcat_id").append(option);  
                  },//end success
                  complete: function () {
                       //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax
   });//end change	
});//end ready
   $(document).ready(function(){
   	<?php 
	if(!empty($sub_images) && count($sub_images))
	{
	?>
	var i='<?php echo count($sub_images);?>';
	<?php 
	}
	else 
	{
	?>
	var i=0;
	<?php 
	}
	?>
   	$("#add_more_image").click(function(){
   		i++;
   		var img='<div class="form-group" id="product_'+i+'">';
               img +='<label class="col-lg-3 control-label">Product Sub Image:</label>';
               img +='<div class="col-lg-9">';
               img +='<input name="sub_img[]" type="file" class="file-input1">';
   			img +='<span><a onclick="return remove_sub_image('+i+')" href="#">Remove</a></span>';
               img +='</div>';
   			img +='</div>';
   		
   		$("#more_images").append(img);		
   		set_type();
   		return false;
   	});
   	$(".remove_old_image").click(function(){
		var img_name=$(this).attr('img_name');
		//alert(img_name);
		$("input#"+img_name).remove();
		return false;
			
	});
   });//end ready
   function remove_sub_image(ob)
   {
   	var obj="product_"+ob;
   	$("#"+obj).remove();
   	return false;
   }
   function set_type()
   {
   	////////////////
   // Basic example
       $('.file-input1').fileinput({
           browseLabel: '',
           browseClass: 'btn btn-primary btn-icon',
           removeLabel: '',
           uploadLabel: '',
           uploadClass: 'btn btn-default btn-icon',
           browseIcon: '<i class="icon-plus22"></i> ',
           uploadIcon: '<i class="icon-file-upload"></i> ',
           removeClass: 'btn btn-danger btn-icon',
           removeIcon: '<i class="icon-cancel-square"></i> ',
           layoutTemplates: {
               caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
           },
           initialCaption: "No file selected"
       });
   
   
       // With preview
       $(".file-input-preview").fileinput({
           browseLabel: '',
           browseClass: 'btn btn-primary btn-icon',
           removeLabel: '',
           uploadLabel: '',
           uploadClass: 'btn btn-default btn-icon',
           browseIcon: '<i class="icon-plus22"></i> ',
           uploadIcon: '<i class="icon-file-upload"></i> ',
           removeClass: 'btn btn-danger btn-icon',
           removeIcon: '<i class="icon-cancel-square"></i> ',
           layoutTemplates: {
               caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
           },
           initialPreview: [
               "<img src='assets/images/placeholder.jpg' class='file-preview-image' alt=''>",
               "<img src='assets/images/placeholder.jpg' class='file-preview-image' alt=''>",
           ],
           overwriteInitial: false,
           maxFileSize: 100
       });
   
   
       // Display preview on load
       $(".file-input-overwrite").fileinput({
           browseLabel: '',
           browseClass: 'btn btn-primary btn-icon',
           removeLabel: '',
           uploadLabel: '',
           uploadClass: 'btn btn-default btn-icon',
           browseIcon: '<i class="icon-plus22"></i> ',
           uploadIcon: '<i class="icon-file-upload"></i> ',
           removeClass: 'btn btn-danger btn-icon',
           removeIcon: '<i class="icon-cancel-square"></i> ',
           layoutTemplates: {
               caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
           },
           initialPreview: [
               "<img src='assets/images/placeholder.jpg' class='file-preview-image' alt=''>",
               "<img src='assets/images/placeholder.jpg' class='file-preview-image' alt=''>",
           ],
           overwriteInitial: true
       });
   
   
       // Custom layout
       $('.file-input-custom').fileinput({
           previewFileType: 'image',
           browseLabel: 'Select',
           browseClass: 'btn bg-slate-700',
           browseIcon: '<i class="icon-image2 position-left"></i> ',
           removeLabel: 'Remove',
           removeClass: 'btn btn-danger',
           removeIcon: '<i class="icon-cancel-square position-left"></i> ',
           uploadClass: 'btn bg-teal-400',
           uploadIcon: '<i class="icon-file-upload position-left"></i> ',
           layoutTemplates: {
               caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
           },
           initialCaption: "No file selected"
       });
   
   
       // Advanced example
       $('.file-input-advanced').fileinput({
           browseLabel: 'Browse',
           browseClass: 'btn btn-default',
           removeLabel: '',
           uploadLabel: '',
           browseIcon: '<i class="icon-plus22 position-left"></i> ',
           uploadClass: 'btn btn-primary btn-icon',
           uploadIcon: '<i class="icon-file-upload"></i> ',
           removeClass: 'btn btn-danger btn-icon',
           removeIcon: '<i class="icon-cancel-square"></i> ',
           initialCaption: "No file selected",
           layoutTemplates: {
               caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>',
               main1: "{preview}\n" +
               "<div class='input-group {class}'>\n" +
               "   <div class='input-group-btn'>\n" +
               "       {browse}\n" +
               "   </div>\n" +
               "   {caption}\n" +
               "   <div class='input-group-btn'>\n" +
               "       {upload}\n" +
               "       {remove}\n" +
               "   </div>\n" +
               "</div>"
           }
       });
   
   
       // Disable/enable button
       $("#btn-modify").on("click", function() {
           $btn = $(this);
           if ($btn.text() == "Disable file input") {
               $("#file-input-methods").fileinput("disable");
               $btn.html("Enable file input");
               alert("Hurray! I have disabled the input and hidden the upload button.");
           }
           else {
               $("#file-input-methods").fileinput("enable");
               $btn.html("Disable file input");
               alert("Hurray! I have reverted back the input to enabled with the upload button.");
           }
       });
   
   
       // Custom file extensions
       $(".file-input-extensions").fileinput({
           browseLabel: 'Browse',
           browseClass: 'btn btn-primary',
           removeLabel: '',
           browseIcon: '<i class="icon-plus22 position-left"></i> ',
           uploadIcon: '<i class="icon-file-upload position-left"></i> ',
           removeClass: 'btn btn-danger btn-icon',
           removeIcon: '<i class="icon-cancel-square"></i> ',
           layoutTemplates: {
               caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
           },
           initialCaption: "No file selected",
           maxFilesNum: 10,
           allowedFileExtensions: ["jpg", "gif", "png", "txt"]
       });	
   	
   	//////////////////
   }
</script>
<style>
   button.btn.btn-default.btn-icon.kv-fileinput-upload{
   display: none;
   }
   .file-preview-old {
   /*border-radius: 2px;
   border: 1px solid #ddd;*/
   width: 100%;
   margin-bottom: 20px;
   position: relative;
   }
</style>
<script>
   $(document).ready(function(){
   	$(".file-caption-name").text("No Profile Pic Selected");
   });//end ready
</script>
<script>
   <?php 
   if(!empty($all_level_commission) && count($all_level_commission)>0)
   {
   ?>
   var level='<?php echo count($all_level_commission);?>';
   <?php    
   }
   else 
   {
   ?>
   var level='1';
   <?php    
   }
   ?>
   function remove_level(levels)
   {
     $("#level_"+levels).remove();
     /////////////////
     level=1; 
     $('.level_label').each(function(){
       level++;
       $(this).html("level"+level+":");
     });
     ////////////////
     level=1;
     $(".level_group").each(function(){
       level++;
       $(this).attr('id',"level_"+level);
     });
     //////////////////
     level=1;
     $(".level_input").each(function(){
        level++;
        $(this).attr("placeholder","Level "+level+" Commission");
     });
     ////////////////////
     level=1;
     $(".remove_level_click").each(function(){
      level++;
      $(this).attr('onclick',"return remove_level("+level+")");
     });
     return false;
   }
   $(document).ready(function(){
      /////////Level type code start from here/////////////////////
      $("input[class=level_type]").click(function(){
         var level_type=$(this).val();
         //level_type==0=>unlimited, level_type==1=>limited 
         if(level_type==0)
         {
            var unlimited_level_div='<div class="form-group">';
            unlimited_level_div +='<label class="col-lg-3 control-label">Commission:</label>';
            unlimited_level_div +='<div class="col-lg-9">';
            unlimited_level_div +='<input required type="text" name="commission" id="commission" class="form-control" placeholder="Commission">';
            unlimited_level_div +='</div>';
            unlimited_level_div +='</div>';
            $("#unlimited_level_div").html(unlimited_level_div);
            $("#add_more_group").css('display','none');
            $("#limited_level_div").children().remove();
            level=1;
         }
         else 
         {
            var limited_level_div='<div class="form-group">';
            limited_level_div +='<label class="col-lg-3 control-label">Level1:</label>';
            limited_level_div +='<div class="col-lg-9">';
            limited_level_div +='<input required type="text" name="level_commission[]" class="form-control" placeholder="Level 1 Commission">';
            limited_level_div +='</div>';
            limited_level_div +='</div>';
            $("#limited_level_div").html(limited_level_div);
            $("#add_more_group").css('display','');
            $("#unlimited_level_div").children().remove();
         }
      })//end of level type click 
      
      $("#add_more_level").click(function(){
            level++;
            var limited_level_div='<div class="form-group level_group" id="level_'+level+'">';
            limited_level_div +='<label class="col-lg-3 control-label level_label">Level '+level+':</label>';
            limited_level_div +='<div class="col-lg-9">';
            limited_level_div +='<input required type="text" name="level_commission[]" class="form-control level_input" placeholder="Level '+level+' Commission">';
            limited_level_div +='<a href="#" class="remove_level_click" onclick="return remove_level('+level+')">Remove</a></div>';
            limited_level_div +='</div>';
            $("#limited_level_div").append(limited_level_div);
            return false;
      });//end add more level click here
      /////////////////////////////////////////////////////////////
   });//end ready
</script>

<script>
   $(document).ready(function(){
   	$(".view_order_details").click(function(){
		var order_id=$(this).attr('order_id');
		jQuery.ajax({
                  type:'post',
                  url:'<?php echo site_url();?>Admin/Eshop_orders/getOrderDetails/',
				  data:{'order_id':order_id},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
                      //alert(res)
					  $("#preview_info_body").html(res);
					  $("#view_order_details_modal").modal('show');
                  },//end success
                  complete: function () {
                       //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax	
		
		
		
   	}) ;
   	$(".view_return_details").click(function(){
		var order_id=$(this).attr('order_id');
		jQuery.ajax({
                  type:'post',
                  url:'<?php echo site_url();?>Admin/Eshop_orders/getReturnDetails/',
				  data:{'order_id':order_id},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
                      //alert(res)
					  $("#preview_info_body").html(res);
					  $("#view_order_details_modal").modal('show');
                  },//end success
                  complete: function () {
                       //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax	
		
		
		
   	});
	/////////////////////////
	$(".change_status").change(function(){
		
		if(window.confirm('Are you Sure? you want to change the product status.'))
		{
			var order_id=$(this).attr('order_id');
		    var order_status=$(this).val();
			var url='allOrders';
			window.location.href='<?php echo site_url();?>Admin/Eshop_orders/change_status/'+order_id+"/"+order_status+"/"+url;
		}
	});
	$(".change_status1234").change(function(){
		
		if(window.confirm('Are you Sure? you want to change the product status.'))
		{
			var order_id=$(this).attr('order_id');
		    var order_status=$(this).val();
			var url='allOrders';
			jQuery.ajax({
                  type:'post',
                  url:'<?php echo site_url();?>Admin/Eshop_orders/checkStock/',
				  data:{'order_id':order_id},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
                      //console.log(res)
                      res=res.replace(/\s/g, "");
                       //console.log(res)
                      if(res=='success')
                      {
                          //alert(res);
                          window.location.href='<?php echo site_url();?>Admin/Eshop_orders/change_status/'+order_id+"/"+order_status+"/"+url;
                      }
                      else
                      {
                          alert('Product not in stock. Please check stock before confirm order.');
                      }
					  //$("#preview_info_body").html(res);
					  //$("#view_order_details_modal").modal('show');
                  },//end success
                  complete: function () {
                       //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax
			//window.location.href='<?php echo site_url();?>Admin/Eshop_orders/change_status/'+order_id+"/"+order_status+"/"+url;
		}
		else 
		{
			return false;
		}
	});	
	/////////////////////////
   });

</script>					
<script>
   function print_invoice()
   {
   var printpage = window.open('','','width=1000,height=400');
   printpage.document.open("text/html");
   printpage.document.write(document.getElementById('preview-info-body1').innerHTML);
   printpage.document.close();
   printpage.print();
   printpage.close();
   }
</script>
<script>
   //code for add fund
   $(document).ready(function(){
         $("#usernamewallet").change(function(){
            var username=$(this).val();
            $.ajax({
                  url: "<?php echo ci_site_url();?>Admin/UserWallet/getUserEwalletBalance/"+username,
                  method: "GET",
                  success:function(res){
                         if(res.user=='1')
                         {
                           $("#available_amount").val(res.balance);
                         }
                         else 
                         {
                           $(".valid_username").text('Sorry username does not exists');
                           $("#available_amount").val(0);
                         }
   
                  }
            });
         }); //end change
         $("#amount").bind('keyup change blur',function(){
            var amount=$(this).val();
            var username=$("#usernamewallet").val();
            var admin_wallet_amount=parseInt($("#current_admin_wallet_amount").val());
            if(username=="<?php echo 'i3empire';?>" || username=="<?php echo COMP_USER_ID;?>" )
            {
              if(!isNaN(amount) && amount!='')
              {
               admin_wallet_amount=parseInt(amount)+admin_wallet_amount;
               $("#admin_wallet_amount").val(admin_wallet_amount);
              }
              else if(amount=='')
              {
               $("#admin_wallet_amount").val(admin_wallet_amount);
              }
            }
            else 
            {
              if(!isNaN(amount) && amount!='')
              {
               admin_wallet_amount=admin_wallet_amount-parseInt(amount);
               $("#admin_wallet_amount").val(admin_wallet_amount);
              }
              else if(amount=='')
              {
               $("#admin_wallet_amount").val(admin_wallet_amount);
              }
           }
         }) 
   ///////////////////////////////
        $("#usernamewallet").change(function(){
          if($(this).val().length>0)
          {
            $(".valid_username").text('');
          }
        });
        $("#amount").keyup(function(){
          if($(this).val().length>0 && $(this).val()>0)
          {
            $(".valid_amount").text('');
          }
        });
        $("#transaction_password").keyup(function(){
          if($(this).val().length>0 && $(this).val()>0)
          {
            $(".valid_transaction_password").text('');
          }
        });
   
   /////////////////////////
        $("#addFundBtn").click(function(){
         if($("#usernamewallet").val()=="")
         {
           $(".valid_username").text('Please select username');
           return false;
         }
         if($("#amount").val()==0)
         {
           $(".valid_amount").text('Please enter amount');
           return false;
         }
         if($("#transaction_password").val()=="")
         {
           $(".valid_transaction_password").text('Please enter transaction password');
           return false;
         }
         if($("#transaction_password").val()!='<?php echo $transaction_password;?>')
         {
           $(".valid_transaction_password").text('Please enter valid transaction password');
           return false;
         }
        });//end btn click here
   });//end ready
   
   /////////////////////////////////
   
   $(document).ready(function(){
         $("#d_username").change(function(){
            var username=$(this).val();
            $.ajax({
                  url: "<?php echo ci_site_url();?>Admin/UserWallet/getUserEwalletBalance/"+username,
                  method: "GET",
                  success:function(res){
                         if(res.user=='1')
                         {
                           $("#d_available_amount").val(res.balance);
                           $("#d_current_user_wallet_amount").val(res.balance);
                         }
                         else 
                         {
                           $(".d_valid_username").text('Sorry username does not exists');
                           $("#d_available_amount").val(0);
                         }
   
                  }
            });
         }); //end change
         $("#d_amount").bind('keyup change blur',function(){
            var amount=$(this).val();
            var username=$("#d_username").val();
            var admin_wallet_amount=parseInt($("#d_current_admin_wallet_amount").val());
            var user_wallet_amount=parseInt($("#d_current_user_wallet_amount").val());
            
            /////////////
            if(!isNaN(amount) && amount!='')
             {
               admin_wallet_amount=parseInt(amount)+admin_wallet_amount;
               $("#d_admin_wallet_amount").val(admin_wallet_amount);
             }
             else if(amount=='')
             {
               $("#d_admin_wallet_amount").val(admin_wallet_amount);
             }
             //////////////
             if(!isNaN(amount) && amount!='')
             {
               user_wallet_amount=user_wallet_amount-parseInt(amount);
               $("#d_available_amount").val(user_wallet_amount);
             }
             else if(amount=='')
             {
               $("#d_available_amount").val(user_wallet_amount);
             }
         }) 
   ///////////////////////////////
        $("#d_username").change(function(){
          if($(this).val().length>0)
          {
            $(".d_valid_username").text('');
          }
        });
        $("#d_amount").keyup(function(){
          if($(this).val().length>0 && $(this).val()>0)
          {
            $(".d_valid_amount").text('');
          }
        });
        $("#d_transaction_password").keyup(function(){
          if($(this).val().length>0 && $(this).val()>0)
          {
            $(".d_valid_transaction_password").text('');
          }
        });
       /////////////////////////
        $("#deductFundBtn").click(function(){
         if($("#d_username").val()=="")
         {
           $(".d_valid_username").text('Please select username');
           return false;
         }
         if($("#d_amount").val()==0)
         {
           $(".d_valid_amount").text('Please enter amount');
           return false;
         }
         if($("#d_transaction_password").val()=="")
         {
           $(".d_valid_transaction_password").text('Please enter transaction password');
           return false;
         }
         if($("#d_transaction_password").val()!='<?php echo $transaction_password;?>')
         {
           $(".d_valid_transaction_password").text('Please enter valid transaction password');
           return false;
         }
        });//end btn click here
   
   });//end ready
</script>
<script>
$(document).ready(function() {
    $('#active_members').DataTable( {
		"destroy":true,
        "processing": true,
        "serverSide": true,
        "ajax":"<?php echo ci_site_url();?>Admin/member/active_member_list_ajax",
         "columnDefs"      : [{ 'className': 'control', 'orderable': false, 'targets':[]}, 
                    {'orderable': false, 'targets': [] }, 
                    {"targets": [ ],"visible": false,"searchable": false}
                ]
    } );
} );
</script>
<script>
$(document).ready(function(){
	$("#passwordbtn").click(function(){
		
		var password=$("#password").val();
		var cpass=$("#c_pass").val();
		if(password!=cpass)
		{
			$("#valid_cpass").text("Sorry confirm password does not match");
			return false;
		}
		return true;
	});//end btn click
	$("#c_pass").keyup(function(){
		
		var password=$("#password").val();
		var cpass=$(this).val();
		if(password==cpass)
		{
			$("#valid_cpass").text('');
		}
	})
});
</script>	