<div class="modal fade" id="editProductImageModal" tabindex="-1" aria-labelledby="editProductImageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductImageModalLabel">Edit Layer image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProductImageForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <label for="recipient-name" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="row mt-3">
                        <select class="form-select" name="fabric_id">
                            <option selected>Select Fabric</option>
                            @foreach ($fabrics as $fabric)
                                <option value="{{ $fabric->id }}">{{ $fabric->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Image</button>
                </div>
            </form>
        </div>
    </div>
</div>
