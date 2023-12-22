<div class="modal fade" id="addOptionImageModal" tabindex="-1" aria-labelledby="addOptionImageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOptionImageModalLabel">Add new image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addOptionImageForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="{{ $option->id }}" name="option_id">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Sequence:</label>
                        <input type="number" class="form-control" id="sequence" name="sequence">
                    </div>
                    <div class="mb-3">
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
