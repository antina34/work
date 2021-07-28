@if(count($historicalData) > 0)
    <div class="card box-shadow-0">
        <div class="card-header">
            <h4 class="card-title mb-1">
                @if(count($historicalData) === 1)
                    Chart
                @else
                    Charts
                @endif
            </h4>
        </div>

        @foreach($historicalData as $key => $value)
            <div class="card-body pt-0 mt-3">
                <div
                    class="js-chart"
                    data-name="{{ $name[$key] }}"
                    id="chart{{ $key }}"
                    data-historical="{{ json_encode($value) }}"
                    data-actual="{{ json_encode($actualData[$key]) }}"
                    data-quantity="{{ $recordsToShow[$key] }}"
                ></div>
            </div>
        @endforeach
    </div>
@endif
