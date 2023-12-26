<div class="modal fade" id="addOptionModal" tabindex="-1" aria-labelledby="addOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOptionModalLabel">Add new value</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addOptionForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Enter Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Price:</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" id="image" name="image">
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
                    <button type="submit" class="btn btn-primary">Save Option</button>
                </div>
            </form>
        </div>
    </div>
</div>
