@extends('layouts.app')

@section('page-title', 'Products')

@section('content')
<div id="app-content">
    <div class="app-content-area">
        <div class="container-fluid">
            @include('message.success')
            @include('message.error')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-md-flex border-bottom-0">
                            <h5>Products</h5>
                            <div class="ms-auto">
                                <!-- Import CNAS -->
                                <button class="btn btn-outline-danger shadow-sm btn-sm" data-bs-toggle="modal" data-bs-target="#importCNASModal">
                                    <i class="bi bi-upload"></i> Import CNAS
                                </button>

                                <!-- Import CSE -->
                                <button class="btn btn-outline-success shadow-sm btn-sm" data-bs-toggle="modal" data-bs-target="#importCSEModal">
                                    <i class="bi bi-upload"></i> Import CSE
                                </button>

                                <!-- Create New Product -->
                                <a href="#addProductModal" class="btn btn-outline-primary shadow-sm btn-sm" data-bs-toggle="modal" title="Create New Product">
                                    <i class="bi bi-plus-lg"></i>
                                </a>
                            </div>


                                
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>UOM</th>
                                            <th>Price</th>
                                            <th>Categories</th>
                                            <th>Available</th>
                                            <th>Source</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->product_description }}</td>
                                            <td>{{ $product->uom }}</td>
                                            <td>{{ number_format($product->price, 2) }}</td>
                                            <td>
                                                @foreach ($product->productCategories as $category)
                                                <span class="badge bg-primary">{{ $category->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge {{ $product->is_available ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $product->is_available ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $product->source === 'dbm' ? 'bg-info' : 'bg-warning' }}">
                                                    {{ $product->source }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#viewProductModal-{{ $product->id }}" class="btn btn-outline-secondary btn-sm rounded-circle shadow-sm" data-bs-toggle="modal" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#editProductModal-{{ $product->id }}" class="btn btn-outline-primary btn-sm rounded-circle shadow-sm" data-bs-toggle="modal" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <!-- Delete Button -->
                                                <a href="#deleteProductModal-{{ $product->id }}" class="btn btn-outline-danger btn-sm rounded-circle shadow-sm" data-bs-toggle="modal" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- View Product Modal -->
                                        <div class="modal fade" id="viewProductModal-{{ $product->id }}" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewProductModalLabel">Product Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <strong>Product Code:</strong> {{ $product->product_code }}
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Photo:</strong><br>
                                                            <img src="{{ asset('storage/' . $product->photo) }}" alt="Product Photo" class="img-fluid" width="150">
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Description:</strong> {{ $product->product_description }}
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>UOM:</strong> {{ $product->uom }}
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Price:</strong> ₱{{ number_format($product->price, 2) }}
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Categories:</strong>
                                                            @foreach ($product->productCategories as $category)
                                                            <span class="badge bg-primary">{{ $category->name }}</span>
                                                            @endforeach
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Specification:</strong> {{ $product->product_specification }}
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Attachment:</strong>
                                                            <a href="{{ asset('storage/' . $product->attachment) }}" target="_blank">View Attachment</a>
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Remarks:</strong> {{ $product->remarks }}
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Availability:</strong>
                                                            <span class="badge {{ $product->is_available ? 'bg-success' : 'bg-danger' }}">
                                                                {{ $product->is_available ? 'Available' : 'Not Available' }}
                                                            </span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Source:</strong>
                                                            <span class="badge {{ $product->source === 'dbm' ? 'bg-info' : 'bg-warning' }}">
                                                                {{ ucfirst($product->source) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteProductModal-{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteProductModalLabel">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the product <strong>{{ $product->product_description }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('products.delete', $product->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Product Code and Photo -->
                        <div class="col-md-6">
                            <label for="product_code" class="form-label">Product Code:</label>
                            <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product code (optional)">
                        </div>
                        <div class="col-md-6">
                            <label for="photo" class="form-label">Photo:</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                            <small class="text-muted">Upload a product image (optional).</small>
                        </div>
                        
                        <!-- Description and Product Categories -->
                        <div class="col-md-6">
                            <label for="product_description" class="form-label">Description:</label>
                            <textarea class="form-control" id="product_description" name="product_description" rows="2" placeholder="Enter product description" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="categories" class="form-label">Product Categories:</label>
                            <select class="form-control select2" id="categories" name="categories[]" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Select one or more categories (optional).</small>
                        </div>
                        
                        <!-- Unit of Measure and Price -->
                        <div class="col-md-6">
                            <label for="uom" class="form-label">Unit of Measure (UOM):</label>
                            <input type="text" class="form-control" id="uom" name="uom" placeholder="e.g., kg, pcs, box" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price:</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter price in PHP" required>
                        </div>
                        
                        <!-- Specification and Attachment -->
                        <div class="col-md-6">
                            <label for="product_specification" class="form-label">Specification:</label>
                            <textarea class="form-control" id="product_specification" name="product_specification" rows="2" placeholder="Enter product specification (optional)"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="attachment" class="form-label">Attachment:</label>
                            <input type="file" class="form-control" id="attachment" name="attachment" accept=".pdf,.doc,.docx,.xls,.xlsx">
                            <small class="text-muted">Upload an attachment (optional).</small>
                        </div>
                        
                        <!-- Remarks (Full Width) -->
                        <div class="col-md-12">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Enter remarks (optional)"></textarea>
                        </div>

                        <!-- Availability and Source -->
                        <div class="col-md-6">
                            <label for="is_available" class="form-label">Availability:</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="1" checked>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="source" class="form-label">Source:</label>
                            <select class="form-control" id="source" name="source" required>
                                <option value="dbm">DBM</option>
                                <option value="local">Local</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Import CNAS Modal -->
<div class="modal fade" id="importCNASModal" tabindex="-1" aria-labelledby="importCNASModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('products.import-cnas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importCNASModalLabel">Import CNAS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cnasFile" class="form-label">Select CNAS File:</label>
                        <input type="file" class="form-control" id="cnasFile" name="file" accept=".xlsx,.xls" required>
                        <small class="text-muted">Only .xlsx and .xls files are allowed.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Import CSE Modal -->
<div class="modal fade" id="importCSEModal" tabindex="-1" aria-labelledby="importCSEModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('products.import-cse') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importCSEModalLabel">Import CSE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cseFile" class="form-label">Select CSE File:</label>
                        <input type="file" class="form-control" id="cseFile" name="file" accept=".xlsx,.xls" required>
                        <small class="text-muted">Only .xlsx and .xls files are allowed.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@push('page-scripts')
<script>
    $(document).ready(function() {
        // Initialize select2 for product categories
        $('#categories').select2({
            theme: "bootstrap-5",
            placeholder: 'Select categories',
            width: '100%'
        });
    });
</script>
@endpush
