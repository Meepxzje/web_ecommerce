@if(isset($dm->id))
@if($dm->ten == 'Laptop' || ($dm->parent && $dm->parent->ten == 'Laptop'))
<aside class="uk-width-1-4 tm-aside-column tm-filters" id="filters" uk-offcanvas="overlay: true; container: false;">
    <div class="uk-offcanvas-bar uk-padding-remove">
        <div class="uk-card uk-card-default uk-card-small uk-flex uk-flex-column uk-height-1-1">
            <header class="uk-card-header ">
            </header>
            <div class="uk-margin-remove uk-flex-1 uk-overflow-auto" uk-accordion="multiple: true; targets: &gt; .js-accordion-section" style="flex-basis: auto">
                <section class="uk-card-body uk-open js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Giá
                    </h4>
                    <div class="uk-accordion-content">
                        <div class="price-filter" style="width: 100%; margin: 20px auto;">
                            <div id="slider"></div>
                            <div class="price-range" style=" margin: 20px 0;display: flex;justify-content: space-between;">
                                <span id="min-price">0</span>
                                <span id="max-price">100,000,000</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section uk-open">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Hãng
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($nsx as $i)
                            <li>
                                <input class="tm-checkbox" id="brand-{{$i->id}}" name="brand" value="{{$i->id}}" type="checkbox" /><label for="brand-{{$i->id}}"><span>{{$i->ten}}
                                        <!-- <span class="uk-text-meta uk-text-xsmall">177</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                <section class="uk-card-body js-accordion-section uk-open">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Loại {{$dm->ten}}
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($dmcon as $i)
                            <li>
                                <input class="tm-checkbox" id="dmcon-{{$i->id}}" name="dmcon" value="{{$i->id}}" type="checkbox" /><label for="dmcon-{{$i->id}}"><span>{{$i->ten}}
                                        <!-- <span class="uk-text-meta uk-text-xsmall">177</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Kích cỡ màn hình<span class="tm-help-icon" uk-icon="icon: question; ratio: .75;" onclick="event.stopPropagation();"></span>
                        <div class="uk-margin-remove" uk-drop="mode: click;boundary-align: true; boundary: !.uk-accordion-title; pos: bottom-justify;">
                            <div class="uk-card uk-card-body uk-card-default uk-card-small uk-box-shadow-xlarge uk-text-small">
                                Kích thước màn hình
                            </div>
                        </div>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($manhinh as $i)
                            <li>
                                <input class="tm-checkbox" data-size="{{$i->id}}" id="screen-size-{{$i->id}}" name="screen-size" value="{{$i->id}}" type="checkbox" />
                                <label for="screen-size-{{$i->id}}">{{$i->ten}}
                                    <!-- <span class="uk-text-meta uk-text-xsmall">45</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Ram<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($ram as $i)
                            <li>
                                <input class="tm-checkbox" id="ram-{{$i->id}}" name="ram" value="{{$i->id}}" type="checkbox" /><label for="ram-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Bộ nhớ<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($ssd as $i)
                            <li>
                                <input class="tm-checkbox" id="ssd-{{$i->id}}" name="ssd" value="{{$i->id}}" type="checkbox" /><label for="ssd-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        CPU<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($cpu as $i)
                            <li>
                                <input class="tm-checkbox" id="cpu-{{$i->id}}" name="cpu" value="{{$i->id}}" type="checkbox" /><label for="cpu-{{$i->id}}"><span>{{$i->ten}}
                                        <!-- <span class="uk-text-meta uk-text-xsmall">102</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        VGA<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($gpu as $i)
                            <li>
                                <input class="tm-checkbox" id="gpuroi-{{$i->id}}" name="gpuroi" value="{{$i->id}}" type="checkbox" /><label for="gpuroi-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

            </div>
        </div>
    </div>
</aside>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var slider = document.getElementById('slider');
    noUiSlider.create(slider, {
        start: [0, 100000000],
        connect: true,
        range: {
            'min': 0,
            'max': 100000000
        },
        step: 10,
        format: {
            to: function(value) {
                return formatNumber(value.toFixed(0));
            },
            from: function(value) {
                return Number(value.replace(/,/g, ''));
            }
        }
    });

    var minPriceSpan = document.getElementById('min-price');
    var maxPriceSpan = document.getElementById('max-price');

    slider.noUiSlider.on('update', function(values, handle) {
        if (handle) {
            maxPriceSpan.textContent = formatNumber(values[handle]);
        } else {
            minPriceSpan.textContent = formatNumber(values[handle]);
        }
    });
    $(document).ready(function() {

        function filterProducts() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });


            var sortBy = $('#sortSelect').val();
            filters['sort'] = sortBy;


            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        function filterByPrice() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });

            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        $('input[type="checkbox"]').on('change', filterProducts);
        slider.noUiSlider.on('change', filterByPrice);
        $('#sortSelect').on('change',filterProducts);
    });
