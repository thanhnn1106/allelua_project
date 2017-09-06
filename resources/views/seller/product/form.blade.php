@extends('front.layout')

@section('content')

<div class="clearfix">
    <ul class="breadcrumbs">
        <li class="home">
            <a href="{{ route('home') }}">{{ trans('front.bread_crum.home') }}</a>
        </li>
        <li>
            <a href="{{ route('seller_product_index') }}">{{ trans('front.product.list_product') }}</a>
        </li>
        <li><span>{{ trans('front.product.make_product') }}</span></li>
    </ul>
</div>

<?php
$listStatus = config('product.product_seller_status.label');
$listPaymentMethod = config('product.payment_method.label');
$listShippingMethod = config('product.shipping_method.label');
?>
<div class="inner-page-main" data-align-height="wrap">
    <div class="row" >
        <div class="clearfix save-marle col-ex-10 col-lg-9 col-md-8 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-4 col-sm-push-0" >
            <div class="page-right clearfix" >
                <div class="row">
                    <div class="col-sm-12" >
                        @include('notifications')
                        <div class="content-center">
                            <div class="inner-content-center clearfix" >
                                <div class="row" >
                                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12"  >
                                        <div class="wrap-form clearfix" >
                                            <h1 class="title-form text-xs-center" >
                                                {{ trans('front.product.lb_title_product_info') }}
                                            </h1>
                                            <div class="content-form" >
                                                @include('notifications')
                                                <div class="alert alert-danger alert-block" style="display:none;">
                                                    <button type="button" class="close" data-dismiss="alert"></button>
                                                    <p></p>
                                                </div>
                                                <form id="form_product" name="form_product" class="clearfix" action="{{ route('seller_product_save') }}" id="seller_form_product" method="POST" >
                                                    <div class="form-group" >
                                                        <div class="row" >
                                                            <div class="col-sm-offset-4" >
                                                                <button type="button" onclick="window.location.href ='{{ route('seller_product_index') }}';" class="btn btn-style btn-heart" title="{{ trans('front.product.destroy_product') }}" >
                                                                    <span>{{ trans('front.product.destroy_product') }}</span>
                                                                </button>
                                                                <button type="button" class="btn btn-style save_product" title="{{ trans('front.product.make_product') }}" >
                                                                    <span>{{ trans('front.product.make_product') }}</span>
                                                                </button>
                                                                <input type="hidden" id="hide_category_id" value="{{ $product->category_id or null }}" />
                                                                <input type="hidden" id="hide_sub_category_id" value="{{ $product->sub_category_id or null }}" />
                                                                <input type="hidden" id="hide_position_use" value="{{ $product->position_use or null }}" />
                                                                <input type="hidden" id="hide_size" value="{{ $product->size or null }}" />
                                                                <input type="hidden" id="hide_style" value="{{ $product->style or null }}" />
                                                                <input type="hidden" id="hide_material" value="{{ $product->material or null }}" />
                                                                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id or null }}" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-categories" >
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >{{ trans('front.product.category') }}<span class="required-field"> (*)</span></label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <select name="categories" id="categories" url-cate="{{ route('ajax_product_load_cate') }}" class="form-control input-select2">
                                                                    <option value="">------</option>
                                                                    @foreach ($categories as $cate)
                                                                    <option value="{{ $cate->id }}"  @if ((isset($product->category_id) ? $product->category_id : '') == $cate->id) selected="selected" @endif>{{ $cate->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-sub_categories" >
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >{{ trans('front.product.sub_category') }}<span class="required-field"> (*)</span></label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <select name="sub_categories" id="sub_categories" data-url="{{ route('ajax_product_load_style') }}" class="form-control input-select2">
                                                                    <option value="">------</option>
                                                                </select>
                                                                <div class="input-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="load_style">

                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-status" >
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >{{ trans('front.product.status') }}</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <select name="status" id="status" class="form-control input-select2">
                                                                    @foreach ($listStatus as $keyStatus => $status)
                                                                    <option value="{{ $keyStatus }}" @if ((isset($product->status) ? $product->status : '') == $keyStatus) selected="selected" @endif>{{ trans($status) }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-quantity">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >{{ trans('front.product.quantity') }}<span class="required-field"> (*)</span></label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control form-control-md" id="quantity" name="quantity" value="{{ isset($product->quantity) ? $product->quantity : '' }}" />
                                                                <div class="input-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-quantity_limit" >
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >{{ trans('front.product.quantity_limit') }}<span class="required-field"> (*)</span></label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control form-control-md" id="quantity_limit" name="quantity_limit" value="{{ isset($product->quantity_limit) ? $product->quantity_limit : '' }}" />
                                                                <div class="input-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-price" >
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >{{ trans('front.product.price') }}<span class="required-field"> (*)</span></label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control form-control-md" id="price" name="price" value="{{ isset($product->price) ? $product->price : '' }}" />
                                                                <div class="input-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-payment_method" >
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >{{ trans('front.product.payment_method') }}<span class="required-field"> (*)</span></label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <select name="payment_method" id="payment_method" class="form-control input-select2">
                                                                    <option value="">------</option>
                                                                    @foreach($listPaymentMethod as $keyPay => $payMethod)
                                                                    <option value="{{ $keyPay }}" @if ((isset($product->payment_method) ? $product->payment_method : '') == $keyPay) selected="selected" @endif>{{ trans($payMethod) }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-shipping_method">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >{{ trans('front.product.shipping_method') }}<span class="required-field"> (*)</span></label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <select name="shipping_method" id="shipping_method" class="form-control input-select2">
                                                                    <option value="">------</option>
                                                                    @foreach ($listShippingMethod as $keyShip => $shipMethod)
                                                                    <option value="{{ $keyShip }}" @if ((isset($product->shipping_method) ? $product->shipping_method : '') == $keyShip) selected="selected" @endif>{{ trans($shipMethod) }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-image_thumb form-upload" >
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >
                                                                    {{ trans('front.product.image_thumb') }} <span class="required-field"> (*)</span><br/>
                                                                    <span class="note-red">(Max: 2MB - *.jpg, *.jpeg, *.png, *.gif)</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                                <div class="list-img-upload clearfix" >
                                                                    <div id="image_thumb_preview" class="img-prevew-upload btn-upload" style="cursor: pointer;">
                                                                        @if(isset($product->image_rand) && isset($product->image_real))
                                                                        <?php $imageThumb = getImage($product->image_rand, $product->image_real); ?>
                                                                        <a href="{{ $imageThumb['href'] }}" target="_blank"><img src="{{ $imageThumb['href'] }}" width="100px" height="100px" /></a><br/>
                                                                        @endif
                                                                    </div>
                                                                    <input type="file" accept="image/*" name="image_thumb" id="image_thumb" class="img-value" style="display: none;" />
                                                                    <div class="input-error"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" >
                                                        <div class="row form-total_image_detail" >
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                                <label class="lbl-form-control" >
                                                                    {{ trans('front.product.image_detail') }}<span class="required-field"> (*)</span><br />
                                                                    <span class="note-red">(Max: 2MB - *.jpg, *.jpeg, *.png, *.gif)</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                                <div class="list-img-upload clearfix" >
                                                                    <input id="image_detail" name="files[]" type="file" multiple class="file-loading" accept="image/*" />
                                                                </div>
                                                                <div class="input-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12">
                                                        <!-- Nav tabs -->
                                                        <div class="clearfix">
                                                            <ul class="nav nav-inline nav-tab-detailspro clearfix" role="tablist">
                                                                @foreach ($languages as $lang)
                                                                <li class="nav-item"><a data-toggle="tab" class="nav-link @if($lang->iso2 === Lang::locale()) active @endif" href="#tab_{{ $lang->iso2 }}" role="tab" rel="nofollow" aria-expanded="true">{{ $lang->name }}</a></li>
                                                                @endforeach

                                                            </ul>
                                                        </div>

                                                        <div class="tab-content tab-content-detailspro clearfix">

                                                            @foreach ($languages as $lang)
                                                            <?php
                                                            $title = 'title_' . $lang->iso2;
                                                            $slug = 'slug_' . $lang->iso2;
                                                            $color = 'color_' . $lang->iso2;
                                                            $brand = 'brand_' . $lang->iso2;
                                                            $infoTech = 'info_tech_' . $lang->iso2;
                                                            $featureHighlight = 'feature_highlight_' . $lang->iso2;
                                                            $source = 'source_' . $lang->iso2;
                                                            $guarantee = 'guarantee_' . $lang->iso2;
                                                            $deliveryLocation = 'delivery_location_' . $lang->iso2;
                                                            $detail = 'detail_' . $lang->iso2;
                                                            $formProduct = 'form_product_' . $lang->iso2;
                                                            ?>
                                                            <div class="tab-pane fade @if($lang->iso2 === Lang::locale()) active @endif in" id="tab_{{ $lang->iso2 }}" role="tabpanel" aria-expanded="true">
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $title }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$title) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <input type="text" class="form-control form-control-md title-slug" lang="{{ $lang->iso2 }}" name="{{ $title }}" value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->title : '' }}" />
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$slug) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <p class="help-block-default slug-{{ $lang->iso2 }}">{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->slug : '' }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $color }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$color) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <input type="text" class="form-control form-control-md" name="{{ $color }}" value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->color : '' }}" />
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $brand }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$brand) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <input type="text" class="form-control form-control-md" name="{{ $brand }}" value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->brand : '' }}" />
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $infoTech }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$infoTech) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <input type="text" class="form-control form-control-md" name="{{ $infoTech }}" value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->info_tech : '' }}" />
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $featureHighlight }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$featureHighlight) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <input type="text" class="form-control form-control-md" name="{{ $featureHighlight }}" value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->feature_highlight : '' }}" />
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $source }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$source) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <input type="text" class="form-control form-control-md" name="{{ $source }}" value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->source : '' }}" />
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $guarantee }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$guarantee) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <input type="text" class="form-control form-control-md" name="{{ $guarantee }}" value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->guarantee : '' }}" />
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $deliveryLocation }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$deliveryLocation) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <input type="text" class="form-control form-control-md" name="{{ $deliveryLocation }}" value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->delivery_location : '' }}" />
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $detail }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$detail) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <textarea name="{{ $detail }}"  class="input-payment">{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->detail : '' }}</textarea>
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row form-{{ $formProduct }}">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <label class="lbl-form-control">
                                                                                {{ trans('admin.product.'.$formProduct) }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                            <textarea name="{{ $formProduct }}"  class="input-payment">{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->form_product : '' }}</textarea>
                                                                            <div class="input-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group" >
                                                        <div class="row" >
                                                            <div class="col-sm-offset-4" >
                                                                <button type="button" onclick="window.location.href ='{{ route('seller_product_index') }}';" class="btn btn-style btn-heart" title="{{ trans('front.product.destroy_product') }}" >
                                                                    <span>{{ trans('front.product.destroy_product') }}</span>
                                                                </button>
                                                                <button type="button" class="btn btn-style save_product" title="{{ trans('front.product.make_product') }}" >
                                                                    <span>{{ trans('front.product.make_product') }}</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end clearfix save-marle -->
        <div class="sizebar-left col-ex-2 col-lg-3 col-md-4 col-sm-12 col-xs-12 col-ex-pull-10 col-lg-pull-9 col-md-pull-8 col-sm-pull-0" data-align-height="right" data-bottom="20">
            <div class="inner-sizebar clearfix">
                @include('seller.information');
            </div>
        </div>
    </div>
