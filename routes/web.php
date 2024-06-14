<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Frontend
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/category/{slug_category}', [App\Http\Controllers\CategoryProductController::class, 'showCategoryID'])->name('categoryId');
Route::get('/brand/{slug_brand}', [App\Http\Controllers\BrandController::class, 'showBrandID'])->name('brandId2');
Route::get('/brand-type/{type_brand_product}', [App\Http\Controllers\BrandController::class, 'showBrandID2'])->name('brandId');
Route::get('/product/{slug_product}', [App\Http\Controllers\ProductController::class, 'showProductID'])->name('productId');
Route::get('/404', [App\Http\Controllers\HomeController::class, 'show404'])->name('show404');
Route::post('/autocomplete-ajax', [App\Http\Controllers\HomeController::class, 'searchAutocomplete'])->name('searchAutocomplete');
Route::get('/tim-kiem', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::post('/waiting-comment-approval-ajax', [App\Http\Controllers\CommentController::class, 'waitingComment'])->name('waitingComment');
Route::post('/tab-product-ajax', [App\Http\Controllers\BrandController::class, 'tabProduct'])->name('tabProduct');
Route::get('/yeu-thich', [App\Http\Controllers\HomeController::class, 'wishlist'])->name('wishlist');
//--Cart
Route::post('/save-cart', [App\Http\Controllers\CartController::class, 'saveCart'])->name('saveCart');
Route::post('/add-cart-ajax', [App\Http\Controllers\CartController::class, 'addCartAjax'])->name('AjaxCart');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'showCart'])->name('cart');
Route::get('/del-item-cart/{rowId}', [App\Http\Controllers\CartController::class, 'delItemCart'])->name('delItemCart');
Route::post('/update-item-cart', [App\Http\Controllers\CartController::class, 'updateItemCart'])->name('updateItemCart');
//--Coupon
Route::get('/check-coupon', [App\Http\Controllers\CouponController::class, 'checkCoupon'])->name('checkCoupon');
Route::get('/unset-coupon', [App\Http\Controllers\CouponController::class, 'unsetCoupon'])->name('unsetCoupon');
//--Checkout
Route::get('/login-checkout', [App\Http\Controllers\CheckoutController::class, 'loginCheckout'])->name('loginCheckout');
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'showCheckout'])->name('showCheckout');
Route::post('/save-order', [App\Http\Controllers\CheckoutController::class, 'saveOrder'])->name('saveOrder');
Route::get('/payment', [App\Http\Controllers\CheckoutController::class, 'showPayment'])->name('showPayment');
Route::post('/add-address-order', [App\Http\Controllers\CheckoutController::class, 'addAddress'])->name('addAddress');
Route::get('/unset-address', [App\Http\Controllers\CheckoutController::class, 'unsetAddress'])->name('unsetAddress');
Route::get('/notify', [App\Http\Controllers\CheckoutController::class, 'showOrderSuccess'])->name('showOrderSuccess');
// Route::post('/address-order', [App\Http\Controllers\CheckoutController::class, 'showAddress'])->name('showAddress');
//--Client
Route::get('/client-info', [App\Http\Controllers\ClientController::class, 'clientInfo'])->name('clientInfo');
Route::get('/client-order', [App\Http\Controllers\ClientController::class, 'clientOrder'])->name('clientOrder');
Route::get('/del-address-client', [App\Http\Controllers\ClientController::class, 'delAddressClient'])->name('delAddressClient');
Route::get('/client-order-detail/{code_order}', [App\Http\Controllers\ClientController::class, 'clientOrderDetail'])->name('clientOrder');
Route::post('/update-account', [App\Http\Controllers\ClientController::class, 'updateAccount'])->name('updateAccount');
Route::post('/add-address-order-account', [App\Http\Controllers\ClientController::class, 'updateAddress'])->name('updateAddress');
//--signup
Route::post('/signup', [App\Http\Controllers\ClientController::class, 'signup'])->name('signup');
//--login
Route::post('/login', [App\Http\Controllers\ClientController::class, 'login'])->name('login');
//--logout
Route::get('/logout', [App\Http\Controllers\ClientController::class, 'logout'])->name('logout');
//--contact
Route::get('/contact-us', [App\Http\Controllers\ContactController::class, 'showContactUs'])->name('showContactUs');
Route::post('/send-contact', [App\Http\Controllers\ContactController::class, 'sendContact'])->name('sendContact');
//--Post
Route::get('/post', [App\Http\Controllers\PostController::class, 'post'])->name('post');
Route::get('/post/detail/{slug_post}', [App\Http\Controllers\PostController::class, 'detailPost'])->name('detailPost');
Route::get('/post/{slug_typePost}', [App\Http\Controllers\PostController::class, 'typePost'])->name('typePost');