</script>
@elseif($dm->id == '2')
<aside class="uk-width-1-4 tm-aside-column tm-filters" id="filters" uk-offcanvas="overlay: true; container: false;">
    <div class="uk-offcanvas-bar uk-padding-remove">
        <div class="uk-card uk-card-default uk-card-small uk-flex uk-flex-column uk-height-1-1">
            <div class="uk-margin-remove uk-flex-1 uk-overflow-auto" uk-accordion="multiple: true; targets: &gt; .js-accordion-section" style="flex-basis: auto">
                <section class="uk-card-body uk-open js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Giá
                    </h4>
                    <div class="uk-accordion-content">
                        <div class="price-filter" style="width: 100%; margin: 20px auto;">
                            <div id="slider"></div>
                            <div class="price-range" style=" margin: 20px 0;display: flex;justify-content: space-between;">
                                <span id="min-price">0</span>
                                <span id="max-price">100,000,000</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section uk-open">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Hãng
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($nsx as $i)
                            <li>
                                <input class="tm-checkbox" id="brand-{{$i->id}}" name="brand" value="{{$i->id}}" type="checkbox" /><label for="brand-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Loại bàn phím<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($loaibanphim as $i)
                            <li>
                                <input class="tm-checkbox" data-size="{{$i->id}}" id="loaibanphim-{{$i->id}}" name="loaibanphim" value="{{$i->id}}" type="checkbox" />
                                <label for="loaibanphim-{{$i->id}}">{{$i->ten}}
                                    <!-- <span class="uk-text-meta uk-text-xsmall">45</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Kiểu dáng bàn phím<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($kieudangbanphim as $i)
                            <li>
                                <input class="tm-checkbox" id="kieudangbanphim-{{$i->id}}" name="kieudangbanphim" value="{{$i->id}}" type="checkbox" /><label for="kieudangbanphim-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Keycap<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($keycap as $i)
                            <li>
                                <input class="tm-checkbox" id="keycap-{{$i->id}}" name="keycap" value="{{$i->id}}" type="checkbox" /><label for="keycap-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</aside>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var slider = document.getElementById('slider');
    noUiSlider.create(slider, {
        start: [0, 100000000],
        connect: true,
        range: {
            'min': 0,
            'max': 100000000
        },
        step: 10,
        format: {
            to: function(value) {
                return formatNumber(value.toFixed(0));
            },
            from: function(value) {
                return Number(value.replace(/,/g, ''));
            }
        }
    });

    var minPriceSpan = document.getElementById('min-price');
    var maxPriceSpan = document.getElementById('max-price');

    slider.noUiSlider.on('update', function(values, handle) {
        if (handle) {
            maxPriceSpan.textContent = formatNumber(values[handle]);
        } else {
            minPriceSpan.textContent = formatNumber(values[handle]);
        }
    });
    $(document).ready(function() {

        function filterProducts() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });


            var sortBy = $('#sortSelect').val();
            filters['sort'] = sortBy;


            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        function filterByPrice() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });

            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        $('input[type="checkbox"]').on('change', filterProducts);
        slider.noUiSlider.on('change', filterByPrice);
        $('#sortSelect').on('change',filterProducts);
    });
