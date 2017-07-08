<div class="sizebar-left col-ex-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-ex-pull-10 col-lg-pull-9 col-md-pull-9 col-sm-pull-0" >
    <div class="inner-sizebar clearfix" >
        <aside class="box-aside fillter" data-align-height="left"  data-bottom="20" >
            <div class="aside-heading">
                <h2 class="title-aside clearfix" >
                    <button type="button" class="fa fa-bars pull-xs-left" data-toggle="collapse" href="#navFillter" aria-controls="navFillter>
                        <i class="fa fa-bars pull-xs-left" aria-hidden="true"></i>
                    </button>
                    <span class="pull-xs-left" >@if (isset($cateObj)) {{ $cateObj->title }} @endif</span>
                </h2>
            </div>

            <!-- BEGIN SUB CATEGORY -->
            @include('front.product.partial.sub_category')
            <!-- END SUB CATEGORY -->

            <div class="aside-content" >
                <div class="navbar-toggleable-lg collapse in" id="navFillter" >
                    <div class="bar-fillter clearfix" >
                        <div class="fillter-item clearfix" data-place="itemFillter" data-id="price" >
                            <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="price" >
                                <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="price" rel="nofollow" >
                                    THEO GIÁ
                                    <span class="fillter-direct" >
                                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="price" >
                                <div class="clearfix wrap-ranger-price" >
                                    <input type="text" data-neo="ionRangeSlider"  data-min="0" data-max="10000" data-grid="true" value="50000" name="price" data-input="price" />
                                </div>
                                <div class="price-from-to" >
                                    GIÁ TỪ : 
                                    <span class="txt-ranger-from" data-place="valueRangerFrom" >
                                        0
                                    </span> - 
                                    <span class="txt-ranger-to"  data-place="valueRangerTo" >
                                        10000
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="fillter-item clearfix" data-place="itemFillter" data-id="" >
                            <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="" >
                                <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="" rel="nofollow" >
                                    THEO MÀU SẮC
                                    <span class="fillter-direct" >
                                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="" >
                                <div class="list-fillter-check clearfix" >
                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                ĐEN
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>

                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                TRẮNG
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>

                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                XÁM
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>

                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                XANH
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>

                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                VÀNG
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>
                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                ĐỎ
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="fillter-item clearfix" data-place="itemFillter" data-id="" >
                            <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="" >
                                <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="" rel="nofollow" >
                                    THEO KÍCH CỠ
                                    <span class="fillter-direct" >
                                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="" >
                                <div class="list-fillter-check clearfix" >
                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                60x60
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>

                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                80x80
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>

                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                100x100
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>

                                    <div class="coz-item-check" data-id="" >
                                        <div class="coz-check-box" >
                                            <span></span>
                                            <input type="checkbox" name="feature[]" value="0" style="display: none" data-id="" data-input="feature" >
                                        </div>
                                        <div class="coz-lable-check" >
                                            <span class="coz-label-check-inner">
                                                200x200
                                            </span>
                                            <span class="coz-sum-check" >(2)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>