//Backend
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('loginA');
Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'showHomeAdmin'])->name('homeA');
Route::post('/admin-checkLogin', [App\Http\Controllers\AdminController::class, 'checkLoginAdmin'])->name('checkA');
Route::get('/logoutAdmin', [App\Http\Controllers\AdminController::class, 'logout'])->name('logoutA');
//--CategoryProduct
Route::get('/admin/show-add-category-product', [App\Http\Controllers\CategoryProductController::class, 'showAddCategory'])->name('showAddCategoryP');
Route::get('/admin/show-all-category-product', [App\Http\Controllers\CategoryProductController::class, 'showCategoryProduct'])->name('showCategoryP');
Route::get('/admin/edit-category-product/{id_category}', [App\Http\Controllers\CategoryProductController::class, 'showUpdateCategoryProduct'])->name('showUpdateCategoryP');
Route::middleware(['roles:Admin|Author'])->group(function () {
    Route::get('/admin/del-category-product/{id_category}', [App\Http\Controllers\CategoryProductController::class, 'delCategoryProduct'])->name('delCategoryP');
    Route::post('/admin/add-category-product', [App\Http\Controllers\CategoryProductController::class, 'addCategory'])->name('addCategoryP');
    Route::post('/admin/update-category-product/{id_category}', [App\Http\Controllers\CategoryProductController::class, 'updateCategory'])->name('updateCategoryP');
});
//--Brand
Route::get('/admin/show-add-brand', [App\Http\Controllers\BrandController::class, 'showAddBrand'])->name('showAdd');
Route::get('/admin/show-all-brand', [App\Http\Controllers\BrandController::class, 'showBrand'])->name('show');
Route::get('/admin/edit-brand/{id_brand}', [App\Http\Controllers\BrandController::class, 'showUpdateBrand'])->name('showUpdate');
Route::middleware(['roles:Admin|Author'])->group(function () {
    Route::get('/admin/del-brand/{id_brand}', [App\Http\Controllers\BrandController::class, 'delBrand'])->name('del');
    Route::post('/admin/add-brand', [App\Http\Controllers\BrandController::class, 'addBrand'])->name('add');
    Route::post('/admin/update-brand/{id_brand}', [App\Http\Controllers\BrandController::class, 'updateBrand'])->name('update');
});
//--Product
Route::get('/admin/show-add-type-product', [App\Http\Controllers\ProductController::class, 'showTypeProduct'])->name('showAddTypeProduct');
Route::get('/admin/show-add-product/{id_brand}', [App\Http\Controllers\ProductController::class, 'showAddProduct'])->name('showAddProduct');
Route::get('/admin/show-all-product', [App\Http\Controllers\ProductController::class, 'showProduct'])->name('showProduct');
Route::get('/admin/show-edit-product/{id_product}', [App\Http\Controllers\ProductController::class, 'showUpdateProduct'])->name('showUpdateProduct');
Route::middleware(['roles:Admin|Author'])->group(function () {
    Route::get('/admin/del-product/{id_product}', [App\Http\Controllers\ProductController::class, 'delProduct'])->name('delProduct');
    Route::post('/admin/add-product', [App\Http\Controllers\ProductController::class, 'addProduct'])->name('addProduct');
    Route::post('/admin/update-product/{id_product}', [App\Http\Controllers\ProductController::class, 'updateProduct'])->name('updateProduct');
    //--Gallery
    Route::get('/admin/show-add-gallery/{id_product}', [App\Http\Controllers\ProductController::class, 'showAddGallery'])->name('showAddGallery');
    Route::post('/admin/add-gallery', [App\Http\Controllers\ProductController::class, 'addGallery'])->name('addGallery');
    Route::get('/admin/show-edit-gallery/{id_product}', [App\Http\Controllers\ProductController::class, 'showUpdateGallery'])->name('showUpdateGallery');
    Route::post('/admin/update-gallery/{id_gallery}', [App\Http\Controllers\ProductController::class, 'updateGallery'])->name('updateGallery');
    Route::get('/admin/del-gallery/{id_Gallery}', [App\Http\Controllers\ProductController::class, 'delGallery'])->name('delGallery');
});
//--Order
Route::get('/admin/order-details/{id_order}', [App\Http\Controllers\CheckoutController::class, 'showOrderDetail'])->name('showOrderDetail');
Route::get('/admin/show-order/{status}', [App\Http\Controllers\CheckoutController::class, 'showOrderStatus'])->name('showOrderStatus');
Route::post('/admin/update-orderA/{id_order}', [App\Http\Controllers\CheckoutController::class, 'updateOrder'])->name('updateOrder');
//--Coupon
Route::get('/admin/show-add-coupon', [App\Http\Controllers\CouponController::class, 'showAddCoupon'])->name('showAddCoupon');
Route::get('/admin/show-all-coupon', [App\Http\Controllers\CouponController::class, 'showAllCoupon'])->name('showAllCoupon');
Route::get('/admin/show-detail-coupon/{id_coupon}', [App\Http\Controllers\CouponController::class, 'showUpdateCoupon'])->name('showupdateCoupon');
Route::middleware(['roles:Admin|Author'])->group(function () {
    Route::post('/admin/add-coupon', [App\Http\Controllers\CouponController::class, 'addCoupon'])->name('addCoupon');
    Route::post('/admin/update-coupon/{id_coupon}', [App\Http\Controllers\CouponController::class, 'updateCoupon'])->name('updateCoupon');
    Route::get('/admin/del-coupon/{id_coupon}', [App\Http\Controllers\CouponController::class, 'delCoupon'])->name('delCoupon');
});
//--Delivery
Route::get('/admin/show-add-delivery', [App\Http\Controllers\DeliveryController::class, 'showAddDelivery'])->name('showAddDelivery');
Route::get('/admin/show-add-delivery2', [App\Http\Controllers\DeliveryController::class, 'showAddDelivery2'])->name('showAddDelivery2');
Route::get('/admin/show-edit-delivery', [App\Http\Controllers\DeliveryController::class, 'showUpdateDelivery'])->name('showUpdateDelivery');
Route::post('/admin/select-delivery', [App\Http\Controllers\DeliveryController::class, 'selectDelivery'])->name('selectDelivery');
Route::post('/admin/add-delivery', [App\Http\Controllers\DeliveryController::class, 'addDelivery'])->name('addDelivery');
Route::post('/admin/add-delivery2', [App\Http\Controllers\DeliveryController::class, 'addDelivery2'])->name('addDelivery2');
Route::post('/admin/all-delivery', [App\Http\Controllers\DeliveryController::class, 'allDelivery'])->name('allDelivery');
Route::post('/admin/all-delivery2', [App\Http\Controllers\DeliveryController::class, 'allDelivery2'])->name('allDelivery2');
Route::post('/admin/update-delivery', [App\Http\Controllers\DeliveryController::class, 'updateDelivery'])->name('updateDelivery');
Route::post('/admin/update-delivery2', [App\Http\Controllers\DeliveryController::class, 'updateDelivery2'])->name('updateDelivery2');
Route::get('/admin/del-delivery/{id_fee}', [App\Http\Controllers\DeliveryController::class, 'delDelivery'])->name('delDelivery');
Route::get('/admin/del-delivery2/{id_fee}', [App\Http\Controllers\DeliveryController::class, 'delDelivery2'])->name('delDelivery2');
//--Slider / Banner
Route::get('/admin/show-add-banner', [App\Http\Controllers\BannerController::class, 'showAddBanner'])->name('showAddBanner');
Route::get('/admin/show-all-banner', [App\Http\Controllers\BannerController::class, 'showAllBanner'])->name('showAllBanner');
Route::get('/admin/show-edit-banner/{id_banner}', [App\Http\Controllers\BannerController::class, 'showEditBanner'])->name('showEditBanner');
Route::middleware(['roles:Admin|Author'])->group(function () {
    Route::post('/admin/add-banner', [App\Http\Controllers\BannerController::class, 'addBanner'])->name('addBanner');
    Route::post('/admin/update-banner/{id_banner}', [App\Http\Controllers\BannerController::class, 'updateBanner'])->name('updateBanner');
    Route::get('/admin/del-banner/{id_banner}', [App\Http\Controllers\BannerController::class, 'delBanner'])->name('delBanner');
});