</script>
@elseif($dm->id == '3')
<aside class="uk-width-1-4 tm-aside-column tm-filters" id="filters" uk-offcanvas="overlay: true; container: false;">
    <div class="uk-offcanvas-bar uk-padding-remove">
        <div class="uk-card uk-card-default uk-card-small uk-flex uk-flex-column uk-height-1-1">
            <header class="uk-card-header ">
            </header>

            <div class="uk-margin-remove uk-flex-1 uk-overflow-auto" uk-accordion="multiple: true; targets: &gt; .js-accordion-section" style="flex-basis: auto">
                <section class="uk-card-body uk-open js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Giá
                    </h4>
                    <div class="uk-accordion-content">
                        <div class="price-filter" style="width: 100%; margin: 20px auto;">
                            <div id="slider"></div>
                            <div class="price-range" style=" margin: 20px 0;display: flex;justify-content: space-between;">
                                <span id="min-price">0</span>
                                <span id="max-price">100,000,000</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section uk-open">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Hãng
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($nsx as $i)
                            <li>
                                <input class="tm-checkbox" id="brand-{{$i->id}}" name="brand" value="{{$i->id}}" type="checkbox" /><label for="brand-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Dung lượng<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($ram as $i)
                            <li>
                                <input class="tm-checkbox" data-size="{{$i->id}}" id="dlram-{{$i->id}}" name="dlram" value="{{$i->id}}" type="checkbox" />
                                <label for="dlram-{{$i->id}}">{{$i->ten}}
                                    <!-- <span class="uk-text-meta uk-text-xsmall">45</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Loại ram<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($loairam as $i)
                            <li>
                                <input class="tm-checkbox" id="loairam-{{$i->id}}" name="loairam" value="{{$i->id}}" type="checkbox" /><label for="loairam-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Tốc độ Bus<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($tocdobus as $i)
                            <li>
                                <input class="tm-checkbox" id="tocdobus-{{$i->id}}" name="tocdobus" value="{{$i->id}}" type="checkbox" /><label for="tocdobus-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</aside>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var slider = document.getElementById('slider');
    noUiSlider.create(slider, {
        start: [0, 100000000],
        connect: true,
        range: {
            'min': 0,
            'max': 100000000
        },
        step: 10,
        format: {
            to: function(value) {
                return formatNumber(value.toFixed(0));
            },
            from: function(value) {
                return Number(value.replace(/,/g, ''));
            }
        }
    });

    var minPriceSpan = document.getElementById('min-price');
    var maxPriceSpan = document.getElementById('max-price');

    slider.noUiSlider.on('update', function(values, handle) {
        if (handle) {
            maxPriceSpan.textContent = formatNumber(values[handle]);
        } else {
            minPriceSpan.textContent = formatNumber(values[handle]);
        }
    });
    $(document).ready(function() {

        function filterProducts() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });


            var sortBy = $('#sortSelect').val();
            filters['sort'] = sortBy;


            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        function filterByPrice() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });

            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        $('input[type="checkbox"]').on('change', filterProducts);
        slider.noUiSlider.on('change', filterByPrice);
        $('#sortSelect').on('change',filterProducts);
    });
</script>
@elseif($dm->id == '4')
<aside class="uk-width-1-4 tm-aside-column tm-filters" id="filters" uk-offcanvas="overlay: true; container: false;">
    <div class="uk-offcanvas-bar uk-padding-remove">
        <div class="uk-card uk-card-default uk-card-small uk-flex uk-flex-column uk-height-1-1">
            <header class="uk-card-header ">
            </header>

            <div class="uk-margin-remove uk-flex-1 uk-overflow-auto" uk-accordion="multiple: true; targets: &gt; .js-accordion-section" style="flex-basis: auto">
                <section class="uk-card-body uk-open js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Giá
                    </h4>
                    <div class="uk-accordion-content">
                        <div class="price-filter" style="width: 100%; margin: 20px auto;">
                            <div id="slider"></div>
                            <div class="price-range" style=" margin: 20px 0;display: flex;justify-content: space-between;">
                                <span id="min-price">0</span>
                                <span id="max-price">100,000,000</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section uk-open">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Hãng
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($nsx as $i)
                            <li>
                                <input class="tm-checkbox" id="brand-{{$i->id}}" name="brand" value="{{$i->id}}" type="checkbox" /><label for="brand-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                       Kích thước màn hình<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($manhinh as $i)
                            <li>
                                <input class="tm-checkbox" data-size="{{$i->id}}" id="ktmanhinh-{{$i->id}}" name="ktmanhinh" value="{{$i->id}}" type="checkbox" />
                                <label for="ktmanhinh-{{$i->id}}">{{$i->ten}}
                                    <!-- <span class="uk-text-meta uk-text-xsmall">45</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Độ phân giải<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($dophangiai as $i)
                            <li>
                                <input class="tm-checkbox" id="dophangiai-{{$i->id}}" name="dophangiai" value="{{$i->id}}" type="checkbox" />
                                <label for="dophangiai-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Tấm nền<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($tamnen as $i)
                            <li>
                                <input class="tm-checkbox" id="tamnen-{{$i->id}}" name="tamnen" value="{{$i->id}}" type="checkbox" />
                                <label for="tamnen-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Tần số quét<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($tansoquet as $i)
                            <li>
                                <input class="tm-checkbox" id="tansoquet-{{$i->id}}" name="tansoquet" value="{{$i->id}}" type="checkbox" />
                                <label for="tansoquet-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</aside>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var slider = document.getElementById('slider');
    noUiSlider.create(slider, {
        start: [0, 100000000],
        connect: true,
        range: {
            'min': 0,
            'max': 100000000
        },
        step: 10,
        format: {
            to: function(value) {
                return formatNumber(value.toFixed(0));
            },
            from: function(value) {
                return Number(value.replace(/,/g, ''));
            }
        }
    });

    var minPriceSpan = document.getElementById('min-price');
    var maxPriceSpan = document.getElementById('max-price');

    slider.noUiSlider.on('update', function(values, handle) {
        if (handle) {
            maxPriceSpan.textContent = formatNumber(values[handle]);
        } else {
            minPriceSpan.textContent = formatNumber(values[handle]);
        }
    });
    $(document).ready(function() {

        function filterProducts() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });


            var sortBy = $('#sortSelect').val();
            filters['sort'] = sortBy;


            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        function filterByPrice() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });

            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        $('input[type="checkbox"]').on('change', filterProducts);
        slider.noUiSlider.on('change', filterByPrice);
        $('#sortSelect').on('change',filterProducts);
    });
