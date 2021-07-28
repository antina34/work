<div class="card-body">
    <div class="card-header">
        @if(empty($product))
            <h4 class="card-title mb-1">Add New Product</h4>
        @else
            <h4>Edit Product</h4>
        @endif
    </div>

    <div class="card-body pt-0">
        @if(!empty($errors->all()))
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(!empty(session('message')))
            <div class="alert alert-success">
                {{ session('message') ?? '' }}
            </div>
        @endif
        <div class="form-group ">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label" for="name">Name</label>
                </div>
                <div class="col-md-9">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Name"
                        value="{{ old('name') ?? $product->name ?? '' }}"
                        name="name"
                        id="name"
                        required
                    >
                </div>
            </div>
        </div>
        <div class="form-group ">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label" for="historical_url">Historical API Url</label>
                </div>
                <div class="col-md-9">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Historical API Url"
                        value="{{ old('historical_url') ?? $product->historical_url ?? '' }}"
                        name="historical_url"
                        id="historical_url"
                        required
                    >
                </div>
            </div>
        </div>
        <div class="form-group ">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label" for="actual_url">Actual API Url</label>
                </div>
                <div class="col-md-9">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Actual API Url"
                        value="{{ old('actual_url') ?? $product->actual_url ?? '' }}"
                        name="actual_url"
                        id="actual_url"
                        required
                    >
                </div>
            </div>
        </div>
        <div class="form-group ">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label" for="show_last_nr">Hours of history</label>
                </div>
                <div class="col-md-9">
                    <input
                        type="number"
                        class="form-control"
                        placeholder="How many hours of history displaying per graph"
                        value="{{ old('show_last_nr') ?? $product->show_last_nr ?? '' }}"
                        name="show_last_nr"
                        id="show_last_nr"
                        required
                    >
                </div>
            </div>
        </div>
        <div class="form-group mb-0">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label" for="active">Product status</label>
                </div>
                <div class="col-md-9">
                    <div class="custom-controls-stacked">
                        <label class="ckbox mg-b-10">
                            <input
                                type="checkbox"
                                data-checkboxes="my-group"
                                name="active"
                                id="active"
                                value="1"
                                @if(old('active') ?? $product->active ?? '')
                                checked
                                @endif
                            >
                            <span>Active</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
</div>