Route::group(['middleware' => 'roles:Admin'], function () {
    //--Role
    Route::get('/admin/show-add-role', [App\Http\Controllers\RoleController::class, 'showAddRole'])->name('showAddRole');
    Route::get('/admin/show-all-role', [App\Http\Controllers\RoleController::class, 'showAllRole'])->name('showAllRole');
    Route::get('/admin/show-edit-role/{id_role}', [App\Http\Controllers\RoleController::class, 'showEditRole'])->name('showEditRole');
    Route::post('/admin/add-role', [App\Http\Controllers\RoleController::class, 'addRole'])->name('addRole');
    Route::post('/admin/role-admin', [App\Http\Controllers\RoleController::class, 'roleAdmin'])->name('roleAdmin');
    //--Admin
    Route::get('/admin/show-add-admin', [App\Http\Controllers\AdminController::class, 'showAddAdmin'])->name('showAddAdmin');
    Route::get('/admin/show-all-admin', [App\Http\Controllers\AdminController::class, 'showAllAdmin'])->name('showAllAdmin');
    Route::get('/admin/show-edit-admin/{id_admin}', [App\Http\Controllers\AdminController::class, 'showEditAdmin'])->name('showEditAdmin');
    Route::post('/admin/add-admin', [App\Http\Controllers\AdminController::class, 'addAdmin'])->name('addAdmin');
    Route::post('/admin/update-admin/{id_admin}', [App\Http\Controllers\AdminController::class, 'updateAdmin'])->name('updateAdmin');
    Route::get('/admin/del-admin/{id_admin}', [App\Http\Controllers\AdminController::class, 'delAdmin'])->name('delAdmin');
});

