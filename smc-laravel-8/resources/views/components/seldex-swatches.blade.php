<?php
$seldexSwatches = new \Finao\Utility\SeldexSwatches();
$categories = [];
foreach ($seldexSwatches->data[0]->categories as $key => $v) {
    if(in_array($key, $seldexSwatches->getConfig()[$mode])){
        $categories[$key] = $v;
    }
}
?>
<!-- SWATCH GALLERY -->
<div class="container">
    <div class="row">
        <div class="col col-md-10 offset-md-1">
            <div>
                @foreach ($categories as $key => $value)
                    <li class="list-group-item"><a href="#{{$key}}">{{ $key }}</a></li>
                @endforeach
            </div>
            <!-- END -- TAB NAV BUTTONS -->

            <!-- TABS -->
            @foreach ($categories as $key => $value)
                <div id="{{ $key }}">
                    <h2  class="mb-2 mt-4 page-header">{{ $key }}</h2>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($value->swatches as $swatch)
                            <div class="col">
                                <div class="card">
                                    <img src="/images/seldex/{{ $swatch->file_name }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $swatch->label }}</h5>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


        @endforeach

        <!-- END -- TABS -->
        </div>
    </div>
    <!-- TAB NAV BUTTONS -->


</div>
<!-- END -- SWATCH GALLERY -->
