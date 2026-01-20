<style>
    .compare-table .table tbody tr td.product-image-title {
    min-width: 310px;
    vertical-align: top;
}
.compare-table .table tbody tr td {
    text-align: left;
    vertical-align: top;
}
.description-container {
    position: relative;
    max-height: 120px; /* collapsed height */
    overflow: hidden;
    transition: max-height 0.4s ease-in-out;
  }

  /* Fading overlay effect */
  .fade-effect {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background: linear-gradient(to bottom, rgba(255,255,255,0), #fff);
    pointer-events: none;
    transition: opacity 0.3s ease-in-out;
  }

  /* Read More / Less button */
  .read-more-btn {
    color: #2874f0;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin-top: 8px;
  }

  .read-more-btn:hover {
    text-decoration: underline;
  }

  .desc-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    padding: 20px;
    margin-bottom: 20px;
  }
</style>
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="<?php echo base_url();?>">Home</a></li>
								<li><a href="#" class="active"><?php echo $products->title?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- entry-header-area-start -->
		<div class="entry-header-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="entry-header-title">
							<h2><?php echo $products->title?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- compare main wrapper start -->
        <div class="compare-page-wrapper mb-70">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Compare Page Content Start -->
                            <div class="compare-page-content-wrap">
                                <div class="compare-table table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="first-column">Product</td>
                                                <td class="product-image-title">
                                                    <a href="#" class="image">
                                                        <img class="img-fluid" src="<?php echo base_url();?>product_images/<?php echo $products->basic_image;?>" alt="Compare Product">
                                                    </a>
                                                    <a href="#" class="title"><?php echo $products->title?>(Basic)</a>
                                                </td>
                                                
                                                <td class="product-image-title">
                                                    <a href="#" class="image">
                                                        <img class="img-fluid" src="<?php echo base_url();?>product_images/<?php echo $products->enterprise_image;?>" alt="Compare Product">
                                                    </a>
                                                    <a href="#" class="title"><?php echo $products->title?>(Pro)</a>
                                                </td>
                                                <td class="product-image-title">
                                                    <a href="#" class="image">
                                                        <img class="img-fluid" src="<?php echo base_url();?>product_images/<?php echo $products->economy_image;?>" alt="Compare Product">
                                                    </a>
                                                    <a href="#" class="title"><?php echo $products->title?>(Enterprise)</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Description</td>
                                                <td class="pro-desc">
                                                    <div class="description-container">
                                                    <p><?php echo $products->description; ?></p>
                                                    <div class="fade-effect"></div>
                                                    </div>
                                                    <a class="read-more-btn">Read More</a>
                                                </td>
                                                <td class="pro-desc">
                                                    <div class="description-container">
                                                    <p><?php echo $products->description2; ?></p>
                                                    <div class="fade-effect"></div>
                                                    </div>
                                                    <a class="read-more-btn">Read More</a>
                                                </td>
                                                <td class="pro-desc">
                                                    <div class="description-container">
                                                        <p><?php echo $products->long_description; ?></p>
                                                        <div class="fade-effect"></div>
                                                    </div>
                                                    <a class="read-more-btn">Read More</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Price</td>
                                                <td class="pro-price">$<?php echo $products->price1;?></td>
                                                <td class="pro-price">$<?php echo $products->price2;?></td>
                                                <td class="pro-price">$<?php echo $products->price3;?></td>
                                            </tr>
                                            <!--<tr>
                                                <td class="first-column">Color</td>
                                                <td class="pro-color">Black</td>
                                                <td class="pro-color">Red</td>
                                                <td class="pro-color">Blue</td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Stock</td>
                                                <td class="pro-stock">In Stock</td>
                                                <td class="pro-stock">Stock Out</td>
                                                <td class="pro-stock">In Stock</td>
                                            </tr>-->
                                            <tr>
                                                <td class="first-column">Add to cart</td>
                                                <td><a href="#" onclick="addcartproductspackage(<?php echo $products->id;?>,'Basic')" class="btn btn-sqr">Add to Cart</a></td>
                                                <td><a href="#" onclick="addcartproductspackage(<?php echo $products->id;?>,'Economy')" class="btn btn-sqr">Add to Cart</a></td>
                                                <td><a href="#" onclick="addcartproductspackage(<?php echo $products->id;?>,'Enterprise')" class="btn btn-sqr">Add to Cart</a></td>
                                            </tr>
                                            <!--<tr>
                                                <td class="first-column">Rating</td>
                                                <td class="pro-ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </td>
                                                <td class="pro-ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </td>
                                                <td class="pro-ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Remove</td>
                                                <td class="pro-remove">
                                                    <button><i class="fa fa-trash-o"></i></button>
                                                </td>
                                                <td class="pro-remove">
                                                    <button><i class="fa fa-trash-o"></i></button>
                                                </td>
                                                <td class="pro-remove">
                                                    <button><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Compare Page Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- compare main wrapper end -->
        <script>
  // Attach toggle functionality for all "Read More" buttons
  document.querySelectorAll('.read-more-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const container = this.previousElementSibling;
      const fade = container.querySelector('.fade-effect');

      if (container.classList.contains('expanded')) {
        // Collapse
        container.style.maxHeight = '120px';
        fade.style.opacity = '1';
        this.textContent = 'Read More';
        container.classList.remove('expanded');
      } else {
        // Expand
        container.style.maxHeight = container.scrollHeight + 'px';
        fade.style.opacity = '0';
        this.textContent = 'Read Less';
        container.classList.add('expanded');
      }
    });
  });
</script>