//--Comment
Route::get('/admin/show-comment/{status}', [App\Http\Controllers\CommentController::class, 'showComment'])->name('showComment');
Route::post('/admin/update-comment/{id_comment}', [App\Http\Controllers\CommentController::class, 'updateComment'])->name('updateComment');
Route::get('/admin/del-comment/{id_comment}', [App\Http\Controllers\CommentController::class, 'delComment'])->name('delComment');
Route::post('/admin/detail-comment', [App\Http\Controllers\CommentController::class, 'detailComment'])->name('detailComment');
Route::post('/admin/rep-comment', [App\Http\Controllers\CommentController::class, 'repComment'])->name('repComment');

//--Contact
Route::get('/admin/show-contact/{status}', [App\Http\Controllers\ContactController::class, 'showContact'])->name('showContact');
Route::post('/admin/update-contact/{id_contact}', [App\Http\Controllers\ContactController::class, 'updateContact'])->name('updateContact');
Route::get('/admin/del-contact/{id_contact}', [App\Http\Controllers\ContactController::class, 'delContact'])->name('delContact');
Route::post('/admin/detail-contact', [App\Http\Controllers\ContactController::class, 'detailContact'])->name('detailContact');
Route::post('/admin/rep-contact', [App\Http\Controllers\ContactController::class, 'repContact'])->name('repContact');