</script>
@elseif($dm->id == '5')
<aside class="uk-width-1-4 tm-aside-column tm-filters" id="filters" uk-offcanvas="overlay: true; container: false;">
    <div class="uk-offcanvas-bar uk-padding-remove">
        <div class="uk-card uk-card-default uk-card-small uk-flex uk-flex-column uk-height-1-1">
            <header class="uk-card-header ">
            </header>

            <div class="uk-margin-remove uk-flex-1 uk-overflow-auto" uk-accordion="multiple: true; targets: &gt; .js-accordion-section" style="flex-basis: auto">
                <section class="uk-card-body uk-open js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Giá
                    </h4>
                    <div class="uk-accordion-content">
                        <div class="price-filter" style="width: 100%; margin: 20px auto;">
                            <div id="slider"></div>
                            <div class="price-range" style=" margin: 20px 0;display: flex;justify-content: space-between;">
                                <span id="min-price">0</span>
                                <span id="max-price">100,000,000</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section uk-open">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Hãng
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($nsx as $i)
                            <li>
                                <input class="tm-checkbox" id="brand-{{$i->id}}" name="brand" value="{{$i->id}}" type="checkbox" /><label for="brand-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                       Loại kết nối<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($loaibanphim as $i)
                            <li>
                                <input class="tm-checkbox" data-size="{{$i->id}}" id="loaiketnoi-{{$i->id}}" name="loaiketnoi" value="{{$i->id}}" type="checkbox" />
                                <label for="loaiketnoi-{{$i->id}}">{{$i->ten}}
                                    <!-- <span class="uk-text-meta uk-text-xsmall">45</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Kiểu tai nghe<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($kieutainghe as $i)
                            <li>
                                <input class="tm-checkbox" id="kieutainghe-{{$i->id}}" name="kieutainghe" value="{{$i->id}}" type="checkbox" />
                                <label for="kieutainghe-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Cổng kết nối<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($congketnoi as $i)
                            <li>
                                <input class="tm-checkbox" id="congketnoi-{{$i->id}}" name="congketnoi" value="{{$i->id}}" type="checkbox" />
                                <label for="congketnoi-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</aside>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var slider = document.getElementById('slider');
    noUiSlider.create(slider, {
        start: [0, 100000000],
        connect: true,
        range: {
            'min': 0,
            'max': 100000000
        },
        step: 10,
        format: {
            to: function(value) {
                return formatNumber(value.toFixed(0));
            },
            from: function(value) {
                return Number(value.replace(/,/g, ''));
            }
        }
    });

    var minPriceSpan = document.getElementById('min-price');
    var maxPriceSpan = document.getElementById('max-price');

    slider.noUiSlider.on('update', function(values, handle) {
        if (handle) {
            maxPriceSpan.textContent = formatNumber(values[handle]);
        } else {
            minPriceSpan.textContent = formatNumber(values[handle]);
        }
    });
    $(document).ready(function() {

        function filterProducts() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });


            var sortBy = $('#sortSelect').val();
            filters['sort'] = sortBy;


            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        function filterByPrice() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });

            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        $('input[type="checkbox"]').on('change', filterProducts);
        slider.noUiSlider.on('change', filterByPrice);
        $('#sortSelect').on('change',filterProducts);
    });
