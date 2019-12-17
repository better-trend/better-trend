<!DOCTYPE html>
<html>
<head>
	<?php if ($lang == "en") : ?>
		<title>Receipt Details</title>
	<?php else : ?>
		<title>تفاصيل الاستلام</title>
	<?php endif; ?>
</head>
<body>

	<?php if ($lang == "en") : ?>

		<table>
			<thead>
				<tr>
					<th colspan="2" class="text-center">
						<h2>Billing details</h2>
					</th>
				</tr>
			</thead>

			<?php if ($type == 1) : ?>
				<?php 
				$product = \App\ProductsNative::find($data['product_native_id']);
				?>
				<tr>
					<td>Date</td>
					<td><?= $data['created_at'] ?></td>
				</tr>
				<tr>
					<td>Transaction #</td>
					<td><?= $data['id'] ?></td>
				</tr>
				<tr>
					<td>First name</td>
					<td><?= $data['user_name'] ?></td>
				</tr>
				<tr>
					<td>Last name</td>
					<td><?= $data['user_last_name'] ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><?= $data['user_address'] ?></td>
				</tr>
				<tr>
					<td>Quantity</td>
					<td><?= $data['product_quantity'] ?></td>
				</tr>
				<tr>
					<td>Product Price</td>
					<td>SR <?= $data['product_price'] ?></td>
				</tr>
				<tr>
					<?php $discount = $data['product_price'] * $data['product_quantity'] - $data['total_price'] ?>
					<td>Discount</td>
					<td>SR <?= $discount ?></td>
				</tr>
				<tr>
					<td>Shipping fee</td>
					<td>SR <?= $product->shipping_fee ?></td>
				</tr>
				<tr>
					<td>Tax</td>
					<td>SR <?= $product->tax ?></td>
				</tr>
				<tr>
					<td>Total price</td>
					<td>SR <?= $data['total_price'] ?></td>
				</tr>
			<?php elseif($type == 2) : ?>
				<?php $school = \App\School::find($data['school_id']); ?>
				<?php $package = \App\SchoolPlan::where("name", "=", $data['package_name'])->get()->first();  ?>
				<?php if ($school) : ?>
				<tr>
					<td>School</td>
					<td><?= $school->school_name ?></td>
				</tr>
				<?php endif; ?>
				<tr>
					<td>Package</td>
					<td><?= $data['package_name'] ?></td>
				</tr>
				<tr>
					<td>Details</td>
					<td><?= $package->description ?></td>
				</tr>
				<tr>
					<td>Price</td>
					<td>SAR <?= $data['package_price'] ?></td>
				</tr>
				<tr>
					<td>Shipping Fee</td>
					<td>SAR <?= $package->shipping_fee ?></td>
				</tr>
				<tr>
					<td>Tax</td>
					<td>SAR <?= $package->tax ?></td>
				</tr>
				<tr>
					<td>Discount</td>
					<?php 
		                $priceBeforeDisc = ($data['package_price']) + $package->tax + $package->shipping_fee;
		            ?>
		            <td>SAR&nbsp;<?= $priceBeforeDisc - $data['package_price'] ?></td>
				</tr>
				<tr>
					<td>Start date</td>
					<td><?= $data['package_start_date'] ?></td>
				</tr>
				<tr>
					<td>End date</td>
					<td><?= $data['package_end_date'] ?></td>
				</tr>
			<?php else : ?>
				<?php 
		        $event = \App\Event::find($data['event_id']);
		        $coach = \App\User::find($data['coach_id']);
		        $user = \App\User::find(Auth::user()->id);
		         ?>
		         <tr>
					<td>User name</td>
					<td><?= $user->name ?> <?= $user->last_name ?></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><?= $event->name ?> (<?= $data['name'] ?>)</td>
				</tr>
				<?php if ($coach) : ?>
				<tr>
					<td>Coach</td>
					<td><?= $coach->name ?></td>
				</tr>
				<?php endif; ?>
				<tr>
					<td>Description</td>
					<td><?= $data['description'] ?></td>
				</tr>
				<tr>
					<td>Price</td>
					<td>SAR <?= $event->price ?></td>
				</tr>
				<tr>
					<td>Location</td>
					<td><?= $event->location ?></td>
				</tr>
				<tr>
					<td>Classification</td>
					<td><?= $event->classification ?></td>
				</tr>
				<tr>
					<td>Buy date</td>
					<td><?= $data['created_at'] ?></td>
				</tr>
			<?php endif; ?>
		</table>

		<?php else : ?>

		<table>
			<thead>
				<tr>
					<th colspan="2" class="text-center">
						<h2>تفاصيل الفاتورة</h2>
					</th>
				</tr>
			</thead>

			<?php if ($type == 1) : ?>
				<?php 
				$product = \App\ProductsNative::find($data['product_native_id']);
				?>
				<tr>
					<td>تاريخ</td>
					<td><?= $data['created_at'] ?></td>
				</tr>
				<tr>
					<td>عملية تجارية #</td>
					<td><?= $data['id'] ?></td>
				</tr>
				<tr>
					<td>الاسم الاول</td>
					<td><?= $data['user_name'] ?></td>
				</tr>
				<tr>
					<td>اسم العائلة</td>
					<td><?= $data['user_last_name'] ?></td>
				</tr>
				<tr>
					<td>عنوان</td>
					<td><?= $data['user_address'] ?></td>
				</tr>
				<tr>
					<td>كمية</td>
					<td><?= $data['product_quantity'] ?></td>
				</tr>
				<tr>
					<td>سعر المنتج</td>
					<td>SR <?= $data['product_price'] ?></td>
				</tr>
				<tr>
					<?php $discount = $data['product_price'] * $data['product_quantity'] - $data['total_price'] ?>
					<td>خصم</td>
					<td>SR <?= $discount ?></td>
				</tr>
				<tr>
					<td>رسوم الشحن</td>
					<td>SR <?= $product->shipping_fee ?></td>
				</tr>
				<tr>
					<td>ضريبة</td>
					<td>SR <?= $product->tax ?></td>
				</tr>
				<tr>
					<td>السعر الكلي</td>
					<td>SR <?= $data['total_price'] ?></td>
				</tr>
			<?php elseif($type == 2) : ?>
				<?php $school = \App\School::find($data['school_id']); ?>
				<?php $package = \App\SchoolPlan::where("name", "=", $order['package_name'])->get()->first();  ?>
				<?php if ($school) : ?>
				<tr>
					<td>مدرسة</td>
					<td><?= $school->school_name ?></td>
				</tr>
				<?php endif; ?>
				<tr>
					<td>رزمة</td>
					<td><?= $data['package_name'] ?></td>
				</tr>
				<tr>
					<td>تفاصيل</td>
					<td><?= $package->description ?></td>
				</tr>
				<tr>
					<td>السعر</td>
					<td>SAR <?= $data['package_price'] ?></td>
				</tr>
				<tr>
					<td>رسوم الشحن</td>
					<td>SAR <?= $package->shipping_fee ?></td>
				</tr>
				<tr>
					<td>ضريبة</td>
					<td>SAR <?= $package->tax ?></td>
				</tr>
				<tr>
					<td>خصم</td>
					<?php 
		                $priceBeforeDisc = ($datapackage_price) + $package->tax + $package->shipping_fee;
		            ?>
		            <td>SAR&nbsp;<?= $priceBeforeDisc - $data['package_price'] ?></td>
				</tr>
				<tr>
					<td>بداية</td>
					<td><?= $data['package_start_date'] ?></td>
				</tr>
				<tr>
					<td>النهاية</td>
					<td><?= $data['package_end_date'] ?></td>
				</tr>
			<?php else : ?>
				<?php 
		        $event = \App\Event::find($data['event_id']);
		        $coach = \App\User::find($data['coach_id']);
		        $user = \App\User::find(Auth::user()->id);
		         ?>
		        <tr>
					<td>User name</td>
					<td><?= $user->name ?> <?= $user->last_name ?></td>
				</tr>
				<tr>
					<td>اسم</td>
					<td><?= $event->name ?> (<?= $data['name'] ?>)</td>
				</tr>
				<?php if ($coach) : ?>
				<tr>
					<td>مدرب</td>
					<td><?= $coach->name ?></td>
				</tr>
				<?php endif; ?>
				<tr>
					<td>وصف</td>
					<td><?= $data['description'] ?></td>
				</tr>
				<tr>
					<td>السعر</td>
					<td>SAR <?= $event->price ?></td>
				</tr>
				<tr>
					<td>موقعك</td>
					<td><?= $event->location ?></td>
				</tr>
				<tr>
					<td>تصنيف</td>
					<td><?= $event->classification ?></td>
				</tr>
				<tr>
					<td>تاريخ الشراء</td>
					<td><?= $data['created_at'] ?></td>
				</tr>
			<?php endif; ?>
		</table>

		<?php endif; ?>
	
</body>
</html>