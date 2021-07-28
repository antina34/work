@extends('layouts.admin-app')

@section('content')
    <!-- container -->
    <div class="container-fluid">

        <!-- row opened -->
        <div class="row row-sm">

            <!--div-->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Products</h4>
                            <em class="mdi mdi-dots-horizontal text-gray"></em>
                        </div>
                        <div class="navbar-header">
                            <a
                                class="navbar-brand btn btn-xm btn-success"
                                href="{{ route('admin.products.create') }}"
                            >Add Product</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 text-md-nowrap">
                                <caption></caption>
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Historical URL</th>
                                    <th scope="col" class="text-center">Actual URL</th>
                                    <th scope="col" class="text-center">Number of records to show</th>
                                    <th scope="col" class="text-center">Is active</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $key => $value)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $value->id }}</th>
                                            <td class="text-center">{{ $value->name }}</td>
                                            <td class="text-center">{{ $value->historical_url.''.$value->show_last_nr }}</td>
                                            <td class="text-center">{{ $value->actual_url.''.$value->show_last_nr }}</td>
                                            <td class="text-center">{{ $value->show_last_nr }}</td>
                                            <td class="text-center">{{ $value->active }}</td>

                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Actions">
                                                    <span title="Edit" class="pd-l-1"><button
                                                        type="button"
                                                        class="btn btn-info btn-sm rounded-50"
                                                        onclick="window.location.href='{{ route('admin.products.edit', $value->id) }}'"
                                                    ><em class="fa fa-edit"></em></button></span>
                                                    <form
                                                        method="POST"
                                                        class="form-horizontal"
                                                        action="{{ route('admin.products.destroy', $value->id) }}"
                                                        name="deleteForm{{ $value->id }}"
                                                    >
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <span title="Delete" class="pd-l-1"><button
                                                                type="button"
                                                                class="btn btn-danger btn-sm rounded-50"
                                                                onclick="deleteCheck({{ $value->id }})"
                                                        ><em class="fa fa-trash"></em></button></span>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->

        </div>
        <!-- /row -->
    </div>
    <!-- Container closed -->
@endsection

@push('scripts')
    <!-- Scripts -->
    <script>
        function deleteCheck(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    document['deleteForm'+id].submit();
                    Swal.fire(
                        'Deleted!',
                        'Your product has been deleted.',
                        'success'
                    );
                }
            });
        }
    </script>
@endpush
