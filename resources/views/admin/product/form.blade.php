@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Product
            <small>{{ $title }}</small>
        </h1>
    </section>
    <?php
        $listStatus         = config('product.product_status.label');
        $listPaymentMethod  = config('product.payment_method.label');
        $listShippingMethod = config('product.shipping_method.label');
    ?>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('notifications')
                <form role="form" action="{{ route('ajax_admin_product_save') }}" id="form-product" method="post">
                <div class="nav-tabs-custom">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        <a href="{{ route('admin_product_index') }}" class="btn btn-default btn-sm">Back</a>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <!-- left -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Categories</label>
                                    <select name="categories" id="categories" class="form-control border-corner">
                                        <option value="">------</option>
                                        @foreach ($categories as $cate)
                                        <option value="{{ $cate->id }}"  @if (old('categories', isset($product->category_id) ? $product->category_id : '') == $cate->id) selected="selected" @endif>{{ $cate->title }}</option>
                                        @endforeach
                                        </select>
                                        <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Sub Categories</label>
                                    <select name="sub_categories" id="sub_categories" class="form-control border-corner">
                                        <option value="">------</option>
                                    </select>    
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select name="status" id="status" class="form-control border-corner">
                                        @foreach ($listStatus as $keyStatus => $status)
                                        <option value="{{ $keyStatus }}">{{ trans($status) }}</option>
                                        @endforeach
                                    </select>    
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Image thumb</label>
                                    <select name="status" id="status" class="form-control border-corner">
                                        <option value="">------</option>
                                    </select>    
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Image detail</label>
                                    <select name="status" id="status" class="form-control border-corner">
                                        <option value="">------</option>
                                    </select>    
                                    <p class="help-block"></p>
                                </div>
                            </div>

                            <!-- right -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">User</label>
                                    <input type="text" class="form-control border-corner" name="user" placeholder="Input ..." value="" />
                                      <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <input type="text" class="form-control border-corner" name="price" placeholder="Input ..." value="" />
                                      <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Quantity</label>
                                    <input type="text" class="form-control border-corner" name="quantity" placeholder="Input ..." value="" />
                                      <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Quantity limit</label>
                                    <input type="text" class="form-control border-corner" name="quantity_limit" placeholder="Input ..." value="" />
                                      <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Payment method</label>
                                    <select name="payment_method" id="payment_method" class="form-control border-corner">
                                        <option value="">------</option>
                                        @foreach($listPaymentMethod as $keyPay => $payMethod)
                                        <option value="{{ $keyPay }}">{{ trans($payMethod) }}</option>
                                        @endforeach
                                    </select>    
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Shipping method</label>
                                    <select name="shipping_method" id="shipping_method" class="form-control border-corner">
                                        <option value="">------</option>
                                        @foreach ($listShippingMethod as $keyShip => $shipMethod)
                                        <option value="{{ $keyShip }}">{{ trans($shipMethod) }}</option>
                                        @endforeach
                                    </select>    
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Position use</label>
                                    <select name="shipping_method" id="shipping_method" class="form-control border-corner">
                                        <option value="">------</option>
                                    </select>    
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Size</label>
                                    <select name="size" id="size" class="form-control border-corner">
                                        <option value="">------</option>
                                    </select>    
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Style</label>
                                    <select name="style" id="style" class="form-control border-corner">
                                        <option value="">------</option>
                                    </select>    
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        @foreach ($languages as $lang)
                        <li @if($lang->iso2 === 'vi') class="active" @endif><a href="#tab_{{ $lang->iso2 }}" data-toggle="tab">{{ $lang->name }}</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($languages as $lang)
                        <div class="tab-pane @if($lang->iso2 === 'vi') active @endif" id="tab_{{ $lang->iso2 }}">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <?php 
                                                $title       = 'title_'.$lang->iso2;
                                                $slug        = 'slug_'.$lang->iso2;
                                                $color       = 'color_'.$lang->iso2;
                                                $brand       = 'brand_'.$lang->iso2;
                                                $material    = 'material_'.$lang->iso2;
                                                $infoTech    = 'info_tech_'.$lang->iso2;
                                                $featureHighlight = 'feature_highlight_'.$lang->iso2;
                                                $source           = 'source_'.$lang->iso2;
                                                $guarantee        = 'guarantee_'.$lang->iso2;
                                                $deliveryLocation = 'delivery_location_'.$lang->iso2;
                                                $detail           = 'detail_'.$lang->iso2;
                                                $formProduct      = 'form_product_'.$lang->iso2;
                                            ?>
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$title) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $title }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$slug) }}</label>
                                                <p class="help-block">xxx</p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$color) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $color }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$brand) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $brand }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$material) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $material }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$infoTech) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $infoTech }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$featureHighlight) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $featureHighlight }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$source) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $source }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$guarantee) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $guarantee }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$deliveryLocation) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $deliveryLocation }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$detail) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $detail }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$formProduct) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $formProduct }}" placeholder="Input ..." value="" />
                                                  <p class="help-block"></p>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.tab-content -->
                </div>
                </form>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
@endsection

@section('footer_script')
<script>
$(function() {
    $('.title-cate').bind('keyup change', function () {
       createSlugLink($(this));
    });
    function createSlugLink(obj) {
        var lang = $(obj).attr('lang');
        var str = $(obj).val();
        var slug = formatSlug(str);
        $(obj).closest('.box-body').find('.slug-'+lang).html(slug);
    }
});
</script>

@endsection