//--Sort | Filter
Route::get('/admin/show-add-sort', [App\Http\Controllers\SortController::class, 'showAddSort'])->name('showAddSort');
Route::get('/admin/show-all-sort', [App\Http\Controllers\SortController::class, 'showAllSort'])->name('showAllSort');
Route::get('/admin/show-edit-sort/{id_sort}', [App\Http\Controllers\SortController::class, 'showEditSort'])->name('showEditSort');
Route::post('/admin/add-sort', [App\Http\Controllers\SortController::class, 'addSort'])->name('addSort');
Route::post('/admin/update-sort/{id_sort}', [App\Http\Controllers\SortController::class, 'updateSort'])->name('updateSort');
Route::get('/admin/del-sort/{id_sort}', [App\Http\Controllers\SortController::class, 'delSort'])->name('delSort');
//--Statistic
Route::post('/admin/filter-by-date', [App\Http\Controllers\StatisticController::class, 'filterByDate'])->name('filterByDate');
Route::post('/admin/filter-by-30days', [App\Http\Controllers\StatisticController::class, 'filterBy30days'])->name('filterBy30days');
Route::post('/admin/filter-by-preset', [App\Http\Controllers\StatisticController::class, 'filterByPreset'])->name('filterByPreset');
Route::post('/admin/chartPOP', [App\Http\Controllers\StatisticController::class, 'chartPOP'])->name('chartPOP');

//--Post
Route::get('/admin/show-all-post', [App\Http\Controllers\PostController::class, 'showAllPost'])->name('showAllPost');
Route::get('/admin/show-detail-post/{id_post}', [App\Http\Controllers\PostController::class, 'showDetailPost'])->name('showDetailPost');
Route::get('/admin/preview-page-post/{id_post}', [App\Http\Controllers\PostController::class, 'showPreviewPost'])->name('showPreviewPost');
Route::middleware(['roles:Admin|Author'])->group(function () {
    Route::get('/admin/show-add-post', [App\Http\Controllers\PostController::class, 'showAddPost'])->name('showAddPost');
    Route::get('/admin/show-add-tag-post', [App\Http\Controllers\PostController::class, 'showAddTagPost'])->name('showAddTagPost');
    Route::get('/admin/show-edit-post/{id_post}', [App\Http\Controllers\PostController::class, 'showEditPost'])->name('showEditPost');
    Route::get('/admin/show-edit-tag-post/{id_typePost}', [App\Http\Controllers\PostController::class, 'showEditTagPost'])->name('showEditTagPost');
    Route::post('/admin/add-post', [App\Http\Controllers\PostController::class, 'addPost'])->name('addPost');
    Route::post('/admin/add-tag-post', [App\Http\Controllers\PostController::class, 'addTagPost'])->name('addTagPost');
    Route::post('/admin/update-post/{id_post}', [App\Http\Controllers\PostController::class, 'updatePost'])->name('updatePost');
    Route::post('/admin/update-tag-post/{id_typePost}', [App\Http\Controllers\PostController::class, 'updateTagPost'])->name('updateTagPost');
    Route::get('/admin/del-post/{id_post}', [App\Http\Controllers\PostController::class, 'delPost'])->name('delPost');
    Route::get('/admin/del-tag-post/{id_typePost}', [App\Http\Controllers\PostController::class, 'delTagPost'])->name('delTagPost');
});

Route::post('/upload', [App\Http\Controllers\PostController::class, 'upload'])->name('ckeditor.upload');