</script>
@elseif($dm->id == '7')
<aside class="uk-width-1-4 tm-aside-column tm-filters" id="filters" uk-offcanvas="overlay: true; container: false;">
    <div class="uk-offcanvas-bar uk-padding-remove">
        <div class="uk-card uk-card-default uk-card-small uk-flex uk-flex-column uk-height-1-1">
            <header class="uk-card-header ">
            </header>

            <div class="uk-margin-remove uk-flex-1 uk-overflow-auto" uk-accordion="multiple: true; targets: &gt; .js-accordion-section" style="flex-basis: auto">
                <section class="uk-card-body uk-open js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Giá
                    </h4>
                    <div class="uk-accordion-content">
                        <div class="price-filter" style="width: 100%; margin: 20px auto;">
                            <div id="slider"></div>
                            <div class="price-range" style=" margin: 20px 0;display: flex;justify-content: space-between;">
                                <span id="min-price">0</span>
                                <span id="max-price">100,000,000</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section uk-open">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Hãng
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($nsx as $i)
                            <li>
                                <input class="tm-checkbox" id="brand-{{$i->id}}" name="brand" value="{{$i->id}}" type="checkbox" /><label for="brand-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                       Loại kết nối<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($loaibanphim as $i)
                            <li>
                                <input class="tm-checkbox" data-size="{{$i->id}}" id="loaiketnoichuot-{{$i->id}}" name="loaiketnoichuot" value="{{$i->id}}" type="checkbox" />
                                <label for="loaiketnoichuot-{{$i->id}}">{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Cổng kết nối<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($congketnoi as $i)
                            <li>
                                <input class="tm-checkbox" id="kieuketnoichuot-{{$i->id}}" name="kieuketnoichuot" value="{{$i->id}}" type="checkbox" />
                                <label for="kieuketnoichuot-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</aside>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var slider = document.getElementById('slider');
    noUiSlider.create(slider, {
        start: [0, 100000000],
        connect: true,
        range: {
            'min': 0,
            'max': 100000000
        },
        step: 10,
        format: {
            to: function(value) {
                return formatNumber(value.toFixed(0));
            },
            from: function(value) {
                return Number(value.replace(/,/g, ''));
            }
        }
    });

    var minPriceSpan = document.getElementById('min-price');
    var maxPriceSpan = document.getElementById('max-price');

    slider.noUiSlider.on('update', function(values, handle) {
        if (handle) {
            maxPriceSpan.textContent = formatNumber(values[handle]);
        } else {
            minPriceSpan.textContent = formatNumber(values[handle]);
        }
    });
    $(document).ready(function() {

        function filterProducts() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });


            var sortBy = $('#sortSelect').val();
            filters['sort'] = sortBy;


            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        function filterByPrice() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });

            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsdm", ["id" => $dm->id]) }}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }

        $('input[type="checkbox"]').on('change', filterProducts);
        slider.noUiSlider.on('change', filterByPrice);
        $('#sortSelect').on('change',filterProducts);
    });