</div>
<!-- upload product -->
<div id="content_img" style="display: none;">
    <a href="javscript:void(0);" class="img-review"></a>
</div>
<!-- end upload product -->

<div class="inner-page-main"  data-align-height="wrap">
    <!-- BEGIN BEST PRICE -->
    @include('front.partial.best_price')
    <!-- END BEST PRICE -->
</div>

<!-- BEGIN RELATED PRODUCT -->
@include('front.partial.related')
<!-- END RELATED PRODUCT -->

<!-- BEGIN BEST PRICE -->
@include('front.partial.favorite')
<!-- END BEST PRICE -->

<!-- BEGIN COUNTRY AND SERVICE -->
@include('front.partial.country_service')
<!-- END COUNTRY AND SERVICE -->

<?php
$initPreviewImage = isset($productImages['initialPreview']) ? json_encode($productImages['initialPreview']) : NULL;
$initPreviewConfig = isset($productImages['initialPreviewConfig']) ? json_encode($productImages['initialPreviewConfig']) : NULL;
?>
@endsection
@section('footer_script')
<script>
    var product_ajax_upload = '{{ route('ajax_product_upload_file') }}';
    var product_ajax_delete = '{{ route('ajax_product_delete_file') }}';
    var initialPreviewImg = initialPreviewConfigImg = [];
    @if (! is_null($initPreviewImage))
            initialPreviewImg = {!! $initPreviewImage !!};
    @endif

            @if (! is_null($initPreviewConfig))
            initialPreviewConfigImg = {!! $initPreviewConfig !!};
    @endif

</script>
<!-- bootstrap multiple upload -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
<script src="{{ asset('plugins/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<!--<script src="{{ asset_admin('/plugins/bootstrap-fileinput/themes/fa/theme.js') }}"></script>-->
<script src="{{ asset('/plugins/bootstrap-fileinput/js/locales/LANG.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-fileinput/themes/explorer/theme.js') }}"></script>
<script src="{{ asset_admin('js/common.js') }}"></script>
<script src="{{ asset_front('js/product.js') }}"></script>
@endsection
