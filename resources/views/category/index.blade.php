@extends('layout.app')

@section('title', 'Categories')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories /</span> List Categories</h4>

<div class="card">
    <h5 class="card-header">
        <a href="/categories/create" class="btn btn-primary">Add Category</a>
    </h5>
    <div class="card-body">
        @if ($message = Session::get('message'))
        <div class="alert alert-success mt-4">
            <strong>Success</strong>
            <p>{{$message}}</p>
        </div>
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($categories as $index => $category)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('categories.edit', $category->id) }}"><i
                                    class="bx bx-edit-alt me-1"></i>
                                Edit
                            </a>
                            <button class="btn btn-danger delete-button" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-id={{$category->id}}>
                                <i class="bx bx-trash me-1"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Deleted data cannot be recovered.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" class="d-inline form-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    const delete_button = document.querySelectorAll('.delete-button');
    delete_button.forEach(element => {
        element.addEventListener('click', function(){
            const id_category = this.getAttribute('data-id')
            const form_delete = document.querySelector('.form-delete');
            form_delete.action = `/categories/${id_category}`
        })
    });
</script>
@endpush
@endsection
