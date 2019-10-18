<?php $__env->startSection('header'); ?>
<br><br>
<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50" >
					<div class="m-l-25 m-r--38 m-lr-0-xl" >
						<div class="wrap-table-shopping-cart" >
							<table class="table-shopping-cart" >
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4" style="position:relative;right:25px;" >Delete</th>
									 
								</tr>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($x->product_id == $item->id): ?>
    

                            <tr class="table_row" pro_id=<?php echo e($item->id); ?> price="<?php echo e($item->price); ?>">
									<td class="column-1">
										<div class="how-itemcart1">
                                        <img src="<?php echo e(asset('uploads')); ?>/<?php echo e($item->img); ?>" alt="IMG">
										</div>
									</td>
                                <td class="column-2"><?php echo e($item->name); ?></td>
                                <td class="column-3">EGP <?php echo e($item->price); ?></td>
                                <td class="column-4" style="position:relative;right:25px;"><button type="button" class="btn btn-danger tr_cart" > Delete</button></td>
								</tr>
                                <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								
							</table>
						</div>

					
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									
									<div class="alert  alert-danger alert-dismissible fade show alert" role="alert" style="display:none">
										 
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
										<div class="bor8 bg0 m-b-22">
												<input class="stext-111 cl8 plh3 size-111 p-lr-15 address" type="text" id="address" placeholder="Your Address" required>
											</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15 state" type="text" id="state" placeholder="Credit Card Number" required>
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15 postcode" type="password" id="postcode" placeholder="Password" required>
									</div>
									
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total: EGP
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2 total">
									 <?php echo e($total_price); ?>

								</span>
							</div>
						</div>

						<button type="button" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer proceed">
							Proceed to Checkout
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>

<?php echo $__env->make('FrontView.inc.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('FrontView.inc.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>