</script>
@endif
@else
<aside class="uk-width-1-4 tm-aside-column tm-filters" id="filters" uk-offcanvas="overlay: true; container: false;">
    <div class="uk-offcanvas-bar uk-padding-remove">
        <div class="uk-card uk-card-default uk-card-small uk-flex uk-flex-column uk-height-1-1">
            <header class="uk-card-header ">
            </header>
            <div class="uk-card-body">

            </div>
            <div class="uk-margin-remove uk-flex-1 uk-overflow-auto" uk-accordion="multiple: true; targets: &gt; .js-accordion-section" style="flex-basis: auto">
                <section class="uk-card-body uk-open js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Giá
                    </h4>
                    <div class="uk-accordion-content">
                        <div class="price-filter" style="width: 100%; margin: 20px auto;">
                            <div id="slider"></div>
                            <div class="price-range" style=" margin: 20px 0;display: flex;justify-content: space-between;">
                                <span id="min-price">0</span>
                                <span id="max-price">100,000,000</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section uk-open">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Hãng
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($nsx as $i)
                            <li>
                                <input class="tm-checkbox" id="brand-{{$i->id}}" name="brand" value="{{$i->id}}" type="checkbox" /><label for="brand-{{$i->id}}"><span>{{$i->ten}}
                                        <!-- <span class="uk-text-meta uk-text-xsmall">177</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Kích cỡ màn hình<span class="tm-help-icon" uk-icon="icon: question; ratio: .75;" onclick="event.stopPropagation();"></span>
                        <div class="uk-margin-remove" uk-drop="mode: click;boundary-align: true; boundary: !.uk-accordion-title; pos: bottom-justify;">
                            <div class="uk-card uk-card-body uk-card-default uk-card-small uk-box-shadow-xlarge uk-text-small">
                                Kích thước màn hình
                            </div>
                        </div>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($manhinh as $i)
                            <li>
                                <input class="tm-checkbox" data-size="{{$i->id}}" id="screen-size-{{$i->id}}" name="screen-size" value="{{$i->id}}" type="checkbox" />
                                <label for="screen-size-{{$i->id}}">{{$i->ten}}
                                    <!-- <span class="uk-text-meta uk-text-xsmall">45</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Ram<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($ram as $i)
                            <li>
                                <input class="tm-checkbox" id="ram-{{$i->id}}" name="ram" value="{{$i->id}}" type="checkbox" /><label for="ram-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        Bộ nhớ<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($ssd as $i)
                            <li>
                                <input class="tm-checkbox" id="ssd-{{$i->id}}" name="ssd" value="{{$i->id}}" type="checkbox" /><label for="ssd-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        CPU<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($cpu as $i)
                            <li>
                                <input class="tm-checkbox" id="cpu-{{$i->id}}" name="cpu" value="{{$i->id}}" type="checkbox" /><label for="cpu-{{$i->id}}"><span>{{$i->ten}}
                                        <!-- <span class="uk-text-meta uk-text-xsmall">102</span></span></label> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                <section class="uk-card-body js-accordion-section">
                    <h4 class="uk-accordion-title uk-margin-remove">
                        VGA<span class="tm-help-icon" onclick="event.stopPropagation();"></span>
                    </h4>
                    <div class="uk-accordion-content">
                        <ul class="uk-list tm-scrollbox">
                            @foreach($gpu as $i)
                            <li>
                                <input class="tm-checkbox" id="gpuroi-{{$i->id}}" name="gpuroi" value="{{$i->id}}" type="checkbox" /><label for="gpuroi-{{$i->id}}"><span>{{$i->ten}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

            </div>
        </div>
    </div>
</aside>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var slider = document.getElementById('slider');
    noUiSlider.create(slider, {
        start: [0, 100000000],
        connect: true,
        range: {
            'min': 0,
            'max': 100000000
        },
        step: 10,
        format: {
            to: function(value) {
                return formatNumber(value.toFixed(0));
            },
            from: function(value) {
                return Number(value.replace(/,/g, ''));
            }
        }
    });

    var minPriceSpan = document.getElementById('min-price');
    var maxPriceSpan = document.getElementById('max-price');

    slider.noUiSlider.on('update', function(values, handle) {
        if (handle) {
            maxPriceSpan.textContent = formatNumber(values[handle]);
        } else {
            minPriceSpan.textContent = formatNumber(values[handle]);
        }
    });
    $(document).ready(function() {

        function filterProducts() {
            var filters = {};
            var _token = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]:checked').each(function() {
                var filterName = $(this).attr('name');
                var filterValue = $(this).val();

                if (filters[filterName] === undefined) {
                    filters[filterName] = [filterValue];
                } else {
                    filters[filterName].push(filterValue);
                }
            });


            var sortBy = $('#sortSelect').val();
            filters['sort'] = sortBy;


            var minPrice = slider.noUiSlider.get()[0].replace(/,/g, '');
            var maxPrice = slider.noUiSlider.get()[1].replace(/,/g, '');

            filters['minPrice'] = minPrice;
            filters['maxPrice'] = maxPrice;

            // var filtersString = JSON.stringify(filters, null, 2);
            // alert(filtersString);

            $.ajax({
                url: '{{ route("filter.productsgiamgia")}}',
                type: 'POST',
                data: {
                    filters: filters,
                    _token: _token
                },
                success: function(response) {
                    $('#product-listdm').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra trong quá trình lọc sản phẩm');
                }
            });
        }
        $('input[type="checkbox"]').on('change', filterProducts);
        slider.noUiSlider.on('change', filterProducts);
        $('#sortSelect').on('change',filterProducts);
    });
</script>
@endif

