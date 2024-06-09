<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property string $title
 * @property string $main_title
 * @property string $description
 * @property string $video_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|About newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|About newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|About query()
 * @method static \Illuminate\Database\Eloquent\Builder|About whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereMainTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereVideoLink($value)
 */
	class About extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $delivery_area_id
 * @property string $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DeliveryArea $delivery_area
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereDeliveryAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUserId($value)
 */
	class Address extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_category_id
 * @property string $image
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BlogCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlogComment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereBlogCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUserId($value)
 */
	class Blog extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Blog> $blog
 * @property-read int|null $blog_count
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereUpdatedAt($value)
 */
	class BlogCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $blog_id
 * @property int $user_id
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blog $blog
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereUserId($value)
 */
	class BlogComment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slub
 * @property int $status
 * @property int $show_at_home
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereShowAtHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $phone_one
 * @property string|null $phone_two
 * @property string|null $mail_one
 * @property string|null $mail_two
 * @property string|null $address
 * @property string|null $map_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMailOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMailTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMapLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhoneOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhoneTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $quantity
 * @property int $min_purchase_amount
 * @property string $expire_date
 * @property string $discount_type
 * @property float $discount
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CouponFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMinPurchaseAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $area_name
 * @property string $min_delivery_time
 * @property string $max_delivery_time
 * @property float $delivery_fee
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $userAddress
 * @property-read int|null $user_address_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea whereAreaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea whereDeliveryFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea whereMaxDeliveryTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea whereMinDeliveryTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryArea whereUpdatedAt($value)
 */
	class DeliveryArea extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $invoice_id
 * @property int $user_id
 * @property string $address
 * @property float $discount
 * @property float $delivery_charge
 * @property float $subtotal
 * @property float $grand_total
 * @property int $product_qty
 * @property string|null $payment_method
 * @property string $payment_status
 * @property string|null $payment_approve_date
 * @property string|null $transaction_id
 * @property string|null $coupon_info
 * @property string|null $currency_name
 * @property string $order_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $delivery_area_id
 * @property int $address_id
 * @property-read \App\Models\DeliveryArea|null $delivery_area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $order_item
 * @property-read int|null $order_item_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Address|null $user_address
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCouponInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereGrandTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentApproveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $order_id
 * @property string $product_name
 * @property int $product_id
 * @property float $unit_price
 * @property int $qty
 * @property string|null $product_size
 * @property string|null $product_option
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUpdatedAt($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateWaySetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateWaySetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateWaySetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateWaySetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateWaySetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateWaySetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateWaySetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateWaySetting whereValue($value)
 */
	class PaymentGateWaySetting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $thumbnail_image
 * @property int $category_id
 * @property string $short_description
 * @property string $long_description
 * @property float $price
 * @property float $offer_price
 * @property int|null $quantity
 * @property string|null $sku
 * @property int $show_at_home
 * @property int $status
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductGallery> $productImages
 * @property-read int|null $product_images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductOption> $productOptions
 * @property-read int|null $product_options_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductRating> $productRatings
 * @property-read int|null $product_ratings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductSize> $productSizes
 * @property-read int|null $product_sizes_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOfferPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShowAtHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumbnailImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductGalleryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGallery whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGallery whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductGallery whereUpdatedAt($value)
 */
	class ProductGallery extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductOptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption whereUpdatedAt($value)
 */
	class ProductOption extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $rating
 * @property string|null $comment
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $products
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereUserId($value)
 */
	class ProductRating extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductSizeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereUpdatedAt($value)
 */
	class ProductSize extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereValue($value)
 */
	class Settings extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property string|null $offer
 * @property string $title
 * @property string|null $sub_title
 * @property string|null $short_description
 * @property string|null $button_link
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SliderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereButtonLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 */
	class Slider extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string $role
 * @property string $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|WishList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WishList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WishList query()
 * @method static \Illuminate\Database\Eloquent\Builder|WishList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WishList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WishList whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WishList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WishList whereUserId($value)
 */
	class WishList extends \Eloquent {}
}

