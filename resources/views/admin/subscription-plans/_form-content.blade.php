<div class="card-body">
    <div class="card-header">
        @if(empty($subscriptionPlan))
            <h4 class="card-title mb-1">Add New Subscription</h4>
        @else
            <h4>Edit Subscription</h4>
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
                    <label class="form-label">Product</label>
                </div>
                <div class="col-md-9">
                    <select class="form-control select2" name="product_id" id="product_id">
                        <option></option>
                        @foreach($products as $product)
                            <option
                                value="{{ $product->id }}"
                                @if(($subscriptionPlan->product_id ?? '')=== $product->id) selected='selected' @endif
                            >
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group ">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label" for="days">Active for (Days)</label>
                </div>
                <div class="col-md-9">
                    <input
                        type="number"
                        class="form-control"
                        placeholder="Subscription will be active for this many days once subscribed"
                        value="{{ old('days') ?? $subscriptionPlan->days ?? '' }}"
                        name="days"
                        id="days"
                        required
                    >
                </div>
            </div>
        </div>
        <div class="form-group ">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label" for="price">Price</label>
                </div>
                <div class="col-md-9">
                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        placeholder="Subscription plan price"
                        value="{{ old('price') ?? $subscriptionPlan->price ?? '' }}"
                        name="price"
                        id="price"
                        required
                    >
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
</div>
